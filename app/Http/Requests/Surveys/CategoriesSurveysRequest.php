<?php

namespace UGCore\Http\Requests\Surveys;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoriesSurveysRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'name' => 'min:4|max:50|required|alpha|unique:sqlsrv_modulos.Surveys.categories_surveys,name',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return ['name' => 'min:4|max:50|required|alpha'];
            }
        }
    }

//


    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es requerido!'
        ];
    }
}
