<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 31/5/2017
 * Time: 17:42
 */

namespace UGCore\Core\Entities\Forum;

use Utils;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use UGCore\Core\Entities\CoreModel;
use Carbon;
class ForumCategory extends Model
{
    use SoftDeletes,Sluggable,SluggableScopeHelpers;
    protected $table ="foro_categorias";

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'nombre'
            ]
        ];
    }


    public function comments(){
        return $this->hasMany(ForumComment::class,'foro_categoria_id');
    }

    public function commentsCount()
    {
        return $this->hasOne(ForumComment::class,'foro_categoria_id')
            ->selectRaw('foro_categoria_id, count(*) as aggregate')
            ->groupBy('foro_categoria_id');
    }

    public function getCommentsCountAttribute()
    {
        $related = $this->getRelation('commentsCount');
         return ($related) ? (int) $related->aggregate : 0;
    }


    public function commentsCountOwner()
    {
        return $this->hasOne(ForumComment::class,'foro_categoria_id')
            ->where('foro_comentarios.user_id','=',\Auth::user()->id)
            ->selectRaw('foro_categoria_id, count(*) as aggregate')
            ->groupBy('foro_categoria_id');
    }
    public function getCommentsCountOwnerAttribute()
    {
        $related = $this->getRelation('commentsCountOwner');
        return ($related) ? (int) $related->aggregate : 0;
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
