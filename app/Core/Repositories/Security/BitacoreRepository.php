<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 23/5/2017
 * Time: 12:55
 */

namespace UGCore\Core\Repositories\Security;


use UGCore\Core\Entities\Security\Bitacore;

class BitacoreRepository
{
    public function forStore($ip,$vPath,$user){
            $objBitacore= new Bitacore();
            $objBitacore->user_id=$user;
            $objBitacore->ip=$ip;
            $objBitacore->vpath=$vPath;
            $objBitacore->save();
    }
}