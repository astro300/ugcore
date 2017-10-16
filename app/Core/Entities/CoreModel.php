<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 23/5/2017
 * Time: 12:58
 */

namespace UGCore\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Facades\UGCore\Facades\Utils;

class CoreModel extends Model
{
    public function scopeSearch($query,$name,$field='name'){
        return $query->where($field,'LIKE',"%$name%");
    }


    protected function getDateFormat()
    {
        return Utils::getFormatDateSQL(true,true);
    }
}