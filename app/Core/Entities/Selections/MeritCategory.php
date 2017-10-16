<?php
namespace UGCore\Core\Entities\Selections;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use UGCore\Core\Entities\CoreModel;


class MeritCategory extends CoreModel
{
use SoftDeletes;

    public $timestamps = true;
     protected $fillable=['name','type','status'];

    protected $table = 'Concourse.merit_categories';
    protected $connection= "sqlsrv_modulos";


}
