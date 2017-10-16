<?php

namespace UGCore\Facades;

use Messages;
class MessagesPreprofessional {

    public static function infoRegisterprocces(){
        Messages::infoRegisterCustom("Se ha registrado de forma exitosa!");
    }

    public static function infoRegisterassigment(){
        Messages::infoRegisterCustom("Se ha asignado de forma exitosa");
    }

    public static function infoRegisterassigmentemail(){
        Messages::infoRegisterCustom("Se ha asignado de forma exitosa, enviado correo al estudiane y docente tutor!");
    }

    public static function infocertifiqueemail(){
        Messages::infoRegisterCustom("Se envio correctamente la culminacion del proceso Practicias Pre Profesionales!");
    }

    public static function warningRegisterupdadate(){
        Messages::infoRegisterCustom("Se actualiza de forma exitosa!");
    }

    public static function warningRegisterVerif(){
        Messages::warningRegisterCustom("La cedula que ingreso no es valida o el estudiante no existe en el prospecto!");
    }

    public static function warningsession(){
        Messages::warningRegisterCustom("La sesion a expirado, favor iniciar sesion nuevamente");
    }

    public static function warningsessionAdmin(){
        Messages::warningRegisterCustom("No es un usuario Administrador");
    }

    public static function warningsessionTutor(){
        Messages::warningRegisterCustom("No es un usuario Tutor Academico o La sesion ha experirado, Favor iniciar sesion nuevamente");
    }

    public static function searchEstudent(){
        Messages::infoRegisterCustom("La busqueda ha sido exitosa!");
    }

    public static function addnoteEstudent(){
        Messages::infoRegisterCustom("Se ingreso correctamente");
    }
    public static function noteEstudent(){
        Messages::infoRegisterCustom("Se registraron correctamente las puntuaciones");
    }

    public static function warningValidaCa($document){
        Messages::warningRegisterCustom("El estudiante con numero de cedula ".$document." ya esta registrado en la CATEDRA !");
    }

    public static function warningValidadocument($document){
        Messages::warningRegisterCustom("El estudiante con numero de cedula ".$document." no esta regisrado en el Prospecto !");
    }

    public static function warningValidadocuments($document){
        Messages::warningRegisterCustom("El estudiante con numero de cedula ".$document." ya se encuentra regisrado en el Prospecto !");
    }

    public static function warningcathedrastore(){
        Messages::warningRegisterCustom("La catedra ya esta creada!");
    }

    public static function warningValidaCaEstu($document, $num_cate){
        Messages::warningRegisterCustom("No se puede asignar al estudiante con numero de cedula ".$document." ,debido que la ultima catedra realizada es la ".$num_cate." !");
    }

    public static function warningValidaCaEstudent($document){
        Messages::warningRegisterCustom("No se puede asignar al estudiante con numero de cedula ".$document." ,debido que no ha realizado ninguna catedra integradora..!");
    }

    public static function warningValidaCaEstuXathedra($document){
        Messages::warningRegisterCustom("No se puede asignar al estudiante con numero de cedula ".$document." ,debido que se encuentra ya realizando una catedra!");
    }

    public static function messageevaulation(){
        Messages::warningRegisterCustom("No hay estudiantes registrados para evaluar!");
    }

    public static function messageevaulationstudent(){
        Messages::warningRegisterCustom("No hay estudiantes registrados para mostrar!");
    }

    public static function emailProspects($estudent){
        Messages::infoRegisterCustom("Email enviado Correctamente al Estudiante: ".$estudent);
    }

    public static function ValidaStudent(){
        Messages::warningRegisterCustom("La cedula que ingreso no existe");
    }

    public static function ValidaStudentwarning($document){
        Messages::warningRegisterCustom("No existe registro de la cedula: ".$document." !");
    }

    public static function warninginDownloadPDF(){
        Messages::warningRegisterCustom("Para descargar el documento pdf debes tener 240 horas aprobadas!");
    }

    public static function warninginstitutionstore($nameinstitution){
        Messages::warningRegisterCustom("La Institucion :".$nameinstitution." ya esta creada!");
    }

    public static function warningstuudentpracticescatedra($namestudent){
        Messages::warningRegisterCustom("El estudiante :".$namestudent." no ha terminado de cumlminar las Catedras Integradoras, no puede continuar con el proceso!");
    }

    public static function warningstuudentpracticescat($namestudent){
        Messages::warningRegisterCustom("El estudiante :".$namestudent." esta realizando las Catedras Integradoras, no puede continuar con el proceso!");
    }

    public static function warningValidaInst($document){
        Messages::warningRegisterCustom("El estudiante con numero de cedula ".$document." ya esta asignado a una institucion!");
    }

    public static function RegistroActividad(){
        Messages::infoRegisterCustom("Se ha registrado la actividad de forma exitosa!");
    }

    public static function DeleteActividad(){
        Messages::infoRegisterCustom("Se ha eliminado la actividad de forma exitosa!");
    }


    public static function RegistroEvaluacion(){
        Messages::infoRegisterCustom("Se ha registrado la evaluacion de forma exitosa!");
    }

    public static function warningValidaEvaluation(){
        Messages::warningRegisterCustom("Usted ya realizo la evaluacion Estudiantil!");
    }

    public static function warningValidaActivityStudent(){
        Messages::warningRegisterCustom("No puede realizar las actividades, debido que no ha sido asignado ha una institucion para realizar el proceso...!");
    }

    public static function warningValidaEvaluationStudent(){
        Messages::warningRegisterCustom("No puede realizar la evaluacion, debido que no ha sido asignado ha una institucion para realizar el proceso...!");
    }

    public static function warningValidadocumentStudent(){
        Messages::warningRegisterCustom("No puede subir documentos, debido que no ha sido asignado ha una institucion para realizar el proceso...!");
    }


    public static function warningObtenerEstudentProspects(){
        Messages::warningRegisterCustom("No existen estudiantes para mostrar...!");
    }

    public static function warningEstudentInsitutciones(){
        Messages::warningRegisterCustom("No existen instituciones para mostrar...!");
    }

    public static function warningEstudentCathedra(){
        Messages::warningRegisterCustom("No existen Cátedras Integradoras para mostrar...!");
    }

    public static function warningEstudentActivity(){
        Messages::warningRegisterCustom("No puede crear otra actividad debido que ya cumplió o ha superado las 240 horas reglamentarias..!");
    }

    public static function warningdateActivity($date){
        Messages::warningRegisterCustom("No se puede crear la actividad debido que la fecha ".$date." ya esta registrada, favor registrar con otra fecha..!");
    }

    public static function warningUpdateActivityStudent($observation){
        Messages::warningRegisterCustom("No puede actualizar la actividad $observation, porque ya s encuentra aprobada");
    }

    public static function warningobjusers($document){
        Messages::warningRegisterCustom("No se obtuvo resultado de la cedula: ".$document);
    }

    public static function Registeruseradmin($nameusers){
        Messages::infoRegisterCustom("Se registro con exito el usuario: ".$nameusers);
    }

    public static function warninguseradmin($nameusers){
        Messages::warningRegisterCustom("el usuario: ".$nameusers." ya esta registrado");
    }

    public static function infoCustom($msg){
        Messages::infoRegisterCustom($msg);
    }
    public static function errorCustom($msg){
        Messages::errorRegisterCustom($msg);
    }
}