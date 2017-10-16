<?php

namespace UGCore\Core\Entities\Security;

use UGCore\Core\Entities\CoreModel;

class Bitacore extends CoreModel
{
      protected $table ="users_navigation";

    protected $fillable=['user_id','ip','vpath'];
}
