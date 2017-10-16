<?php
namespace UGCore\Http\Controllers\Selection;

use Illuminate\Http\Request;

use UGCore\Core\Entities\Selections\MeritTypeDocumentField;
use UGCore\Core\Repositories\Selections\SelectionRepository;
use UGCore\Http\Controllers\Controller;
use UGCore\Core\Entities\Selections\Merittypedocument;
use URL;
use Messages;
use Validator;
use Input;

/**
 * Class TypeDocumentController
 *
 * @author  The scaffold-interface created at 2016-07-28 09:03:28pm
 * @link  https://github.com/amranidev/scaffold-interfac
 */
class TypeDocumentController extends Controller
{
    protected $path = "selection.typedocument";
    protected $objRPY;

    public function __construct(SelectionRepository $objRPY)
    {
        $this->objRPY = $objRPY;
    }

    public function index()
    {
        return view($this->path . '.index');
    }

    public function datatableTypeDocuments()
    {
        return $this->objRPY->forDataTypeDocuments();
    }

    public function store(Request $request)
    {
        $this->validator($request);

        $nametable = $request->nametable;
        if ($request->nametable != null) {
            if (!\Schema::connection('sqlsrv_modulos')->hasTable('doc_' . $nametable)) {
                \Schema::connection('sqlsrv_modulos')->create('Concourse.doc_' . $nametable, function ($table) {
                    $table->increments('id')->unique(); //primary key
                    $table->integer('concourse_id')->unsigned()->nullable();
                    $table->timestamps();
                    $table->string('status', 1)->default('A');
                    $table->integer('created_by')->unsigned()->nullable();
                    $table->integer('updated_by')->unsigned()->nullable();
                });
            } else {
                return redirect()->back()->withInput()->withErrors("EL NOMBRE DE LA TABLA $nametable YA SE ENCUENTRA EN USO");
            }
        }


        $objTypeDocument = new Merittypedocument();
        $objTypeDocument->name = $request->name;
        $objTypeDocument->description = $request->description;
        $objTypeDocument->prefix = $request->prefix;
        $objTypeDocument->updated_ip = $request->ip();
        $objTypeDocument->updated_by = \Auth::user()->id;
        $objTypeDocument->created_ip = $request->ip();
        $objTypeDocument->created_by = \Auth::user()->id;
        $objTypeDocument->nametable = $nametable;
        $objTypeDocument->status = 'A';
        $objTypeDocument->save();

        Messages::infoRegister($request->name, 'el registro');
        return redirect()->route($this->path . '.index');
    }

    public function edit($id)
    {
        $objTypeDocument = Merittypedocument::find($id);
        $this->notFound($objTypeDocument);
        return view($this->path . '.edit')->with(['objTypeDocument' => $objTypeDocument]);
    }

    public function fieldsTypeDocuments($id)
    {
        $objTypeDocument = Merittypedocument::find($id);
        $this->notFound($objTypeDocument);
        if($objTypeDocument->nametable==null){
            Messages::errorRegisterCustom("No tienes una tabla de base de datos asignada al documento");
            return redirect()->route($this->path . '.index');
        }

        return view($this->path . '.fields')->with(['objTypeDocument' => $objTypeDocument]);
    }

    public function getFieldDocument($id){
        try {
            $objFieldDocument = MeritTypeDocumentField::find($id);
            if ($objFieldDocument == null) {
                return response()->json(['data' => "Objeto no encontrado", 'messaage' => false], 404);
            }


            return response()->json(['data' => $objFieldDocument->getAttributes(), 'messaage' => true], 200);
        }catch (\Exception $ex){
            return response()->json(['data' => "Error de proceso: ".$ex->getMessage(), 'messaage' => false], 404);
        }
    }

    private $idFielDocument=0;
    public function saveFieldDocument(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'titulo'=>'required|names',
            'nombre'=>'required|namefield',
            'estado'=>'required|in:A,I'
        ],[]);
        if ($validator->fails()) {
            return response()->json(["data" => $validator->messages(), "messaage" => false], 422);
        }

        $objTypeDocument = Merittypedocument::find($id);
        if ($objTypeDocument == null) {
            return response()->json(['data' => "Objeto no encontrado", 'messaage' => false], 404);
        }

        try{


            if ($objTypeDocument->nametable != null) {
                $nameTable=$objTypeDocument->nametable;
                if (\Schema::connection('sqlsrv_modulos')->hasTable('doc_' . $objTypeDocument->nametable)) {

                    \DB::connection('sqlsrv_modulos')->transaction(function()use($request,$id,$nameTable){
                        $objFieldDocument=new MeritTypeDocumentField();
                        $objFieldDocument->merittypedocument_id=$id;
                        $objFieldDocument->name=$request->titulo;
                        $objFieldDocument->fields=$request->nombre;
                        $objFieldDocument->regexdata=$request->validacion;
                        $objFieldDocument->status=$request->estado;
                        $objFieldDocument->user_created=\Auth::user()->id;
                        $objFieldDocument->user_updated=\Auth::user()->id;
                        $objFieldDocument->save();

                        \Schema::connection('sqlsrv_modulos')->table('Concourse.doc_' .$nameTable, function ($table) use($nameTable,$request,$id) {
                            $table->string($request->nombre,100)->nullable();
                        });
                        $this->idFielDocument=$objFieldDocument->id;
                    });

                    return response()->json(["data" => "Registro actualizado correctamente","code"=>$this->idFielDocument, "messaage" => true],200);

                } else {
                    return response()->json(['data' => "Tabla de base de datos no encontrada", 'messaage' => false], 404);
                }
            }

        }catch (\Exception $ex){
            return response()->json(["data" => "Error de proceso interno: ".$ex->getMessage(), "messaage" => true],500);
        }
    }

    public function updateFieldDocument(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'titulo'=>'required|names',
            'estado'=>'required|in:A,I'
        ],[]);
        if ($validator->fails()) {
            return response()->json(["data" => $validator->messages(), "messaage" => false], 422);
        }

        $objFieldDocument = MeritTypeDocumentField::find($id);
        if ($objFieldDocument == null) {
            return response()->json(['data' => "Objeto no encontrado", 'messaage' => false], 404);
        }

        try{
            $objFieldDocument->name=$request->titulo;
            $objFieldDocument->regexdata=$request->validacion;
            $objFieldDocument->status=$request->estado;
            $objFieldDocument->user_updated=\Auth::user()->id;
            $objFieldDocument->save();
            return response()->json(["data" => "Registro actualizado correctamente", "messaage" => true],200);
        }catch (\Exception $ex){
            return response()->json(["data" => "Error de proceso interno: ".$ex->getMessage(), "messaage" => true],500);
        }
    }


    public function update(Request $request, $id)
    {
        $this->validator($request);

        $objTypeDocument = Merittypedocument::findOrFail($id);
        $this->notFound($objTypeDocument);

        $nametable = $request->nametable;

        if ($objTypeDocument->nametable == '') {
            if ($request->nametable != null) {
                if (!\Schema::connection('sqlsrv_modulos')->hasTable('doc_' . $nametable)) {
                    \Schema::connection('sqlsrv_modulos')->create('Concourse.doc_' . $nametable, function ($table) {
                        $table->increments('id')->unique(); //primary key
                        $table->integer('merit_input_detail_id')->unsigned();
                        $table->timestamps();
                        $table->string('status', 1)->default('A');
                        $table->integer('created_by')->unsigned()->nullable();
                        $table->integer('updated_by')->unsigned()->nullable();
                    });
                } else {
                    return redirect()->back()->withInput()->withErrors("EL NOMBRE DE LA TABLA $nametable YA SE ENCUENTRA EN USO");
                }
            }
        }else{
            if($objTypeDocument->nametable!=$nametable){
                return redirect()->back()->withInput()->withErrors("EL NOMBRE DE LA TABLA $objTypeDocument->nametable NO PUEDE SER MODIFICADO POR $nametable");
            }
        }


        $objTypeDocument->name = $request->name;
        $objTypeDocument->description = $request->description;
        $objTypeDocument->prefix = $request->prefix;
        $objTypeDocument->status = $request->status;
        $objTypeDocument->updated_ip = $request->ip();
        $objTypeDocument->updated_by = \Auth::user()->id;
        $objTypeDocument->nametable = $nametable;

        $objTypeDocument->save();
        Messages::infoRegister($request->name, 'el registro');;
        return redirect()->route($this->path . '.index');
    }

    private function validator(Request $request)
    {
        $tild = "ñÑáéíóúÁÉÍÓÚ";
        $messsages = array(
            'name.required' => 'El campo nombre es requerido',
            'name.regex' => 'El campo nombre no debe empezar con espacios adem&aacute;s solo se adminte contenido de letras, espacios y par&eacute;ntisis',

            'description.required' => 'El campo descripci&oacute;n es requerido',
            'description.regex' => 'El campo descripci&oacute;n no debe empezar con espacios adem&aacute;s solo se admite contenido de letras, espacios y par&eacute;ntesis',

            'prefix.required' => 'El campo prefijo  es requerido',
            'prefix.regex' => 'El campo prefijo solo se admite contenido alfanum&eacute;rico y debe terminar en "-"',

            'status.required' => 'El campo estado es requerido',
            'status.in' => 'El estado solo puede ser Activo o Inactivo',

            'nametable.regex' => 'El campo tabla solo debe ser letras min&uacute;sculas y guiones bajo (a-z _)',

        );



        $rules = array(
            'name' => "regex:/^[A-Za-z$tild][0-9A-Za-z$tild \:\;\.\,()\/\t]*$/i|required|unique:sqlsrv_modulos.Concourse.merittypedocuments,name,{$request->typedocument}",
            'description' => "regex:/^[A-Za-z$tild()0-9][A-Za-z0-9$tild() \/\.\,\t]*$/i|required",
            'prefix' => "regex:/^[A-Z][A-Za-z \t]*[-]$/i|required"
        );

        if($request->nametable!=null){
            $rules['nametable']="max:15|regex:/^[a-z][a-z_]+$/i";
        }

        if ($request->_method == 'PUT') {
            $rules['status'] = 'required|in:A,I';
        }

        $this->validate($request,$rules,$messsages);
    }
}
