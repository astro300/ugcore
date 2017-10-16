<?php
/**
 * Created by PhpStorm.
 * User: jairoman
 * Date: 17/3/2017
 * Time: 14:44
 */

namespace UGCore\Core\Repositories\Uath;

use UGCore\Core\Entities\SendEmailUser;
use UGCore\Core\Entities\Uath\GruposPersonas;
use Mail;
use Utils;
use Messages;
use Alerts;
use DB;

class RegistroRepository
{
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
            ->leftJoin('VS_DATOS_UATH as C','C.CEDULA','=',DB::connection('sqlsrv_modulos')->raw('A.CEDULA COLLATE Modern_Spanish_BIN'))
            ->where('A.ESTADO','=','A')
            ->where('B.ESTADO','=','A')
            ->where('A.ID_GRUPO','=',$idg)
            ->orderBy('C.APELLIDOS')
            ->select('A.ID','B.NOMBRE_GRUPO','A.CEDULA','C.APELLIDOS','C.NOMBRES','A.ASISTENCIA','A.ESTADOMATERIA','A.ENVIOCORREO'))
            ->make(true);
    }

    public function forGuardaAsistencia($id,$datos){
        $array_response=[];
        $array_response['status']=200;
        $array_response['message']='Registro guardado correctamente';
        $ap='';$nota='0.00';
        if($datos=="S"){
            $ap='A';
            $nota='100';
        }
        else{
            $ap='R';
            $nota='0.00';
        }
        $UpEstado=GruposPersonas::where('ID','=',$id)
            ->update(['ASISTENCIA'=>$nota,'ESTADOMATERIA'=>$ap,'FECHAACTUALIZA'=>Utils::getDateSQL()]);
        if($UpEstado==0){
            $array_response['status']=404;
            $array_response['message']='No se pudo guardar el registro';
        }
        else{
            /*ENVIA CERTIFICADO AL CORREO*/
            $grupo_persona = GruposPersonas::find($id);
            if($ap=='A' && $grupo_persona->ENVIOCORREO=="0"){
                $email = $grupo_persona->EMAIL;
                //SendEmailUser::create(['parameters'=>['email'=>'jairo.csatroa@'],'function_system'=>'uath','body'=>'uath.formacion.registro.email']);
                Mail::send('uath.formacion.registro.email', ['user'=>'usuario parametro'], function ($message) use($email,$id) {
                    $message->to($email);
                    $message->subject('test email');
                    $message->priority(1);
                    //$message->attach('C:/chat/pdf_fecha_limite.pdf');

                    /*ACTUALIZA EL ESTADO DEL ENVIO AL CORREO*/
                    $UpEstadoCorreo=GruposPersonas::where('ID','=',$id)
                        ->update(['ENVIOCORREO'=>'1','FECHAACTUALIZA'=>Utils::getDateSQL()]);
                });
            }
        }
        return $array_response;
    }
}