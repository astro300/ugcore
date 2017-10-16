<?php
namespace UGCore\Http\Controllers\Selection;

use Illuminate\Http\Request;
use UGCore\Core\Repositories\Selections\SelectionRepository;
use UGCore\Http\Controllers\Controller;
use UGCore\Core\Entities\Selections\MeritCategory;
use URL;
use Messages;
use Validator;
use Input;

class CategoryController extends Controller
{
    protected $path = "selection.category";
    protected $objRPY;


    public function __construct(SelectionRepository $objRPY)
    {
        $this->objRPY = $objRPY;
    }

    public function index()
    {
        return view($this->path . '.index');
    }

    public function datatableCategories()
    {
        return $this->objRPY->forDataCategories();
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $objCategory = new MeritCategory();
        $objCategory->type = $request->type;
        $objCategory->name = strtoupper($request->name);
        $objCategory->status = 'A';
        $objCategory->updated_ip = $request->ip();
        $objCategory->updated_by = \Auth::user()->id;
        $objCategory->created_ip = $request->ip();
        $objCategory->created_by = \Auth::user()->id;
        $objCategory->save();
        Messages::infoRegister($request->name, 'el registro');
        return redirect()->route($this->path . '.index');
    }

    public function edit($id)
    {
        $objCategory = MeritCategory::find($id);
        $this->notFound($objCategory);
        return view($this->path . '.edit')->with(['objCategory' => $objCategory]);
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validator($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $objCategory = MeritCategory::find($id);
        $this->notFound($objCategory);
        $objCategory->type = $request->type;
        $objCategory->name = strtoupper($request->name);
        $objCategory->updated_ip = $request->ip();
        $objCategory->updated_by = \Auth::user()->id;
        $objCategory->status = $request->status;
        $objCategory->save();
        Messages::warningRegister(strtoupper($request->name), 'el registro');;
        return redirect()->route($this->path . '.index');
    }


    private function validator(Request $request)
    {
        $tild = "ñÑáéíóúÁÉÍÓÚ";
        $messsages = array(
            'type.required' => 'El campo tipo categor&iacute;a es requerido',
            'type.numeric' => 'El campo tipo categor&iacute;a debe ser num&eacute;rico',
            'name.required' => 'El campo nombre categor&iacute;a es requerido',
            'name.regex' => 'El campo nombre categor&iacute;a no debe empezar con espacios adem&aacute;s solo se admite contenido de letras y espacios',
            'status.required' => 'El campo estado es requerido',
            'status.in' => 'El estado solo puede ser Activo o Inactivo'
        );
        $rules = array(
            'type' => 'required|numeric',
            'name' => "regex:/^[A-Za-z$tild][A-Za-z$tild \t]*$/i|required|unique:sqlsrv_modulos.Concourse.merit_categories,name,{$request->category}",
        );

        if ($request->_method == 'PUT') {
            $rules['status'] = 'required|in:A,I';
        }
        return Validator::make($request->all(), $rules, $messsages);
    }
}
