<?php

namespace UGCore\Core\Entities\Security;

use UGCore\Core\Entities\CoreModel;

class Option extends CoreModel
{
    protected $table ="options";
    protected $fillable=['name','prefix','url','parameters','icons','optionid','status'];

	public function option()
	{
	    return $this->belongsTo(Option::class);
	}
	public function options()
	{
	    return $this->hasMany(Option::class);
	}


}