<?php

namespace UGCore\Http\Controllers\Security;

use UGCore\Core\Entities\Security\Option;
use UGCore\Core\Repositories\Security\OptionsRepository;
use UGCore\Http\Controllers\Controller;



use DB;
use Illuminate\Http\Request;

use Messages;

class OptionsController extends Controller {
	protected $objRPY;
	protected $path="admin.options.";
	public function __construct(OptionsRepository $objRPY) {
		$this->objRPY = $objRPY;
	}


	public function index(Request $request) {
		return view($this->path.'index')
			->with(['options'=>$this->objRPY->forScope($request->scope),'scope'=>$request->scope]);
	}

	public function create() {
		return view($this->path.'create')->with(
			'options',$this->objRPY->forSelect('A'));
	}

	public function store(Request $request) {
	    $this->validate($request,[
            'name' => 'min:4|max:50|required',
            'icons' => 'min:4|max:50',
            'parameters' => 'min:4|max:250',
            'url' => 'min:4|max:250',
            'prefix' => 'numeric|required',
        ]);
		$this->objRPY->forStore($request);
		Messages::infoRegister($request->name,'la opci&oacute;n');
		return redirect()->route($this->path.'index');
	}

	public function edit(Option $option) {
		return view($this->path.'edit')->with(['objOption'=>$option
												,'options'=>$this->objRPY->forSelect('A')]);
	}

	public function update(Request $request, Option $option) {//
        $this->validate($request,[
            'name' => 'min:4|max:50|required',
            'parameters' => 'min:4|max:250',
            'url' => 'min:4|max:250',
            'prefix' => 'numeric|required',
        ]);
		$this->objRPY->forUpdate($request,$option);
		Messages::infoRegister($request->name,'La opci&oacute;n');
		return redirect()->route($this->path.'index');
	}
	public function destroy( Option $option) {
			   $name=$option->name;
            $option->delete();
				Messages::errorRegister($name,'La opci&oacute;n');
		return redirect()->route($this->path.'index');
	}
}
