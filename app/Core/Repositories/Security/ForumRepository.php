<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 4/6/2017
 * Time: 22:12
 */

namespace UGCore\Core\Repositories\Security;

use Auth;
use Illuminate\Http\Request;
use UGCore\Core\Entities\Forum\ForumCategory;
use UGCore\Core\Entities\Forum\ForumComment;
use Storage;
use File;
use DB;
use UGCore\Core\Entities\Forum\ForumCommentAction;
use UGCore\Core\Entities\Forum\ForumCommentDetail;

class ForumRepository
{
    public function forData(Request $request,$foro_categoria_id='0',$owner=null){
        $scope=$request->scope;

        if(!$request->ajax()){
           $query= (ForumComment::join('foro_categorias','foro_categorias.id','foro_comentarios.foro_categoria_id')
                ->join('users','users.id','foro_comentarios.user_id')
                ->leftJoin('foro_comentario_accion AS fp',function ($join){
                    $join->on('fp.foro_comentario_id','=','foro_comentarios.id')->where('fp.accion','=','1');
                })
                ->leftJoin('foro_comentario_accion AS fa',function ($join){
                    $join->on('fa.foro_comentario_id','=','foro_comentarios.id')->where('fa.accion','=','0');
                })

               ->where('foro_comentarios.comentario','like',"%$scope%")
                ->groupBy('foro_comentarios.user_id','foro_comentarios.id','foro_comentarios.comentario','foro_comentarios.adjunto'
                    ,'users.first_name', 'users.last_name','foro_categorias.nombre')
                ->select('foro_comentarios.user_id','foro_comentarios.id','foro_comentarios.comentario','foro_comentarios.adjunto'
                            ,DB::raw("users.first_name +' '+ users.last_name as fullname"),
                            'foro_categorias.nombre as categoria' , DB::raw('count(fp.accion) as _like'),
                            DB::raw('COUNT(fa.accion) as deslike'),
                    DB::raw('min(foro_comentarios.updated_at) as updated_at'),
                    DB::raw("(select count(id) from foro_comentario_detalle where foro_comentario_detalle.foro_comentario_id=foro_comentarios.id 
                    and foro_comentario_detalle.deleted_at is null ) as commentcount"))
              ->orderBy('foro_comentarios.id','DESC')->limit(10));

            if ($foro_categoria_id != '0') {
                $query= $query->where('foro_comentarios.foro_categoria_id','=', $foro_categoria_id);
            }
            if($owner!=null){
                return $query->where('foro_comentarios.user_id','=',$owner)->get();
            }else{
                return $query->get();
            }
        }else{
            $id = $request->id;
            if($id==null || !is_numeric($id)){
                $id=0;
            }
            $query = (ForumComment::join('foro_categorias','foro_categorias.id','foro_comentarios.foro_categoria_id')
                ->join('users','users.id','foro_comentarios.user_id')
                ->leftJoin('foro_comentario_accion AS fp',function ($join){
                    $join->on('fp.foro_comentario_id','=','foro_comentarios.id')->where('fp.accion','=','1');
                })
                ->leftJoin('foro_comentario_accion AS fa',function ($join){
                    $join->on('fa.foro_comentario_id','=','foro_comentarios.id')->where('fa.accion','=','0');
                })
                ->where('foro_comentarios.comentario','like',"%$scope%")
                ->where('foro_comentarios.id','<',$id)
                ->groupBy('foro_comentarios.user_id','foro_comentarios.id','foro_comentarios.comentario','foro_comentarios.adjunto'
                    ,'users.first_name', 'users.last_name','foro_categorias.nombre')
                ->select('foro_comentarios.user_id','foro_comentarios.id','foro_comentarios.comentario','foro_comentarios.adjunto'
                    ,DB::raw("users.first_name +' '+ users.last_name as fullname"),
                    'foro_categorias.nombre as categoria' , DB::raw('count(fp.accion) as _like'),
                    DB::raw('COUNT(fa.accion) as deslike'),
                    DB::raw('min(foro_comentarios.updated_at) as updated_at'),DB::raw("(select count(id) from foro_comentario_detalle where foro_comentario_detalle.foro_comentario_id=[foro_comentarios].id and foro_comentario_detalle.deleted_at is null) as commentcount"))
                ->orderBy('foro_comentarios.id','DESC')->limit(5));

            if ($foro_categoria_id != '0') {
                $comments= $query->where('foro_comentarios.foro_categoria_id','=', $foro_categoria_id);
            }
            if($owner!=null){
                $comments= $query->where('foro_comentarios.user_id','=', $owner)->get();
            }else{
                $comments= $query->get();
            }


            $output='';
            $code=0;
            foreach($comments as $comment){
                $output.=$this->generateComment($comment);
                $code=$comment->id;
            }
            return response()->json(['categoria'=>$foro_categoria_id,'data'=>$output,'code'=>$code,'status'=>200]);
        }


    }

    private function filePut(Request $request){
        $file = $request->file('evidencia');
        if ($file != null) {
            $extension = $file->getClientOriginalExtension();
            $nameFile = 'FORUM-' . Auth::user()->name . date('Ymdhis') . '.' . $extension;
                Storage::disk('ftp')->put('MODULOS/FORO/' . $nameFile, File::get($file));
           return $nameFile;
        }
        return null;
    }


    public function forDatatableDetail(ForumComment $objForumComment){
        $id=$objForumComment->id;
        $comments=ForumCommentDetail::join('users','users.id','foro_comentario_detalle.user_id')
            ->leftJoin('foro_comentario_accion AS fp',function ($join){
                $join->on('fp.foro_comentario_detalle_id','=','foro_comentario_detalle.id')->where('fp.accion','=','1');
            })
            ->leftJoin('foro_comentario_accion AS fa',function ($join){
                $join->on('fa.foro_comentario_detalle_id','=','foro_comentario_detalle.id')->where('fa.accion','=','0');
            })

            ->where('foro_comentario_detalle.foro_comentario_id','=',$objForumComment->id)
            ->groupBy('foro_comentario_detalle.user_id','foro_comentario_detalle.id','foro_comentario_detalle.comentario','foro_comentario_detalle.adjunto'
                ,'users.first_name', 'users.last_name')
            ->select('foro_comentario_detalle.user_id','foro_comentario_detalle.id','foro_comentario_detalle.comentario','foro_comentario_detalle.adjunto'
                ,DB::raw("users.first_name +' '+ users.last_name as fullname"), DB::raw('count(fp.accion) as _like'),
                DB::raw('COUNT(fa.accion) as deslike'),
                DB::raw('min(foro_comentario_detalle.updated_at) as updated_at'))
            ->orderBy('foro_comentario_detalle.id','DESC')->paginate(6);
        return response()->json(['data'=>view('forum.tabledetail', compact('comments','id'))->render(),'id'=>$objForumComment->id],200);
    }


    public function forResponse(Request $request, ForumComment $objForumComment){
        $forumCommentDetail=new ForumCommentDetail();
       if($request->file('evidencia')!=null){
       $forumCommentDetail->adjunto=$this->filePut($request);
       }
       $forumCommentDetail->comentario=$request->comentario;
        $forumCommentDetail->user_id=Auth::user()->id;
        $objForumComment->commentDetails()->save($forumCommentDetail);
        return response()->json(['comentarios'=>$objForumComment->commentsCountDetail()],'200');
    }

    public function forSave(Request $request){
        $forumComment= new ForumComment();
        if($request->file('evidencia')!=null) {
            $forumComment->adjunto = $this->filePut($request);
        }
            $forumComment->comentario=$request->comentario;
        $forumComment->foro_categoria_id=$request->categoria;
        $forumComment->user_id=Auth::user()->id;
        $forumComment->save();
        if($request->owner=='1'){
            $categories=ForumCategory::with('commentsCountOwner')->orderBy('nombre','DESC')->select('nombre','id')->get();
        }else{
            $categories=ForumCategory::with('commentsCount')->orderBy('nombre','DESC')->select('nombre','id')->get();
        }


        return response()->json(['data'=>$this->generateComment($forumComment,true),'categories'=>$categories],200);
    }

    public function forUpdate(Request $request,ForumComment $forumComment){
        if($request->file('evidencia')!=null) {

            $forumComment->adjunto = $this->filePut($request);
        }
        $forumComment->comentario=$request->comentario;
        $forumComment->foro_categoria_id=$request->categoria;
        $forumComment->save();


        if($request->owner=='1'){
            $categories=ForumCategory::with('commentsCountOwner')->orderBy('nombre','DESC')->select('nombre','id')->get();
        }else{
            $categories=ForumCategory::with('commentsCount')->orderBy('nombre','DESC')->select('nombre','id')->get();
        }

        return response()->json(['data'=>$this->generateComment($forumComment,false,false),'categories'=>$categories],200);
    }

    public function forUpdateDetail(Request $request,ForumCommentDetail $forumCommentDetail){
        if($request->file('evidencia')!=null) {

            $forumCommentDetail->adjunto = $this->filePut($request);
        }
        $forumCommentDetail->comentario=$request->comentario;
        $forumCommentDetail->save();

        return response()->json(['file'=>$forumCommentDetail->adjunto==null?'':$forumCommentDetail->adjunto,'body'=>$forumCommentDetail->comentario],200);
    }


    private function generateComment(ForumComment $comment,$new=false,$query=true){
        $button='';
        if (Auth::user()->can('delete', $comment)){
            $button='<button class="btn btn-danger btn-xs" value="'.$comment->id.'" onclick="deletePost(this)">Eliminar</button>';
        }
        if (Auth::user()->can('owner', $comment)){
            $button.='
            <button class="btn btn-warning btn-xs"  value="'.$comment->id.'" onclick="updatePost(this)">Actualizar</button>';
        }
        $adjunto='';
        if($comment->adjunto!=null && $comment->adjunto!=''){
           $adjunto=' <b>Adjunto:</b><a target="_blank" href="/file-ftp/FORO/'.$comment->adjunto.'">Descargar Adjunto</a>';
        }

        $body = $comment->comentario;
        if(!$new){
            if($query){
                $like=$comment->_like==null?'0':$comment->_like;
                $deslike=$comment->deslike==null?'0':$comment->deslike;

            }else{
                $like=$comment->commentsCount(1);
                $deslike=$comment->commentsCount(0);
            }

            $commentCount=$comment->commentsCountDetail();
        }else{
            $like=0;
            $deslike=0;
                $commentCount=0;

        }
        $fullName=$comment->user->fullName();
        $category=$comment->category->nombre;

        return '<li id="liComment_'.$comment->id.'">
                    <i class="fa fa-user bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i>'.$comment->updated_at->diffForHumans().'</span>

                        <h3 class="timeline-header text-blue text-bold">'.$fullName.'</h3>

                        <div class="timeline-body">
                           <b>Asunto:</b> '.$category.'<br/>
                           <b>Detalle:</b> '.$body.'
                           <br/>
                          '.$adjunto.'
                        </div>
                        <div class="timeline-footer">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                     <button class="btn btn-primary btn-xs" value="'.$comment->id.'" onclick="responsePost(this)" >Responder</button>
                                    '.$button.'
                                </div>
                                <div class="col-lg-6 col-md-6 text-right" >
                                   <label onclick="like('.$comment->id.',\'F\')" class="text-primary"><span id="like_'.$comment->id.'">'.$like.'</span> <i class="fa fa-thumbs-o-up text-brown-400  text-font-like" style="font-size: 18px" aria-hidden="true"></i></label>&nbsp;
                                   <label onclick="desLike('.$comment->id.',\'F\')" class="text-primary"><span id="deslike_'.$comment->id.'">'.$deslike.'</span> <i class="fa fa-thumbs-o-down fa-flip-horizontal  text-brown-400 text-font-like" style="font-size: 18px" aria-hidden="true"></i></label>&nbsp;
                                   <label  class="text-primary" onclick="comments('.$comment->id.')"
                                               title="ver comentarios">
                                       <span id="comment_'.$comment->id.'">'.$commentCount.'</span>
                                       <i class="fa fa-comments  text-brown-400 text-font-like"  aria-hidden="true"></i>
                                   </label>
                                  
                               </div>
                            </div>
                             <br/>
                                <div class="row">
                                    <div class="col-lg-12" id="divCommentsDetail_'.$comment->id.'">

                                    </div>
                                </div>
                           
                            
                        </div>
                    </div>
                </li>';

    }

    public function forActionComment(Request $request){
        $user_id=Auth::user()->id;
        if($request->type=='F'){
            $objForumComment=ForumComment::findOrFail($request->id);
            $objForumCommentAction=ForumCommentAction::where('user_id','=',$user_id)
                                                    ->where('foro_comentario_id','=',$objForumComment->id)->first();
            if($objForumCommentAction==null){
                $objForumCommentAction=new ForumCommentAction();
                $objForumCommentAction->user_id=$user_id;
                $objForumCommentAction->foro_comentario_id=$objForumComment->id;
            }
            $objForumCommentAction->accion=$request->action;
            $objForumCommentAction->save();


            return response()->json(['data'=>['like'=>$objForumComment->commentsCount(1),'deslike'=>$objForumComment->commentsCount(0)]],200);

        }else{
            $objForumCommentDetail=ForumCommentDetail::findOrFail($request->id);
            $objForumCommentAction=ForumCommentAction::where('user_id','=',$user_id)
                ->where('foro_comentario_detalle_id','=',$objForumCommentDetail->id)->first();
            if($objForumCommentAction==null){
                $objForumCommentAction=new ForumCommentAction();
                $objForumCommentAction->user_id=$user_id;
                $objForumCommentAction->foro_comentario_detalle_id=$objForumCommentDetail->id;
            }
            $objForumCommentAction->accion=$request->action;
            $objForumCommentAction->save();


            return response()->json(['data'=>['like'=>$objForumCommentDetail->commentsCount(1),'deslike'=>$objForumCommentDetail->commentsCount(0)]],200);
        }
    }

}