<?php

namespace UGCore\Core\Entities\Preprofessional;

use Illuminate\Database\Eloquent\Model;
use UGCore\Core\Entities\CoreModel;

class PreprofessionalIntermediate extends CoreModel
{
	 protected $conection="sqlsrv_modulos";
     protected $table ="modulos.Preprofesionales.projects_has_users";

}