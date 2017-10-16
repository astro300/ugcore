<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 16/08/17
 * Time: 10:49
 */

function currentUser()
{
    return auth()->user();
}

function ifArrayNull($array,$key,$default=''){
    if(array_key_exists($key,$array)){
        return $array[$key];
    }else{
        return $default;
    }
}