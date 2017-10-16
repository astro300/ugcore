<?php

namespace UGCore\Core\Entities\Preprofessional;

use Illuminate\Database\Eloquent\Model;
use UGCore\Core\Entities\CoreModel;

class Preprofessionalsuperadmin extends CoreModel
{
	 protected $conection="sqlsrv_modulos";
     protected $table ="modulos.Preprofesionales.users_administrator";

}