<?php
/**
 * Created by PhpStorm.
 * User: eliberio
 * Date: 24/10/16
 * Time: 05:44 PM
 */

namespace UGCore\Http\Requests\Surveys;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SurveyRequest extends FormRequest
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
                    'name' => 'min:4|max:250|required|unique:sqlsrv_modulos.Surveys.questions,name',
                    'description' => 'min:4|max:550|required',
                    'date_range'=>'required'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return ['description' => 'min:4|max:250|required','name' => 'min:4|max:250|required',  'date_range'=>'required'];
            }
        }
    }

//


    public function messages()
    {
        return [
            'name.required' => 'El campo nombre de ecuesta es requerido!',
            'name.unique' => 'Ya existe una encuesta con el mismo nombre!',
            'date_range.required'=>'El rango de fechas es obligatorio!'
        ];
    }
}
