<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 14/08/17
 * Time: 15:27
 */

namespace UGCore\Core\Entities\Comun;



use UGCore\Core\Entities\CoreModel;

class AutoridadCatalog extends CoreModel
{
    protected $connection= "sqlsrv_modulos";
    protected $table = 'catalogos.director_career';
    protected $fillable=['nombres','email',
        'tipoAutoridad',
        'facultad',
        'carrera',
        'nuic'];

    public static function getNameAutoridad($type,$career){
      $objAutoridad=  self::where('carrera','=',$career)
            ->where('tipoAutoridad','=',$type)->firstOrFail();

      return ['nombres'=>$objAutoridad->nombres,'email'=>$objAutoridad->email];
    }
}