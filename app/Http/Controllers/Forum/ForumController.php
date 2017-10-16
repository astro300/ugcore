<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 1/6/2017
 * Time: 8:59
 */

namespace UGCore\Http\Controllers\Forum;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use UGCore\Core\Entities\Forum\ForumCategory;
use UGCore\Core\Entities\Forum\ForumComment;
use UGCore\Core\Entities\Forum\ForumCommentDetail;
use UGCore\Core\Repositories\Security\ForumRepository;
use View;
use UGCore\Http\Controllers\Controller;
use UGCore\Facades\Messages;
class ForumController extends Controller
{

    public function index(Request $request){
        View::composer('components.forumviewcomposer','UGCore\Http\ViewComposers\ForumComposer');
        $objForumRepository= new ForumRepository();
        $category=$request->categoria==null?'0':$request->categoria;
        if(!$request->ajax()){
            return view('forum.index')->with(['category'=>$request->categoria,'comments'=>$objForumRepository->forData($request,$category),'scope'=>$request->scope]);
        }else{
            return $objForumRepository->forData($request,$category);
        }
    }


    public function deleteComment(Request $request,ForumComment $forumComment){
        $this->authorize('delete', $forumComment);
        $forumComment->delete();
        if($request->owner=='1'){
            $categories=ForumCategory::with('commentsCountOwner')->orderBy('nombre','DESC')->select('nombre','id')->get();
        }else{
            $categories=ForumCategory::with('commentsCount')->orderBy('nombre','DESC')->select('nombre','id')->get();
        }
        return response()->json(['data'=>"Comentario eliminado correctamente",'status'=>200,'categories'=>$categories],200);
    }

    public function deleteCommentDetail(ForumCommentDetail $forumCommentDetail){
       $this->authorize('deleteDetail', $forumCommentDetail);
        $forumCommentDetail->delete();
        return response()->json(['data'=>"Comentario eliminado correctamente",'status'=>200],200);
    }



    public function saveComment(Request $request){
        $this->validate($request,['comentario'=>'required|max:500','categoria'=>'required|numeric']);
        $objForumRepository=new ForumRepository();
        return $objForumRepository->forSave($request);
    }

    public function updateComment(Request $request){
        $this->validate($request,['comentario'=>'required|max:500','categoria'=>'required|numeric','id'=>'required|numeric']);
        $forumComment= ForumComment::findOrFail($request->id);
        $this->authorize('owner', $forumComment);
        $objForumRepository=new ForumRepository();
        return $objForumRepository->forUpdate($request,$forumComment);
    }


    public function responseComment(Request $request){
        $this->validate($request,['comentario'=>'required|max:500','id'=>'required|numeric']);
        $forumComment= ForumComment::findOrFail($request->id);
        $objForumRepository=new ForumRepository();
        return $objForumRepository->forResponse($request,$forumComment);
    }

    public function viewComment(Request $request,ForumComment $forumComment){
        if($request->ajax()){
        return response()->json(['data'=>$forumComment->getAttributes(),'status'=>200],200);
        }else{
            abort(401);
        }
    }

    public function viewCommentDetail(Request $request,ForumComment $forumComment){
        if($request->ajax()){
        $forumComment->load('user');
        $forumComment->load('category');
        return response()->json(['data'=>$forumComment->getAttributes(),'status'=>200],200);
        }else{
            abort(401);
        }
    }
    public function updateCommentDetail(Request $request){
        $this->validate($request,['comentario'=>'required|max:500','id'=>'required|numeric']);
        $forumCommentDetail= ForumCommentDetail::findOrFail($request->id);
        $this->authorize('ownerDetail', $forumCommentDetail);
        $objForumRepository=new ForumRepository();
        return $objForumRepository->forUpdateDetail($request,$forumCommentDetail);
    }


    public function getCommentDetail(Request $request,ForumCommentDetail $forumCommentDetail){
        if($request->ajax()){
            return response()->json(['data'=>$forumCommentDetail->getAttributes(),'status'=>200],200);
        }else{
            abort(401);
        }
    }

    public function viewCommentDetailDatatable(Request $request,ForumComment $forumComment){
        if($request->ajax()){
            $objForumRepository=new ForumRepository();
            return $objForumRepository->forDatatableDetail($forumComment);
        }else{
            abort(401);
        }

    }


    public function actionComment(Request $request){
        $this->validate($request,['type'=>'required|in:F,C','id'=>'required|numeric','action'=>'required|in:1,0'],
            ['type.in'=>'Tipo de Comentario no Aceptado','action.in'=>'Acci&oacute;n de Comentario no Aceptada']);
        $objForumRepository=new ForumRepository();
        return $objForumRepository->forActionComment($request);
    }

    public function commentCategory(Request $request){
        View::composer('components.forumviewcomposer','UGCore\Http\ViewComposers\ForumComposer');
        $objForumCategory=ForumCategory::findBySlugOrFail($request->slug);
        $objForumRepository= new ForumRepository();
        return view('forum.index')->with(['category'=>$objForumCategory->id,'comments'=>$objForumRepository->forData($request,$objForumCategory->id),'scope'=>$request->scope]);
    }


    public function commentOwnerCategory(Request $request){
       $categories=ForumCategory::with('commentsCountOwner')->orderBy('nombre','DESC')->select('nombre','id','slug')->get();
       $objForumCategory=ForumCategory::findBySlugOrFail($request->slug);
       $objForumRepository= new ForumRepository();
        if(!$request->ajax()){
            return view('forum.owner')->with(['category'=>$objForumCategory->id,'categories'=>$categories,
                'owner'=>true,'user'=>Auth::user()->fullName(),
                'slug'=>$objForumCategory->slug,
                'comments'=>$objForumRepository->forData($request,$objForumCategory->id,Auth::user()->id),'scope'=>$request->scope]);
        }else{

            return $objForumRepository->forData($request,$objForumCategory->id,Auth::user()->id);
        }




    }



    public function commentOwner(Request $request){
            $objForumRepository= new ForumRepository();
            if(!$request->ajax()){
                $categories=ForumCategory::with('commentsCountOwner')->orderBy('nombre','DESC')->select('nombre','id','slug')->get();
                if($request->owner == (Auth::user()->id)){
                return view('forum.owner')->with(['categories'=>$categories,'slug'=>'','scope'=>'',
                    'comments'=>$objForumRepository->forData($request,0,Auth::user()->id),
                    'owner'=>true,'user'=>Auth::user()->fullName(),
                    'category'=>'0']);
                }
                abort(401);
            }else{
                return $objForumRepository->forData($request,0,Auth::user()->id);
            }
    }
}