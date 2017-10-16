<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 09/08/17
 * Time: 12:34
 */

namespace UGCore\Http\Controllers\Preprofessional;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use UGCore\Core\Entities\Preprofessional\PreprofessionalDocuments;
use UGCore\Core\Entities\Preprofessional\PreprofessionalUsers;
use UGCore\Core\Repositories\Preprofesionales\PreprofessionalRepository;
use UGCore\Http\Controllers\Ajax\SelectController;
use UGCore\Http\Controllers\Controller;

class StudentProcessController extends Controller
{
    public function indexInscripcion(){
        $objSelectController=new SelectController();
        $process=PreprofessionalUsers::where('document','=',\Auth::user()->name)->get();
        return view('preprofessional.student.inscription')->with(['careers'=>$objSelectController->getStudentCarrera(Auth::user()->name),'process'=>$process]);
    }

    public function validateInscripcion($career){
        $objPreprofesionalRPY=new PreprofessionalRepository();
        return $objPreprofesionalRPY->forStudentAccessValid($career,\Auth::user()->name);
    }

    public function saveInscripcion(Request $request,$career){
        $this->validate($request,['emailInstitucional'=>'required|email',
            'emailPersonal'=>'required|email','telefono'=>'required|numeric','direccion'=>'required']);
        $objPreprofesionalRPY=new PreprofessionalRepository();
        return $objPreprofesionalRPY->forStudentAccessInscription($request,$career,( Auth::user()));
    }


    public function indexDocument(Request $request)
    {//->with(['careers'=>$objSelectController->getStudentCarrera(Auth::user()->name)]);
        $career=$request->careers;
        if($career==null){
            $objSelectController=new SelectController();
            $careers=$objSelectController->getStudentCarrera(Auth::user()->name);
            return view('preprofessional.student.formatstudent',compact('process','careers','career'));
        }else{
            $process=PreprofessionalUsers::where('document','=',\Auth::user()->name)
                ->where('cod_carrer','=',$career)->first();
            return view('preprofessional.student.formatstudent',compact('process','career'));
        }

    }

    public function downloadDocuments($value)
    {
        switch ($value){
            case '1':
                $file='SolicitudInscripcionPPP.docx';
                $typeaplication = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                break;
            case '2':
                $typeaplication = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                $file = 'SolicitudInscripcionPPP.docx';
                break;
            case '3':
                $typeaplication = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                $file = 'ActaDeCompromisoPPP.docx';
                break;
            case '4':
                $typeaplication = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                $file = 'CartaAceptacionCompromisoPPP.docx';
                break;
            case '5':
                $typeaplication = 'tipoaplication';
                $file = 'FichaDatosGeneralesPPP.xlsx';
                break;

            case '6':
                $typeaplication = 'tipoaplication';
                $file = 'FichaEvaluacionRendimientoInstitucionPPP.xlsx';
                break;

            case '7':
                $typeaplication = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                $file = 'CertificadoTutorPPP.docx';
                break;
            case '8':
                $typeaplication = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                $file = 'CertificadoInstitucionPPP.docx';
                break;
        }

        $fileContent=\Storage::disk('ftp')->get("MODULOS/PREPROFESIONALES/DOCUMENTOS/$file");
        return \Response::make($fileContent, '200', array(
            'Content-Type' => $typeaplication,
            'Content-Disposition' => 'attachment; filename="'.$file.'"'
        ));


    }


    public function uploadDocument(){

        $objSelectController=new SelectController();
        $process=PreprofessionalUsers::where('document','=',\Auth::user()->name)->get();
        return view('preprofessional.student.uploadDocument')->with(['careers'=>$objSelectController->getStudentCarrera(Auth::user()->name),'process'=>$process]);

    }
}