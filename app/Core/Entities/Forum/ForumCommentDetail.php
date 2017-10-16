<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 8/6/2017
 * Time: 20:15
 */

namespace UGCore\Core\Entities\Forum;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use UGCore\Core\Entities\Security\User;
use Carbon;
use Utils;
class ForumCommentDetail extends Model
{
    use SoftDeletes;
    protected $table='foro_comentario_detalle';

    public function comment(){
        return $this->belongsTo(ForumComment::class,'foro_comentario_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function commentsCount($type)
    {
        return ForumCommentAction::where('foro_comentario_detalle_id','=',$this->id)->where('accion','=',$type)->count();
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