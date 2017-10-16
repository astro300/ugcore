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

class QuestionsRequest  extends FormRequest
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
                    'description' => 'min:4|max:250|required|unique:sqlsrv_modulos.Surveys.questions,name',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return ['description' => 'min:4|max:250|required'];
            }
        }
    }

//


    public function messages()
    {
        return [
            'description.required' => 'El campo nombre de pregunta es requerido!',
            'description.unique' => 'Ya existe una pregunta con el mismo nombre!'
        ];
    }
}
