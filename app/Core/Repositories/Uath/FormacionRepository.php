<?php
namespace UGCore\Core\Repositories\Uath;

use UGCore\Core\Entities\Uath\Grupos;
use UGCore\Core\Entities\Uath\Materias;
use UGCore\Core\Entities\Uath\GruposPersonas;
use Utils;
use Messages;
use Alerts;
use DB;

class FormacionRepository
{
    public function forMateriasCursos()
    {
        return \Datatables::of(DB::connection('sqlsrv_modulos')
            ->table('Cursos.Materias as A')
            ->select('A.ID', 'A.NOMBRE_MATERIA', 'A.DESCRIPCION', 'A.ESTADO'))
            ->add_column('OPCIONES', '<label class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_theme_info_materia"  data-popup="tooltip" data-placement="bottom" data-original-title="Editar" onclick="verMateria({{$ID}})"><i class="fa fa-edit"></i></label>')
            ->make(true);
    }

    public function forTodasMaterias(){
        $listaMaterias=DB::connection('sqlsrv_modulos')
            ->table('Cursos.Materias as A')
            ->where('A.ESTADO','=','A')
            ->select('A.ID', 'A.NOMBRE_MATERIA')
            ->lists('NOMBRE_MATERIA','ID');
        return $listaMaterias;
    }

    public function forGruposCursos()
    {
        return \Datatables::of(DB::connection('sqlsrv_modulos')
            ->table('Cursos.Grupos as A')
            ->leftJoin('Cursos.Materias as B','A.ID_MATERIA','=','B.ID')
            ->where('B.ESTADO','=','A')
            ->select('A.ID','A.NOMBRE_GRUPO','B.NOMBRE_MATERIA','A.NOMBRE_INSTRUCTOR','A.FECHAINI','A.FECHAFIN','A.ESTADO'))
            ->add_column('OPCIONES', '<label class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_theme_info_grupo" data-popup="tooltip" data-placement="bottom" data-original-title="Editar" onclick="verGrupo({{$ID}})"><i class="fa fa-edit"></i></label>')
            ->make(true);
    }

    public function forGuardaMateria($request)
    {
        $array_response = [];
        $array_response['status'] = 200;
        $array_response['message'] = 'La materia  ' . $request->materia . ' se ha guardado correctamente';
        if ($request->materia != null) {
            $materia = new Materias();
            $materia->NOMBRE_MATERIA = $request->materia;
            $materia->DESCRIPCION = $request->observacion;
            $materia->ESTADO = $request->estado;
            $materia->save();
        }
        else{
            $array_response['status']=404;
            $array_response['message']='No hay datos para registrar';
        }
        return $array_response;
    }

    public function forActualizaMateria($id,$request){
        $array_response=[];
        $array_response['status']=200;
        $array_response['message']='Registro guardado correctamente';
        $UpEstado=Materias::where('ID','=',$id)
            ->update(['NOMBRE_MATERIA'=>$request->materia,'DESCRIPCION'=>$request->observacion,'ESTADO'=>$request->estado]);
        if($UpEstado==0){
            $array_response['status']=404;
            $array_response['message']='No se pudo actualizar la materia  '.$request->materia;
        }
        return $array_response;
    }

    public function buscaDatosMateria($id){
        $datosmateria= DB::connection('sqlsrv_modulos')
            ->table('Cursos.Materias as A')
            ->where('A.ID','=',$id)
            ->select('A.ID', 'A.NOMBRE_MATERIA', 'A.DESCRIPCION', 'A.ESTADO')
            ->get();
        return $datosmateria;
    }

    public function buscaDatosGrupo($id){
        $datosgrupo= DB::connection('sqlsrv_modulos')
            ->table('Cursos.Grupos as A')
            ->where('A.ID','=',$id)
            ->select('A.ID','A.NOMBRE_GRUPO','A.ID_MATERIA',DB::raw('SUBSTRING(A.NOMBRE_INSTRUCTOR,1,CHARINDEX(\'-\',A.NOMBRE_INSTRUCTOR)-1) AS CEDULA'), DB::raw('SUBSTRING(A.NOMBRE_INSTRUCTOR,CHARINDEX(\'-\',A.NOMBRE_INSTRUCTOR)+1,LEN(A.NOMBRE_INSTRUCTOR))AS NOMBRE'),DB::raw('CONVERT(date,A.FECHAINI,103) AS FECHAINI'),DB::raw('CONVERT(date,A.FECHAFIN,103) AS FECHAFIN'),'A.ESTADO')
            ->get();
        return $datosgrupo;
    }

    public function forGuardaGrupo($request)
    {
        if($request->ajax()){
            $array_response = [];
            $array_response['status'] = 200;
            $array_response['message'] = 'El grupo  ' . $request->grupo . ' se ha guardado correctamente';
            if ($request->grupo != null) {
                $grupo = new Grupos();
                $grupo->ID_MATERIA = $request->selmateria;
                $grupo->NOMBRE_GRUPO = $request->grupo;
                $grupo->NOMBRE_INSTRUCTOR = $request->instructorc.'-'.$request->instructorn;
                $grupo->FECHAINI = $request->fecini;
                $grupo->FECHAFIN = $request->fecfin;
                $grupo->ESTADO = $request->estadog;
                $grupo->save();
            }
            else{
                $array_response['status']=404;
                $array_response['message']='No hay datos para registrar';
            }
            return $array_response;
        }
        else{
            abort(401);
        }
    }

    public function forActualizaGrupo($id,$request){
        $array_response=[];
        $array_response['status']=200;
        $array_response['message']='Registro guardado correctamente';
        $UpEstado=Grupos::where('ID','=',$id)
            ->update(['NOMBRE_GRUPO'=>$request->grupo,'ID_MATERIA'=>$request->selmateria,'NOMBRE_INSTRUCTOR'=>$request->instructorc.'-'.$request->instructorn,'FECHAINI'=>$request->fecini,'FECHAFIN'=>$request->fecfin,'ESTADO'=>$request->estadog]);
        if($UpEstado==0){
            $array_response['status']=404;
            $array_response['message']='No se pudo actualizar el grupo  '.$request->grupo;
        }
        return $array_response;
    }

    public function forComboGrupos(){
        $listaComboGrupos=DB::connection('sqlsrv_modulos')
            ->table('Cursos.Grupos as A')
            ->where('A.ESTADO','=','A')
            ->select('A.ID', 'A.NOMBRE_GRUPO')
            ->lists('NOMBRE_GRUPO','ID');
        return $listaComboGrupos ;
    }

    public function forAsignacion($idg){
        DB::connection('sqlsrv_modulos')->statement('SET ANSI_NULLS ON; SET ANSI_WARNINGS ON');
        return \Datatables::of(DB::connection('sqlsrv_modulos')
            ->table('Cursos.GruposPersonas as A')
            ->leftJoin('Cursos.Grupos as B','A.ID_GRUPO','=','B.ID')
            ->leftJoin('VS_DATOS_UATH as C','C.CEDULA','=',DB::raw('A.CEDULA COLLATE Modern_Spanish_BIN'))
            ->where('A.ESTADO','=','A')
            ->where('B.ESTADO','=','A')
            ->where('A.ID_GRUPO','=',$idg)
            ->select('A.ID','B.NOMBRE_GRUPO','A.CEDULA','C.APELLIDOS','C.NOMBRES','A.ASISTENCIA','A.ESTADOMATERIA','A.ENVIOCORREO'))
            ->add_column('OPCIONES', '<label class="btn btn-icon text-danger" data-popup="tooltip" data-placement="bottom" data-original-title="Eliminar" onclick="eliminaAsignacion({{$ID}})"><i class="fa fa-close"></i></label>')
            ->make(true);
    }

    public function buscaDatosUath($cedula){
        DB::connection('sqlsrv_modulos')->statement('SET ANSI_NULLS ON; SET ANSI_WARNINGS ON');
        $datospersona= DB::connection('sqlsrv_modulos')
            ->table('VS_DATOS_UATH as A')
            ->where('A.CEDULA','=',$cedula)
            ->select('A.CEDULA','A.APELLIDOS','A.NOMBRES','A.EMAIL')
            ->get();
        if(empty($datospersona)){
            return '0';
        }
        else{
            return $datospersona;
        }
    }

    public function forGuardaAsigna($request)
    {
        if($request->ajax()){
            $array_response = [];
            $array_response['status'] = 200;
            $array_response['message'] = 'El participante  ' . $request->apellidos . ' ' .$request->nombres . ' se ha guardado correctamente';
            /*VERIFICA SI EXISTE*/
            $existe= DB::connection('sqlsrv_modulos')
                ->table('Cursos.GruposPersonas as A')
                ->where('A.CEDULA','=',$request->cedula)
                ->where('A.ID_GRUPO','=', $request->selgrupos)
                ->where('A.ESTADO','=','A')
                ->select('A.CEDULA')
                ->count();
            /*FIN*/
            if ($request->cedula != null && $existe==0) {
                $asigna = new GruposPersonas();
                $asigna->ID_GRUPO = $request->selgrupos;
                $asigna->CEDULA = $request->cedula;
                $asigna->EMAIL = $request->email;
                $asigna->NOTA = 0.00;
                $asigna->ASISTENCIA = 0.00;
                $asigna->FECHAINGRESO = Utils::getDateSQL();
                $asigna->FECHAACTUALIZA =  NULL;
                $asigna->DETALLE = '';
                $asigna->ESTADOMATERIA = 'I';
                $asigna->ESTADO = 'A';
                $asigna->ENVIOCORREO = '0';
                $asigna->save();
            }
            else{
                $array_response['status']=404;
                $array_response['message']='Ya existe el registro para la cédula '.$request->cedula.' o los datos son incorrectos';
            }
            return $array_response;
        }
        else{
            abort(401);
        }
    }

    public function forBorraAsigna($id){
        $array_response=[];
        $array_response['status']=200;
        $array_response['message']='Registro eliminado correctamente';
        $UpEstado=GruposPersonas::where('ID','=',$id)
            ->update(['ESTADO'=>'X','FECHAACTUALIZA'=>Utils::getDateSQL()]);
        if($UpEstado==0){
            $array_response['status']=404;
            $array_response['message']='No se pudo eliminar el registro';
        }
        return $array_response;
    }
}