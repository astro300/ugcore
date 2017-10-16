<?php

namespace UGCore\Http\Controllers\Auth;


use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Input;
use Mail;
use UGCore\Core\Entities\Security\User;
use UGCore\Http\Controllers\Controller;
use UGCore\Mail\RegisterUser;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
                'cedula' => 'required|min:6|unique:sqlsrv.users,name',
                'email' => 'required|email|unique:sqlsrv.users,email',
                'first_name' => 'required|names',
                'last_name' => 'required|names',
                'password' => 'required|confirmed|min:6',
                'sex'=>'required|in:1,0',
                'g-recaptcha-response' => 'required'
            ],['g-recaptcha-response.required' => 'El campo captcha es requerido',
                'first_name.required'=>'El campo nombre es requerido',
                'last_name.required'=>'El campo apellido es requerido',
                'first_name.names'=>'El campo nombre tiene caracteres incorrectos',
                'last_name.names'=>'El campo apellido tiene caracteres incorrectos',
                'sex.numeric'=>'El campo sexo es requerido',
                'sex.in'=>'El campo sexo debe ser Masculino o Femenino']);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $objUser = new User();
        $confirmation_code = str_random(30);
        \DB::beginTransaction();
        try {

            $objUser->email = $data['email'];
            $objUser->name = $data['cedula'];
            $objUser->first_name = $data['first_name'];
            $objUser->last_name = $data['last_name'];
            $objUser->sex = $data['sex'];
            $objUser->password = bcrypt($data['password']);
            $objUser->confirmation_code = $confirmation_code;
            $objUser->confirmed = '0';
            $objUser->save();

            $objUser->roles()->create(['role_id' => env('ROLE_DEFAULT')]);
        $objUser->notifyRegister();

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
        return $objUser;
    }


    /**
     * Validate user in database.
     *
     * @param  string  $token
     * @return route login
     */
    public function verify($token)
    {
        User::where('confirmation_code',$token)->firstOrFail()->verified();
        return redirect('login')
            ->with('status','Usuario activado correctamente!!');
    }


    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return redirect()->to('login')
            ->with('status','Para completar el registro ingrese al correo electr&oacute;nico facilitado: <b>'.$user->email.'</b>');
    }
}
