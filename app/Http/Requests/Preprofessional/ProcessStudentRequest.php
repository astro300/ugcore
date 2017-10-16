<?php

namespace UGCore\Http\Requests\Preprofessional;

use Illuminate\Foundation\Http\FormRequest;

class ProcessStudentRequest extends FormRequest
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
        return [
            'p1'=>'required|in:1,2,3,4,5',
            'p2'=>'required|in:1,2,3,4,5',
            'p3'=>'required|in:1,2,3,4,5',
            'p4'=>'required|in:1,2,3,4,5',
            'p5'=>'required|in:1,2,3,4,5',
            'p6'=>'required|in:1,2,3,4,5',
            'p7'=>'required|in:1,2,3,4,5',
            'p8'=>'required|in:1,2,3,4,5',
            'p9'=>'required|in:1,2,3,4,5',
            'p10'=>'required|in:1,2,3,4,5',
            'p11'=>'required|in:1,2,3,4,5',
            'Observacion1'=>'alpha_especial_numeric|max:500',
            'Observacion2'=>'alpha_especial_numeric|max:500',
            'Observacion3'=>'alpha_especial_numeric|max:500',
            'Observacion4'=>'alpha_especial_numeric|max:500',
            'Suggestions_std'=>'alpha_especial_numeric|max:500',
        ];
    }

    public function messages()
    {
        return [
            'p1.in'=>'El valor para el indicador 1 debe estar entre 1-5',
            'p1.required'=>'El valor para el indicador 1 es requerido',

            'p2.in'=>'El valor para el indicador 2 debe estar entre 1-5',
            'p2.required'=>'El valor para el indicador 2 es requerido',
            'p3.in'=>'El valor para el indicador 3 debe estar entre 1-5',
            'p3.required'=>'El valor para el indicador 3 es requerido',
            'p4.in'=>'El valor para el indicador 4 debe estar entre 1-5',
            'p4.required'=>'El valor para el indicador 4 es requerido',
            'p5.in'=>'El valor para el indicador 5 debe estar entre 1-5',
            'p5.required'=>'El valor para el indicador 5 es requerido',
            'p6.in'=>'El valor para el indicador 6 debe estar entre 1-5',
            'p6.required'=>'El valor para el indicador 6 es requerido',
            'p7.in'=>'El valor para el indicador 7 debe estar entre 1-5',
            'p7.required'=>'El valor para el indicador 7 es requerido',
            'p8.in'=>'El valor para el indicador 8 debe estar entre 1-5',
            'p8.required'=>'El valor para el indicador 8 es requerido',
            'p9.in'=>'El valor para el indicador 9 debe estar entre 1-5',
            'p9.required'=>'El valor para el indicador 9 es requerido',
            'p10.in'=>'El valor para el indicador 10 debe estar entre 1-5',
            'p10.required'=>'El valor para el indicador 10 es requerido',
            'p11.in'=>'El valor para el indicador 11 debe estar entre 1-5',
            'p11.required'=>'El valor para el indicador 11 es requerido',

            'Observacion1.alpha_especial_numeric'=>'La observación correspondiente a CONOCIMIENTOS Y HABILIDADES tiene caracteres inválidos',
            'Observacion2.alpha_especial_numeric'=>'La observación correspondiente a ASISTENCIA tiene caracteres inválidos',
            'Observacion3.alpha_especial_numeric'=>'La observación correspondiente a SOPORTE tiene caracteres inválidos',
            'Observacion4.alpha_especial_numeric'=>'La observación correspondiente a DISPONIBILIDAD DE ESPACIO Y RECURSOS tiene caracteres inválidos',

            'Suggestions_std.alpha_especial_numeric'=>'La recomendación general tiene caracteres inválidos',


            'Observacion1.max'=>'La observación correspondiente a CONOCIMIENTOS Y HABILIDADES sólo soporta 500 caracteres',
            'Observacion2.max'=>'La observación correspondiente al ASISTENCIA sólo soporta 500 caracteres',
            'Observacion3.max'=>'La observación correspondiente al SOPORTE sólo soporta 500 caracteres',
            'Observacion4.max'=>'La observación correspondiente al DISPONIBILIDAD DE ESPACIO Y RECURSOS sólo soporta 500 caracteres',

            'Suggestions_std.max'=>'La recomendación general sólo soporta 500 caracteres',


        ];
    }
}
