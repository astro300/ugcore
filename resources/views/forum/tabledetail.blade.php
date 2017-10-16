<div class="row text-center">
    <button class="btn btn-success btn-xs" onclick="$('#divCommentsDetail_{{$id}}').html('')">Cerrar</button>
</div>
<div class="box-comments ">
    @forelse($comments as $comment)
        <div class="box-comment div_padding text-center" id="divCommentDetail_{{$comment->id}}">
            <span class="fa-stack fa-lg img-circle img-sm">
              <i class="fa fa-square fa-stack-2x"></i>
              <i class="fa fa-user fa-stack-1x fa-inverse"></i>
            </span>
            <div class="comment-text text-left">
                  <span class="username">
                        {{$comment->fullname}}
                      @can('ownerDetail',$comment)
                          <i class="fa fa-pencil text-teal-800" title="editar"  onclick="updatePostDetail({{$comment->id}})"></i>&nbsp;
                      @endcan
                      @can('deleteDetail', $comment)
                          <i class="fa fa-trash text-danger" title="eliminar"
                             onclick="deletePostDetail({{$comment->id}})"></i>
                      @endcan
                      <span class="text-muted pull-right">{{Carbon::createFromTimeStamp(strtotime($comment->updated_at))->diffForHumans()}}</span>
                  </span>
                    <span id="commentDetailBody_{{$comment->id}}">{{$comment->comentario}}</span>
                    <br/>
                    <span class="pull-right">
                         <label onclick="like('{{$comment->id}}','C')" class="text-primary"><span
                                     id="likeC_{{$comment->id}}">{{$comment->_like}}</span> <i
                                     class="fa fa-thumbs-o-up text-brown-400  text-font-like"
                                     style="font-size: 18px" aria-hidden="true"></i>
                         </label>&nbsp;
                         <label onclick="desLike('{{$comment->id}}','C')" class="text-primary"><span
                                    id="deslikeC_{{$comment->id}}">{{$comment->deslike}}</span> <i
                                    class="fa fa-thumbs-o-down fa-flip-horizontal  text-brown-400 text-font-like"
                                    style="font-size: 18px" aria-hidden="true"></i>
                         </label>&nbsp;
                    </span>
                <span id="commentDetailFile_{{$comment->id}}">
                @if($comment->adjunto!='')
                   <b>Adjunto:</b>  <a target="_blank" href="/file-ftp/FORO/{{$comment->adjunto}}">Descargar
                        Adjunto</a>
                @endif
                </span>
            </div>
        </div>

    @empty
        NO HAY MENSAJES......
    @endforelse

</div>
<div class="text-center"> {!! $comments->render() !!}</div>