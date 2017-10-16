<?php

/**
 * Created by PhpStorm.
 * User: eliberio
 * Date: 28/11/16
 * Time: 14:12
 */

namespace UGCore\Http\Requests\Selection;

use UGCore\Http\Requests\Request;

class DataPersonRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'cedula'=>"required|unique:sqlsrv.users,name,{$this->users}",
                    'email'=>"required|email|unique:sqlsrv.users,email,{$this->users}",
                    'first_name' => 'min:4|max:50|required',
                    'last_name' => 'min:4|max:50|required',
                    'password' => 'confirmed|min:4'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return ['description' => 'min:4|max:250|required','name' => 'min:4|max:250|required',  'date_range'=>'required'];
            }
        }
    }

    public function messages()
    {
        return [
            'first_name.required' => 'El campo nombre es requerido!',
            'last_name.required' => 'El campo apellido es requerido!'
        ];
    }
}