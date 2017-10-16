<?php

namespace UGCore\Core\Entities\Security;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Config;
use UGCore\Core\Entities\Forum\ForumComment;
use UGCore\Core\Entities\Forum\ForumCommentAction;
use UGCore\Notifications\CustomResetPassword;
use UGCore\Notifications\NotificationRegister;
use Utils;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','confirmation_code', 'last_name',
        'first_name' ,
        'confirmed'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * Funcion para verificar user.
     *
     */
    public function verified()
    {
        $this->confirmed = 1;
        $this->confirmation_code = null;
        $this->save();
    }

    /**
     * Funcion para login user.
     *
     */
    public function loginAction()
    {
        $this->last_login = date(Utils::getFormatDateSQL());//Carbon::createFromTimeStamp(strtotime(Carbon::now(Config::get('app.timezone'))));
        $this->online = 1;
        $this->last_logout=null;
        $this->timestamps = false;
        $this->save();
        $this->timestamps = true;
    }

    /**
     * Funcion para login user.
     *
     */
    public function logoutAction()
    {
        $this->last_logout = date(Utils::getFormatDateSQL());//Carbon::createFromTimeStamp(strtotime(Carbon::now(Config::get('app.timezone'))));
        $this->online = 0;
        $this->timestamps = false;
        $this->save();
        $this->timestamps = true;
    }


    /**
     * Funcion para resetear clave de usuario
     *
     */
    public function sendPasswordResetNotification($token)
    {
        $when = Carbon::now()->addMinutes(1);
        $this->notify((new CustomResetPassword($token))->onQueue('recoveryUser')->delay($when));

    }

    public function notifyRegister(){
        $when = Carbon::now()->addMinutes(1);
        $this->notify((new NotificationRegister($this))->onQueue('registerUser')->delay($when));
    }

    public function fullName(){
        return $this->first_name.' '.$this->last_name;
    }

    public function roles(){
        return $this->hasMany(RolesUser::class,'user_id');
    }

    public function evaluateRoles($arrayRoles){

        return ($this->roles()->whereIn('role_id',Role::whereIn('name',$arrayRoles)->pluck('id')->toArray())->count());
    }

    public function scopeSearch($query,$name,$field='name'){
        return $query->where($field,'LIKE',"%$name%");
    }


    public function getLastLoginAttribute($value)
    {
        return Carbon::createFromTimeStamp(strtotime($value));
    }

    public function getLastLogoutAttribute($value)
    {
        return Carbon::createFromTimeStamp(strtotime($value));
    }

    public function accionesComentarios(){
        return $this->hasMany(ForumCommentAction::class,'user_id');
    }

    public function  comentarios(){
        return $this->hasMany(ForumComment::class,'user_id');
    }

    protected function getDateFormat()
    {
        return Utils::getFormatDateSQL(true,true);
    }

    public function getCreatedAtAttribute($value){
        return Carbon::createFromTimeStamp(strtotime($value));
    }
    
    public function getUpdatedAtAttribute($value){
        return Carbon::createFromTimeStamp(strtotime($value));
    }

}
