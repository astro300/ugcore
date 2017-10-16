<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 13/6/2017
 * Time: 12:25
 */

namespace UGCore\Core\Entities\Preprofessional;


use UGCore\Core\Entities\CoreModel;

class PreprofessionalActivityAnexo extends CoreModel
{
    protected $hidden=['created_at','updated_at'];
    protected $conection="sqlsrv_modulos";
    protected $table ="modulos.Preprofesionales.activity_anexos";

    public function activity(){
        return $this->belongsTo(PreprofessionalActivity::class,'id_activity','id');
    }

    protected $fillable = [
        'namefile'
    ];

}