<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 3/6/2017
 * Time: 11:07
 */

namespace UGCore\Core\Entities\Forum;

use Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use UGCore\Core\Entities\Security\User;
use Utils;
class ForumComment extends Model
{
    use SoftDeletes;
    protected $table ="foro_comentarios";

    public function category(){
        return $this->belongsTo(ForumCategory::class,'foro_categoria_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function accionesComentarios(){
        return $this->hasMany(ForumCommentAction::class,'foro_comentario_id');
    }

    public function commentsCount($type)
    {
        return ForumCommentAction::where('foro_comentario_id','=',$this->id)->where('accion','=',$type)->count();
    }

    public function commentsCountDetail()
    {
        return ForumCommentDetail::where('foro_comentario_id','=',$this->id)->count();
    }

    public function commentDetails(){
        return $this->hasMany(ForumCommentDetail::class,'foro_comentario_id');
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