<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 7/6/2017
 * Time: 13:39
 */

namespace UGCore\Core\Entities\Forum;

use Utils;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use UGCore\Core\Entities\Security\User;
use Carbon;
class ForumCommentAction extends Model
{
    use SoftDeletes;

    protected $table='foro_comentario_accion';

    public function comentario(){
        return $this->belongsTo(ForumComment::class,'foro_comentario_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
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