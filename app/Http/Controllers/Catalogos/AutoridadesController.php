<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 14/08/17
 * Time: 14:42
 */
namespace UGCore\Http\Controllers\Catalogos;
use Illuminate\Http\Request;
use UGCore\Core\Entities\Comun\AutoridadCatalog;
use Messages;
use UGCore\Http\Controllers\Ajax\SelectController;
use UGCore\Http\Controllers\Controller;

class AutoridadesController extends Controller
{
    public function index(Request $request){
        $objSelectController=new SelectController();
        $objfaculty=$objSelectController->getfaculty();

        return view('catalogos.autoridades.index', ['facultades' => $objfaculty]);
    }

    public function edit(AutoridadCatalog $autoridade){
        $objSelectController=new SelectController();
        $objfaculty=$objSelectController->getfaculty();
        $carreras=$objSelectController->carreraFacultad($autoridade->facultad,'http');
        return view('catalogos.autoridades.edit', ['carreras'=>$carreras,'facultades' => $objfaculty,'autoridad'=>$autoridade]);
    }

    public function store(Request $request){
        $this->validate($request,['nombres'=>'required|names','email'=>'required|email',
            'tipoAutoridad'=>'required|in:1,2,3,4,5,6',
            'facultad'=>'required|numeric',
            'carrera'=>'required|numeric',
            'nuic'=>'required']);

            $objAutoridadCatalog= new AutoridadCatalog();
            $objAutoridadCatalog->fill($request->all());
            $objAutoridadCatalog->save();

        Messages::infoRegisterCustom('Registro guardado correctamente');
        return redirect()->route('admin.catalogos.autoridades.index');

    }

    public function update(Request $request,AutoridadCatalog $autoridade){
        $this->validate($request,['nombres'=>'required|names','email'=>'required|email',
            'tipoAutoridad'=>'required|in:1,2,3,4,5,6',
            'facultad'=>'required|numeric',
            'carrera'=>'required|numeric',
            'nuic'=>'required']);

        $autoridade->fill($request->all());
        $autoridade->save();

        Messages::infoRegisterCustom('Registro actualizado correctamente');
        return redirect()->route('admin.catalogos.autoridades.index');
    }

    public function datatable(){
        return \Datatables::of(AutoridadCatalog::orderBy('nombres', 'ASC')->get())
            ->add_column('actions', ' <a href="{{ route(\'admin.catalogos.autoridades.edit\', $id) }}"><span class="fa fa-pencil"></span>&nbsp;Editar</a> <br/> 
                                      <a  style="cursor: pointer" onclick="return alertConfirmDelete(\'la autoridad\',\'{{ route(\'admin.catalogos.autoridades.destroy\', $id) }}\')" class="text-danger"><span class="fa fa-trash"></span>&nbsp;Eliminar</a>')
            ->add_column('cargo', ' {{ config("dataselects.tipoAutoridad")[$tipoAutoridad]}}')
            ->make(true);
    }

    public function destroy(AutoridadCatalog $autoridade){
        $autoridade->delete();
        Messages::infoRegisterCustom('Registro eliminado correctamente');
        return redirect()->route('admin.catalogos.autoridades.index');
    }
}