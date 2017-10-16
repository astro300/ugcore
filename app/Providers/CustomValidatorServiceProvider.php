<?php

namespace UGCore\Providers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\ServiceProvider;
use Validator;
class CustomValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        Validator::extend('pdf',function ($attribute,$file){
            if ( $file!= null) {
                if (strtolower($file->getClientOriginalExtension()) != 'pdf') {
                    return false;
                }
            }
            return true;
        });

        Validator::extend('pdferror',function ($attribute,$file){
            if ( $file!= null) {
                if (strtolower($file->getError()) != '0') {
                    return false;
                }
            }
            return true;
        });



        Validator::extend('namefield', function($attribute, $value) { return preg_match('/^[a-z][A-Za-z_]+$/u', $value); });

        Validator::extend('webpage',function ($attribute,$value){ return preg_match('@^(?:http://)?([^/]+)@i',$value);});

        Validator::extend('alpha_spaces', function($attribute, $value) { return preg_match('/^[\pL\s]+$/u', $value); });

        Validator::extend('names', function($attribute, $value) { return preg_match('/^[a-zñáéíóúA-ZÑÁÉÍÓÚ ]*$/', $value); });

        Validator::extend('alpha_especial', function($attribute, $value) { return preg_match('/^[\pL\s\.\-\,]+$/u', $value); });

        Validator::extend('code_serial', function($attribute, $value) { return preg_match('/^[0-9\-]+$/u', $value); });

        Validator::extend('alpha_especial_numeric', function($attribute, $value) { return preg_match('/^[a-zñáéíóúA-ZÑÁÉÍÓÚ 0-9\.\-\,]*$/', $value); });

        Validator::extend('date_after_or_equal', function($attribute, $value,$date) {

            $dateFinish=Input::get($date[0]);
return strtotime($value)>=strtotime($dateFinish);
        });

        Validator::extend('amount', function($attribute, $value) { return preg_match('/^\d*(\.\d{1,2})?$/', $value); });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
