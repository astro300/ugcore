<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 30/5/2017
 * Time: 9:24
 */

namespace UGCore\Core\Entities\Security;


use UGCore\Core\Entities\CoreModel;

class RolesOption extends CoreModel
{
    protected $table ="roles_option";

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}