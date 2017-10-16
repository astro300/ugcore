<?php

namespace UGCore\Library;

use Messages;
use UGCore\Library\ApiRestComunicator;
use DB;
class UserSessionDependences
{
    public static function getTypeDependencesUnits($type = 'U', $father = '', $nuic = '', $token = '')
    {
        $objApiRestComunicator = new ApiRestComunicator();
        $objResponse           = $objApiRestComunicator->sendRecieveData('/api/information/units', [
            'type' => $type, 'father' => $father, 'nuic' => $nuic], true, 'POST');
        if ($objResponse['success']=='false') {
            if ($objResponse['expired']=='true') {
                $arrayResult                    = [];
                $arrayResult['data'] = [];
                $arrayResult['expired']         = $objResponse['expired'];
                return $arrayResult;
            }
        }
        $newArray=[];
        foreach($objResponse['message']['data'] as $key => $value) {
            $newkey = sprintf('%s',$key);
            $newArray["$newkey"] = $value;
        }
        $objArrayResult=['data'=>$newArray,'expired'=>$objResponse['expired']];

        return $objArrayResult;
    }


    public static function getTypeDependencesUnitsLocal($type = 'U', $father = '', $nuic = '', $token = '')
    {
        $arrData=[];
           switch ($type) {
                case 'U':
                    $content= DB::connection('sqlsrv_bdacademico')
                        ->table('TB_USUARIO_CARRERA as U')
                        ->join('TB_CARRERA as C','C.COD_CARRERA','=','U.COD_CARRERA')
                        ->join('TB_FACULTAD as F','C.COD_FACULTAD','=','F.COD_FACULTAD')
                        ->whereIn('U.USUARIO',function($query) use ($nuic){
                            $query->select('USUARIO')->from('TB_USUARIO')->where('COD_EMPLEADO','=',$nuic);
                        })
                        ->select('F.COD_FACULTAD AS COD_FACULTAD',DB::raw('RTRIM(F.NOMBRE) AS NOMBRE'))
                        ->groupBy('F.COD_FACULTAD', 'F.NOMBRE')->orderBy('NOMBRE','ASC')->lists('NOMBRE','COD_FACULTAD');
                    break;

                case 'C':
                    if($father=='0'){
                        $content= DB::connection('sqlsrv_bdacademico')
                            ->table('TB_USUARIO_CARRERA as U')
                            ->join('TB_CARRERA as C','C.COD_CARRERA','=','U.COD_CARRERA')
                            ->join('TB_FACULTAD as F','C.COD_FACULTAD','=','F.COD_FACULTAD')
                            ->whereIn('U.USUARIO',function($query) use ($nuic,$father){
                                $query->select('USUARIO')->from('TB_USUARIO')->where('COD_EMPLEADO','=',$nuic);
                            })
                            ->select(DB::raw('LTRIM(RTRIM(C.COD_CARRERA)) AS COD_CARRERA'),DB::raw('RTRIM(C.NOMBRE) AS NOMBRE'))
                            ->groupBy('C.COD_CARRERA', 'C.NOMBRE')->orderBy('NOMBRE','ASC')->lists('NOMBRE','COD_CARRERA');
                    }else{
                        $content= DB::connection('sqlsrv_bdacademico')
                            ->table('TB_USUARIO_CARRERA as U')
                            ->join('TB_CARRERA as C','C.COD_CARRERA','=','U.COD_CARRERA')
                            ->join('TB_FACULTAD as F','C.COD_FACULTAD','=','F.COD_FACULTAD')
                            ->whereIn('U.USUARIO',function($query) use ($nuic,$father){
                                $query->select('USUARIO')->from('TB_USUARIO')->where('COD_EMPLEADO','=',$nuic);
                            })->where('F.COD_FACULTAD','=',$father)
                            ->select('C.COD_CARRERA AS COD_CARRERA',DB::raw('RTRIM(C.NOMBRE) AS NOMBRE'),'C.M_E')
                            ->groupBy('C.COD_CARRERA', 'C.NOMBRE','C.M_E')->orderBy('NOMBRE','ASC')->get();
                    }
                    break;


                case 'E':
                    $content= DB::connection('sqlsrv_bdacademico')
                        ->table('TB_USUARIO_CARRERA as U')
                        ->join('TB_CARRERA as C','C.COD_CARRERA','=','U.COD_CARRERA')
                        ->join('TB_FACULTAD as F','C.COD_FACULTAD','=','F.COD_FACULTAD')
                        ->join('TB_ESCUELA as E','C.COD_ESCUELA','=','E.COD_ESCUELA')
                        ->whereIn('U.USUARIO',function($query) use ($nuic,$father){
                            $query->select('USUARIO')->from('TB_USUARIO')->where('COD_EMPLEADO','=',$nuic);
                        })->where('C.COD_CARRERA','=',$father)
                        ->select('E.COD_ESCUELA AS COD_ESCUELA',DB::raw('RTRIM(E.NOMBRE) AS NOMBRE'))
                        ->groupBy('E.COD_ESCUELA', 'E.NOMBRE')->orderBy('NOMBRE','ASC')->lists('NOMBRE','COD_ESCUELA');
                    if(count($content)==0)
                        $content=['0'=>'LA CARRERA NO POSEE ESCUELA'];
                    break;
            }

            if(is_array($content)){
                $arrData=Utils::encodeResponse($content);
            }else{

                $arrData=[];
            }

        return $arrData;
    }


    public static function getTypeDependencesUnitStudents($nuic, $token = '')
    {
        $objApiRestComunicator = new ApiRestComunicator();
        $objResponse           = $objApiRestComunicator->sendRecieveData('/api/information/carreraPeriodos', [
            'ced' => $nuic], true, 'POST');

        if (!$objResponse['success']) {
            if ($objResponse['expired']) {
                $arrayResult                    = [];
                $arrayResult['data'] = [];
                $arrayResult['expired']         = $objResponse['expired'];

                return $arrayResult;
            }
            abort($objResponse['code']);
        }

        $objArrayResult = [];

        $objArrayResult['data']    = $objResponse['message']['data'];
        $objArrayResult['expired'] = $objResponse['expired'];

        return $objArrayResult;
    }

    public static function getCareersTeacher($nuic)
    {
        $objApiRestComunicator = new ApiRestComunicator();
        $objResponse           = $objApiRestComunicator->sendRecieveData('/api/information/careersByNuicTeacher', [
            'nuic' => $nuic], true, 'POST');

       if (!$objResponse['success']) {
            if ($objResponse['expired']) {
                $arrayResult                    = [];
                $arrayResult['data'] = [];
                $arrayResult['expired']         = $objResponse['expired'];
                return $arrayResult;
            }
            abort($objResponse['code']);
        }

        $objArrayResult            = [];
        $objArrayResult['data']    = $objResponse['message']['data'];
        $objArrayResult['expired'] = $objResponse['expired'];
        return $objArrayResult;
    }


    public static function getTypeDependencesFacultad($type,$codes,$token=''){
        $objApiRestComunicator=new ApiRestComunicator();
        $objResponse=$objApiRestComunicator->sendRecieveData('/api/information/getNameByCode',[
            'type' =>$type,'codes' => $codes],true,'POST');

        if($objResponse['expired']){
            return null;
        }
        if(!$objResponse['success']){
            abort($objResponse['code']);
        }

        $objArrayResult=[];

        if(is_array($objResponse['message']['data'])){
            $objArrayResult=$objResponse['message']['data'];

        }else{
            Messages::errorRegisterCustom($objResponse['message']['message']);
        }
        return $objArrayResult;
    }

    public static function getTypeDependencesFaculties(){
        $objApiRestComunicator=new ApiRestComunicator();
        $objResponse=$objApiRestComunicator->sendRecieveData('/api/information/getFaculties',[],true,'POST');

        if (!$objResponse['success']) {
            if ($objResponse['expired']) {
                $arrayResult                    = [];
                $arrayResult['data'] = [];
                $arrayResult['expired']         = $objResponse['expired'];
                return $arrayResult;
            }
            abort($objResponse['code']);
        }

        $objArrayResult            = [];
        $objArrayResult['data']    = $objResponse['message']['data'];
        $objArrayResult['expired'] = $objResponse['expired'];
        return $objArrayResult;
    }

    public static function getTypeDependencesDean($scope){
        $objApiRestComunicator=new ApiRestComunicator();
        $objResponse=$objApiRestComunicator->sendRecieveData('/api/information/searchPersons',[
            'scope' =>$scope],true,'POST');

        if($objResponse['expired']){
            return null;
        }
        if(!$objResponse['success']){
            abort($objResponse['code']);
        }

        $objArrayResult=[];

        if(is_array($objResponse['message']['data'])){
            $objArrayResult=$objResponse['message']['data'];

        }else{
            Messages::errorRegisterCustom($objResponse['message']['message']);
        }
        return $objArrayResult;
    }


    public static function getTypeDependencesCareerFaculties($type='U',$father='',$nuic='',$token=''){
        $objApiRestComunicator=new ApiRestComunicator();
        $objResponse=$objApiRestComunicator->sendRecieveData('/api/information/getCareerFaculties',[
            'cod_facultie' => $father],true,'POST');

        if($objResponse['expired']){
            return null;
        }
        if(!$objResponse['success']){
            abort($objResponse['code']);
        }

        $objArrayResult=[];

        if(is_array($objResponse['message']['data'])){
            $objArrayResult=$objResponse['message']['data'];

        }else{
            Messages::errorRegisterCustom($objResponse['message']['message']);
        }
        return $objArrayResult;
    }

    public static function seachInfoForId($id){
        $objApiRestComunicator=new ApiRestComunicator();
        $objResponse=$objApiRestComunicator->sendRecieveData('/api/information/getNameByCode',[
            'type' => 'CARRERA','codes' => json_encode(array($id))],true,'POST');

        if($objResponse['expired']){
            return null;
        }


        if(!$objResponse['success']){
            abort($objResponse['code']);
        }
        $objArrayResult=[];

        if(is_array($objResponse['message']['data'])){

            $objArrayResult=$objResponse['message']['data'];
        }else{
            Messages::errorRegisterCustom($objResponse['message']['message']);

        }
        return $objArrayResult;
    }
    public static function getTypeDependencesStudents($nuic,$token=''){
        $objApiRestComunicator=new ApiRestComunicator();
        $objResponse=$objApiRestComunicator->sendRecieveData('/api/information/searchPersons',[
            'scope' => $nuic],true,'POST');

        if($objResponse['expired']){
            return null;
        }
        if(!$objResponse['success']){
            abort($objResponse['code']);
        }

        $objArrayResult=[];

        if(is_array($objResponse['message']['data'])){
            $objArrayResult=$objResponse['message']['data'];

        }else{
            Messages::errorRegisterCustom($objResponse['message']['message']);
        }
        return $objArrayResult;
    }
}
