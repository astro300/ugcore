<?php
namespace UGCore\Core\Repositories\Academico;
use UGCore\Core\Entities\Academico\tb_docente_dacademico;
use UGCore\Core\Entities\Academico\tb_docente_materia;
use DB;
use Utils;
use Messages;
use Alerts;
use Auth;

class AsignaDocenteRepository {
    public function forHabilita(){
        $usuario=Auth::user()->name;
        $permiso=DB::connection('sqlsrv_bdacademico')
            ->select("EXEC dbo.SP_PERMISO_PLANIFICACION_ACAD ?",[$usuario]);
        return $permiso[0]->PERMISO;
    }

	public function forFacultades($usuario){
        $listaFacultades=DB::connection('sqlsrv_bdacademico')
                        ->table('TB_USUARIO_CARRERA as U')
                        ->leftJoin('TB_CARRERA as C','C.COD_CARRERA','=','U.COD_CARRERA')
                        ->leftJoin('TB_FACULTAD as F','C.COD_FACULTAD','=','F.COD_FACULTAD')
                        ->leftJoin('TB_USUARIO as US','US.USUARIO','=','U.USUARIO')
                        ->where('US.COD_EMPLEADO','=',$usuario)
                        ->groupBy('F.COD_FACULTAD','F.NOMBRE')
                        ->orderBy('F.NOMBRE','ASC')
                        ->select('F.COD_FACULTAD', DB::raw('LTRIM(RTRIM(F.NOMBRE)) AS NOMBRE'))
                        ->pluck('NOMBRE','COD_FACULTAD')->toArray();
        return $listaFacultades;
    }

    public function forCarreras($cod_facultad,$usuario){
        $listaCarreras=DB::connection('sqlsrv_bdacademico')
            ->table('TB_CARRERA AS C')
            ->leftJoin('TB_USUARIO_CARRERA as A','A.COD_CARRERA','=','C.COD_CARRERA')
            ->leftJoin('TB_USUARIO as B','B.USUARIO','=','A.USUARIO')
            ->where('C.NOACADE','=',0)
            ->where('C.COD_CCARRERA','=',1)
            ->where('C.COD_FACULTAD','=',$cod_facultad)
            ->where('B.COD_EMPLEADO','=',$usuario)
            ->groupBy('C.COD_CARRERA','C.NOMBRE')
            ->orderBy('C.NOMBRE','ASC')
            ->select('C.COD_CARRERA', DB::raw('LTRIM(RTRIM(C.NOMBRE)) AS NOMBRE'))
            ->pluck('NOMBRE','COD_CARRERA')->toArray();
        return $listaCarreras;
    }

    public function forPeriodos($cod_carrera){
        $listaPeriodos=DB::connection('sqlsrv_bdacademico')
            ->table('TB_PLECTIVO AS P')
            ->where(DB::raw('SUBSTRING(P.DESCRIPCION,1,4)'),'<=','2020')
            ->where('P.DESCRIPCION','NOT LIKE','%PC')
            ->where('P.DESCRIPCION','NOT LIKE','%PCS')
            ->where('P.DESCRIPCION','<>','\'2016 - 2018\'')
            //->whereIn('P.T_CALIFICA_S',array('T','S'))
            ->where('P.COD_CARRERA','=',$cod_carrera)
            ->groupBy('P.COD_PLECTIVO','P.DESCRIPCION')
            ->orderBy('P.COD_PLECTIVO','DESC')
            ->select(DB::raw('DISTINCT(P.COD_PLECTIVO) AS COD_PLECTIVO'), DB::raw('LTRIM(RTRIM(P.DESCRIPCION)) AS DESCRIPCION'))
            //->take(5)
            ->pluck('DESCRIPCION','COD_PLECTIVO')->toArray();
        return $listaPeriodos;
    }

    public function forDocentes($busqueda){
        if ($busqueda != "%%"){
            $listaDocentes = DB::connection('sqlsrv_bdacademico')
                ->table('TB_DOCENTE_DPERSONAL AS A')
                ->where('A.COD_DOCENTE', '<>', '')
                ->where('A.COD_DOCENTE', 'LIKE', $busqueda)
                ->orWhere('A.APELLIDO', 'LIKE', $busqueda)
                ->orderBy(DB::raw('(RTRIM(LTRIM(A.APELLIDO))+\' \'+RTRIM(LTRIM(A.NOMBRE)))', 'ASC'))
                ->select(DB::raw('DISTINCT A.COD_DOCENTE'), DB::raw('(RTRIM(LTRIM(A.APELLIDO))+\' \'+RTRIM(LTRIM(A.NOMBRE))) AS NOMBRES_COMPLETOS'))
                ->pluck('NOMBRES_COMPLETOS', 'COD_DOCENTE')->toArray();
            return $listaDocentes;
        }
    }

    public function forMaterias($busqueda,$plectivo){
        if ($busqueda != "%%"){
            $listaMaterias = DB::connection('sqlsrv_bdacademico')
                ->table('TB_PENSUM as A')
                ->leftJoin('TB_PENSUMATE as B','A.COD_PENSUM','=','B.COD_PENSUM')
                ->leftJoin('TB_MATERIA as C','B.COD_MATERIA','=','C.COD_MATERIA')
                ->where('A.COD_PLECTIVO', '=', $plectivo)
                ->where('C.NOMBRE', 'LIKE', $busqueda)
                ->orderBy('C.NOMBRE')
                ->select('C.COD_MATERIA',DB::raw('RTRIM(LTRIM(C.NOMBRE))+\' [NIV:\'+CONVERT(VARCHAR,C.NIVEL)+\']\' AS NOMBRE'))
                ->pluck('NOMBRE', 'COD_MATERIA')->toArray();
            return $listaMaterias;
        }
    }

    public function forAsignaciones($docente,$plectivo){
        return \Datatables::of(DB::connection('sqlsrv_bdacademico')
            ->table('TB_DOCENTE_DACADEMICO as A')
            ->leftJoin('TB_CARRERA as B','A.COD_CARRERA','=','B.COD_CARRERA')
            ->leftJoin('TB_DOCENTE_MATERIA as C',
                function($join) {
                    $join->on('C.COD_CARRERA','=','B.COD_CARRERA');
                    $join->on('C.COD_DOCENTE','=','A.COD_DOCENTE');
                })
            ->leftJoin('TB_MATERIA as D','D.COD_MATERIA','=','C.COD_MATERIA')
            ->where('A.COD_DOCENTE','=',$docente)
            ->where('C.COD_PLECTIVO','=',$plectivo)
            ->where('C.ESTADO','<>','X')
            ->where('A.ESTADO','=','A')
            ->groupBy('B.NOMBRE','A.FECHA_INGRESO','D.NOMBRE','C.NIVEL','A.ESTADO','C.OBSERVACION','C.N_ID')
            ->select(DB::raw('LTRIM(RTRIM(B.NOMBRE)) AS NOMBRE'),'A.FECHA_INGRESO',DB::raw('D.NOMBRE AS MATERIA'),'C.NIVEL','A.ESTADO','C.OBSERVACION','C.N_ID'))
            //->add_column('OPCIONES',' <a href="{{ route(\'academico.docente.verdetalle\',$N_ID)}}" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>')
            ->add_column('OPCIONES','<label class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_theme_info_materia" id="optmat" data-popup="tooltip" data-placement="bottom" data-original-title="Editar" onclick="cambiaMateria({{$N_ID}})"><i class="fa fa-edit"></i></label>
                    <label class="btn btn-warning btn-sm" id="delmat" data-popup="tooltip" data-placement="bottom" data-original-title="Eliminar" onclick="eliminaMateria({{$N_ID}})"><i class="fa fa-eraser"></i></label>')
            ->make(true);
    }

    public function forGuardaAsignacionDoc($request){
        //dd($request->facultad,$request->carrera,$request->plectivo,$request->docente,$request->materia);
        /*BUSCA EN TABLA TB_DOCENTE_DACADEMICO SI EL REGISTRO EXISTE*/
        $existeAcademico=DB::connection('sqlsrv_bdacademico')
            ->table('TB_DOCENTE_DACADEMICO as A')
            ->where('A.COD_CARRERA', '=', $request->carrera)
            ->where('A.COD_DOCENTE','=',$request->docente)
            ->where('A.ESTADO','=','A')
            ->count();
        /**/
        /*BUSCA EL NIVEL DE LA MATERIA*/
        $nivelMateria = DB::connection('sqlsrv_bdacademico')
            ->table('TB_PENSUM as A')
            ->leftJoin('TB_PENSUMATE as B','A.COD_PENSUM','=','B.COD_PENSUM')
            ->leftJoin('TB_MATERIA as C','B.COD_MATERIA','=','C.COD_MATERIA')
            ->where('A.COD_PLECTIVO', '=', $request->plectivo)
            ->where('C.COD_MATERIA', '=', $request->materia)
            ->orderBy('C.NOMBRE')
            ->select('C.NIVEL')->pluck('C.NIVEL')->toArray();
        /**/
        /*BUSCA EN TABLA TB_DOCENTE_MATERIA SI EL REGISTRO EXISTE*/
        $existeDocenteMateria=DB::connection('sqlsrv_bdacademico')
            ->table('TB_DOCENTE_MATERIA as A')
            ->where('A.COD_CARRERA', '=', $request->carrera)
            ->where('A.COD_DOCENTE','=',$request->docente)
            ->where('A.COD_MATERIA','=',$request->materia)
            ->where('A.COD_PLECTIVO','=',$request->plectivo)
            ->where('A.NIVEL','=',$nivelMateria[0])
            ->where('A.ESTADO','<>','X')
            ->count();
        /**/
        if($existeAcademico=='0') {
            /*GUARDA TABLA TB_DOCENTE_DACADEMICO*/
            $docente_dacademico = new tb_docente_dacademico();
            $docente_dacademico->COD_DOCENTE = $request->docente;
            $docente_dacademico->COD_ANTERIOR = '';
            $docente_dacademico->COD_CARRERA = $request->carrera;
            $docente_dacademico->ESTADO = 'A';
            $docente_dacademico->FECHA_INGRESO = Utils::getDateSQL();
            $docente_dacademico->FECHA_SALIDA = Utils::getDateSQL();
            $docente_dacademico->VALOR_HORA = '0.000';
            $docente_dacademico->RESPONSA1 = \Auth::user()->name;
            $docente_dacademico->RESPONSA2 = \Auth::user()->name;
            $docente_dacademico->FECSYS1 = Utils::getDateSQL();
            $docente_dacademico->FECSYS2 = Utils::getDateSQL();
            $docente_dacademico->save();
        }
        if($existeDocenteMateria=='0'){
            /*GUARDA TABLA TB_DOCENTE_MATERIA*/
            $docente_materia = new tb_docente_materia();
            $docente_materia->COD_CARRERA = $request->carrera;
            $docente_materia->COD_DOCENTE = $request->docente;
            $docente_materia->COD_MATERIA = $request->materia;
            $docente_materia->COD_PLECTIVO = $request->plectivo;
            $docente_materia->ESTADO = 'P';
            $docente_materia->NIVEL = $nivelMateria[0];
            $docente_materia->N_V = '1';
            $docente_materia->OBSERVACION = $request->observacion;
            $docente_materia->RESPONSA1 = \Auth::user()->name;
            $docente_materia->RESPONSA2 = \Auth::user()->name;
            $docente_materia->FECSYS1 = Utils::getDateSQL();
            $docente_materia->FECSYS2 = Utils::getDateSQL();
            $docente_materia->save();
            return true;
        }
        else
        {
            return false;
        }
    }

    public function forVeriMateriaID($nid){
        $docente_materia = tb_docente_materia::find($nid);
        if (is_null($docente_materia)) {
            abort(404);
        }
        else{
            return view('academico.docente.asigna_docente.edit')->with([
                'COD_CARRERA' => $docente_materia->COD_CARRERA,
                'COD_DOCENTE' => $docente_materia->COD_DOCENTE,
                'COD_MATERIA' => $docente_materia->COD_MATERIA,
                'COD_PLECTIVO' => $docente_materia->COD_PLECTIVO,
                'NIVEL' => $docente_materia->NIVEL,
                'OBSERVACION' => $docente_materia->OBSERVACION,
                'N_ID' => $docente_materia->N_ID
            ]);
        }
    }

    public function forVerDAcademico($cedulas){
        if ($cedulas != ""){
            return \Datatables::of(DB::connection('sqlsrv_bdacademico')
                ->table('TB_DOCENTE_DACADEMICO as A')
                ->leftJoin('TB_CARRERA as B','A.COD_CARRERA','=','B.COD_CARRERA')
                ->where('A.COD_DOCENTE', '=', $cedulas)
                ->select('A.COD_CARRERA',DB::raw('RTRIM(LTRIM(B.NOMBRE)) AS CARRERA'),'A.ESTADO'))
                ->add_column('ESTADO',
                    '<?php $code= uniqid(); ?>
                    <div class="checkbox checkbox-primary" style="text-align: center;margin-top: 2px;margin-bottom: 2px;">
                    @if($ESTADO=="A")
                        <div class="checkbox icheck">
                            <input id="cestado{{$code}}" data-carrera="{{$COD_CARRERA}}" type="checkbox" checked="checked" />
                        </div>
                    @else
                        <div class="checkbox icheck">
                            <input id="cestado{{$code}}" data-carrera="{{$COD_CARRERA}}"  type="checkbox" />
                        </div>
                    @endif
                    <label for="cestado{{$code}}"> &nbsp; </label>
                    </div>
                ')
                ->make(true);
        }

    }

    public function forGuardaDAcademico($carrera,$docente){
        $array_response=[];
        $array_response['status']=200;
        $array_response['message']='Carrera '.$carrera.' guardado correctamente para el docente '.$docente;

        $InsertCarrera=DB::connection('sqlsrv_bdacademico')
            ->table('TB_DOCENTE_DACADEMICO as A')
            ->where('A.COD_DOCENTE','=',$docente)
            ->where('A.COD_CARRERA','=',$carrera)
            ->count();
        if($InsertCarrera==0) {
            //GUARDA TABLA TB_DOCENTE_DACADEMICO
            $docente_dacademico = new tb_docente_dacademico();
            $docente_dacademico->COD_DOCENTE = $docente;
            $docente_dacademico->COD_ANTERIOR = '';
            $docente_dacademico->COD_CARRERA = $carrera;
            $docente_dacademico->ESTADO = 'A';
            $docente_dacademico->FECHA_INGRESO = Utils::getDateSQL();
            $docente_dacademico->FECHA_SALIDA = Utils::getDateSQL();
            $docente_dacademico->VALOR_HORA = '0.000';
            $docente_dacademico->RESPONSA1 = \Auth::user()->name;
            $docente_dacademico->RESPONSA2 = \Auth::user()->name;
            $docente_dacademico->FECSYS1 = Utils::getDateSQL();
            $docente_dacademico->FECSYS2 = Utils::getDateSQL();
            $docente_dacademico->save();
        }
        else{
            $array_response['status']=404;
            $array_response['message']='Ya existe la carrera '.$carrera.' para el docente '.$docente;
        }
        return $array_response;
    }

    public function forActualizaEstado($estado,$docente,$carrera){
        $array_response=[];
        $array_response['status']=200;
        $array_response['message']='Estado guardado correctamente';
        if($estado=="1")
            $state="A";
        else
            $state="X";
        $UpEstado=tb_docente_dacademico::where('COD_DOCENTE','=',$docente)
            ->where('COD_CARRERA','=',$carrera)
            ->update(['ESTADO' => $state,'RESPONSA2' => \Auth::user()->name,'FECSYS2' => Utils::getDateSQL()]);
        if($UpEstado==0){
            $array_response['status']=404;
            $array_response['message']='No se pudo actualizar al docente '.$docente;
        }
        return $array_response;
    }

    public function forVerDAcademicoNID($nid){
        return \Datatables::of(DB::connection('sqlsrv_bdacademico')
            ->table('TB_DOCENTE_DACADEMICO as A')
            ->leftJoin('TB_CARRERA as B', 'A.COD_CARRERA', '=', 'B.COD_CARRERA')
            ->leftJoin('TB_DOCENTE_MATERIA as C',
                function ($join) {
                    $join->on('C.COD_CARRERA', '=', 'B.COD_CARRERA');
                    $join->on('C.COD_DOCENTE', '=', 'A.COD_DOCENTE');
                })
            ->leftJoin('TB_MATERIA as D', 'D.COD_MATERIA', '=', 'C.COD_MATERIA')
            ->where('C.N_ID', '=', $nid)
            ->where('A.ESTADO', '=', 'A')
            ->groupBy('B.NOMBRE', 'A.FECHA_INGRESO', 'D.NOMBRE', 'C.NIVEL', 'A.ESTADO', 'C.OBSERVACION', 'C.N_ID')
            ->select(DB::raw('LTRIM(RTRIM(B.NOMBRE)) AS NOMBRE'), 'A.FECHA_INGRESO', DB::raw('D.NOMBRE AS MATERIA'), 'C.NIVEL', 'A.ESTADO', 'C.N_ID'))
            ->make(true);
    }

    public function forActualizaMateria($materia,$cid,$plectivo){
        /*BUSCA EL NIVEL DE LA MATERIA*/
        $nivelMateria = DB::connection('sqlsrv_bdacademico')
            ->table('TB_PENSUM as A')
            ->leftJoin('TB_PENSUMATE as B','A.COD_PENSUM','=','B.COD_PENSUM')
            ->leftJoin('TB_MATERIA as C','B.COD_MATERIA','=','C.COD_MATERIA')
            ->where('A.COD_PLECTIVO', '=', $plectivo)
            ->where('C.COD_MATERIA', '=', $materia)
            ->orderBy('C.NOMBRE')
            ->select('C.NIVEL')->pluck('C.NIVEL')->toArray();
        /**/
        $array_response=[];
        $array_response['status']=200;
        $array_response['message']='Materia '.$materia.' modificada correctamente';

        $docente_materia = tb_docente_materia::find($cid);
        if (is_null($docente_materia)) {
            $array_response['status']=404;
            $array_response['message']='Registro no encontrado. No se pudo guardar los cambios ['.$materia.']';
        }
        else{
            $docente_materia->COD_MATERIA=$materia;
            $docente_materia->NIVEL=$nivelMateria[0];
            $docente_materia->RESPONSA2 = \Auth::user()->name;
            $docente_materia->FECSYS2 = Utils::getDateSQL();
            $docente_materia->save();
        }
        return $array_response;
    }

    public function forEliminaMateria($cid){
        $array_response=[];
        $array_response['status']=200;
        $array_response['message']='La Materia ha sido eliminada correctamente';

        $docente_materia = tb_docente_materia::find($cid);
        if (is_null($docente_materia)) {
            $array_response['status']=404;
            $array_response['message']='Registro no encontrado. No se pudo eliminar los cambios';
        }
        else{
            $docente_materia->ESTADO='X';
            $docente_materia->RESPONSA2 = \Auth::user()->name;
            $docente_materia->FECSYS2 = Utils::getDateSQL();
            $docente_materia->save();
        }
        return $array_response;
    }
}