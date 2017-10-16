<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 2/6/2017
 * Time: 12:19
 */

namespace UGCore\Http\ViewComposers;

use Illuminate\Contracts\View\View;

use UGCore\Core\Entities\Forum\ForumCategory;

class ForumComposer
{
    public function  compose(View $view){

        $categories=ForumCategory::with('commentsCount')->orderBy('nombre','DESC')->select('nombre','id','slug')->get();

        $view->with(['categories'=>$categories,'owner'=>false]);
    }

}