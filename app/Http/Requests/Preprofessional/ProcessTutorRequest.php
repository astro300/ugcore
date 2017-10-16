<?php

namespace UGCore\Http\Requests\Preprofessional;

use Illuminate\Foundation\Http\FormRequest;

class ProcessTutorRequest extends FormRequest
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
            'n_visit' =>'required|numeric',
            'date'=>'required|date_format:Y-m-d H:i:s',
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
            'p12'=>'required|in:1,2,3,4,5',
            'p13'=>'required|in:1,2,3,4,5',
            'p14'=>'required|in:1,2,3,4,5',
            'p15'=>'required|in:1,2,3,4,5',
            'p16'=>'required|in:1,2,3,4,5',
            'p17'=>'required|in:1,2,3,4,5',
            'p18'=>'required|in:1,2,3,4,5',
            'p19'=>'required|in:1,2,3,4,5',
            'p20'=>'required|in:1,2,3,4,5',
            'Observacion1'=>'alpha_especial_numeric|max:500',
            'Observacion2'=>'alpha_especial_numeric|max:500',
            'Observacion3'=>'alpha_especial_numeric|max:500',
            'Observacion4'=>'alpha_especial_numeric|max:500',
            'observationgeneral'=>'alpha_especial_numeric|max:500',
            'recommendations'=>'alpha_especial_numeric|max:500',
        ];
    }

    public function messages()
    {
        return [
            'n_visit.numeric'=>'El número de visitas debe ser numérico',
            'n_visit.required'=>'El número de visitas es requerido',
            'date.required'=>'El campo fecha y hora de visita es obligatorio.',
            'date.date_format'=>'El campo fecha y hora de visita no tiene el formato correcto.',
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
            'p12.in'=>'El valor para el indicador 12 debe estar entre 1-5',
            'p12.required'=>'El valor para el indicador 12 es requerido',
            'p13.in'=>'El valor para el indicador 13 debe estar entre 1-5',
            'p13.required'=>'El valor para el indicador 13 es requerido',
            'p14.in'=>'El valor para el indicador 14 debe estar entre 1-5',
            'p14.required'=>'El valor para el indicador 14 es requerido',
            'p15.in'=>'El valor para el indicador 15 debe estar entre 1-5',
            'p15.required'=>'El valor para el indicador 15 es requerido',
            'p16.in'=>'El valor para el indicador 16 debe estar entre 1-5',
            'p16.required'=>'El valor para el indicador 16 es requerido',
            'p17.in'=>'El valor para el indicador 17 debe estar entre 1-5',
            'p17.required'=>'El valor para el indicador 17 es requerido',
            'p18.in'=>'El valor para el indicador 18 debe estar entre 1-5',
            'p18.required'=>'El valor para el indicador 18 es requerido',
            'p19.in'=>'El valor para el indicador 19 debe estar entre 1-5',
            'p19.required'=>'El valor para el indicador 19 es requerido',
            'p20.in'=>'El valor para el indicador 20 debe estar entre 1-5',
            'p20.required'=>'El valor para el indicador 20 es requerido',

            'Observacion1.alpha_especial_numeric'=>'La observación correspondiente al aspecto técnico tiene caracteres inválidos',
            'Observacion2.alpha_especial_numeric'=>'La observación correspondiente al aspecto operativo tiene caracteres inválidos',
            'Observacion3.alpha_especial_numeric'=>'La observación correspondiente al aspecto social tiene caracteres inválidos',
            'Observacion4.alpha_especial_numeric'=>'La observación correspondiente al aspecto estratégico tiene caracteres inválidos',

            'observationgeneral.alpha_especial_numeric'=>'La observación general tiene caracteres inválidos',
            'recommendations.alpha_especial_numeric'=>'La recomendación general tiene caracteres inválidos',


            'Observacion1.max'=>'La observación correspondiente al aspecto técnico sólo soporta 500 caracteres',
            'Observacion2.max'=>'La observación correspondiente al aspecto operativo sólo soporta 500 caracteres',
            'Observacion3.max'=>'La observación correspondiente al aspecto social sólo soporta 500 caracteres',
            'Observacion4.max'=>'La observación correspondiente al aspecto estratégico sólo soporta 500 caracteres',

            'observationgeneral.max'=>'La observación general sólo soporta 500 caracteres',
            'recommendations.max'=>'La recomendación general sólo soporta 500 caracteres',


        ];
    }
}
