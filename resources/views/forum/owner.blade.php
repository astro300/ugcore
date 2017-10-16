@extends('layouts.back')
@section('masterTitle')
    Foro-UG
@endsection
@section('masterTitleModule')
   Listado de mensajes
@endsection
@section('masterDescription')
    Interacci&oacute;n del usuario: {{ $user }}
@endsection
@section('mainContent')
    <div class="row">
        <div class="col-md-3">
            @include('components.forumviewcomposer',[
                'categories'=>$categories,
                'owner'=>$owner
                ])
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="row">
                <div class="col-lg-5 col-lg-offset-7">
                    <form method="GET" action="{{route('forum.comment.owner.category',$slug)}}" accept-charset="UTF-8" class="header-search-wrapper ">
                        <div class="input-group content-group" style="margin-bottom: 10px !important;">
                            <div class="has-feedback has-feedback-left">
                                <input class="form-control input-xlg" placeholder="Buscar Comentarios" name="scope" id="scope" type="text" value="{{$scope}}">
                               <div class="form-control-feedback">
                                    <i class="icon-search4 text-muted text-size-base"></i>
                                </div>
                            </div>
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-xlg legitRipple">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <ul class="timeline" id="timeline">
                <?php $code=0; ?>
                @foreach($comments as $comment)
                    <li id="liComment_{{$comment->id}}">
                        <i class="fa fa-user bg-blue"></i>

                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> {{$comment->updated_at->diffForHumans()}}</span>

                            <h3 class="timeline-header text-blue text-bold">{{$comment->fullname}}</h3>

                            <div class="timeline-body">
                                <b>Asunto:</b> {{$comment->categoria}}<br/>
                                <b>Detalle:</b> {{$comment->comentario}}
                                <br/>
                                @if($comment->adjunto!='')
                                    <b>Adjunto:</b>  <a target="_blank" href="/file-ftp/FORO/{{$comment->adjunto}}">Descargar Adjunto</a>
                                @endif
                            </div>
                            <div class="timeline-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <button class="btn btn-primary btn-xs" value="{{$comment->id}}"
                                                onclick="responsePost(this)">Responder
                                        </button>
                                        @can('delete',$comment)
                                            <button class="btn btn-danger btn-xs" value="{{$comment->id}}" onclick="deletePost(this)">Eliminar</button>
                                        @endcan
                                        @can('owner', $comment)
                                            <button class="btn btn-warning btn-xs" value="{{$comment->id}}" onclick="updatePost(this)">Actualizar</button>
                                        @endcan
                                    </div>
                                    <div class="col-lg-6 col-md-6 text-right" >

                                        <label onclick="like('{{$comment->id}}','F')" class="text-primary"><span id="like_{{$comment->id}}">{{$comment->_like}}</span> <i class="fa fa-thumbs-o-up text-brown-400  text-font-like" style="font-size: 18px" aria-hidden="true"></i></label>&nbsp;
                                        <label onclick="desLike('{{$comment->id}}','F')" class="text-primary"><span id="deslike_{{$comment->id}}">{{$comment->deslike}}</span> <i class="fa fa-thumbs-o-down fa-flip-horizontal  text-brown-400 text-font-like" style="font-size: 18px" aria-hidden="true"></i></label>&nbsp;
                                        <label class="text-primary" onclick="comments('{{$comment->id}}')"
                                               title="ver comentarios">
                                            <span id="comment_{{$comment->id}}">{{$comment->commentcount}}</span>
                                            <i class="fa fa-comments  text-brown-400 text-font-like"
                                               aria-hidden="true"></i>
                                        </label>

                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-lg-12" id="divCommentsDetail_{{$comment->id}}">

                                    </div>
                                </div>

                            </div>
                        </div>
                    </li>
                    <?php $code=$comment->id;?>
                @endforeach
            </ul>
            @if(count($comments)>0)
                <div class="col-lg-4 col-lg-offset-4">
                    <button class="btn bg-teal-600 btn-block" id="btn-more" data-id="{{$code}}"
                            data-categoria="{{$category}}"
                           ><i class="fa fa-plus"></i> VER MAS</button>
                </div>
            @endif
        </div>
    </div>

<comment-form></comment-form>
@endsection
@section('masterCssCustom')
    <link rel="stylesheet" type="text/css" href="/plugins/fileinput/fileinput.min.css">
@endsection
@section('masterJsCustom')
    <script src="{{ asset('plugins/riot/riot.min.js') }}"></script>
    <script src="{{ asset('plugins/riot/riot-compiler.min.js') }}"></script>
    <script src="/components/comments.tag" type="riot/tag"></script>
    <script type="text/javascript" src="{{ asset('plugins/fileinput/fileinput.min.js') }}"></script>
    <script src="{{asset('js/modules/forum/global.js')}}"></script>
    <script>
        $(document).on('click','#btnComment',function(e){
            riot.util.tmpl.clearCache ();
            riot.mount('comment-form', {id:0,action:'guardar',categories:$('#hdfCategories').val(),'owner':'1'});

        });

        $(document).on('click','#btn-more',function(){
            var _id = $(this).attr('data-id');
           $(this).html('<i class="fa fa-repeat fa-spin"></i>  Loading....');
            var objApiRest=new AJAXRest("{{route('forum.comment.owner.category',$slug)}}",{owner:'1',id:_id,scope:$("#scope").val()},'GET');
            objApiRest.extractDataAjax(function(_resultContent,status){
                $("#btn-more").html('<i class="fa fa-plus"></i>  VER MAS');

                if(status==200){
                    if(_resultContent.data.trim()!=''){
                        $("#timeline").append(_resultContent.data);
                        $("#btn-more").attr('data-id',_resultContent.code);
                        $("#btn-more").attr('data-categoria',_resultContent.categoria);

                    }
                }else{
                    alertToast(_resultContent.message,3500);
                }

            });
        });





        function deletePost(_btn) {
            swal({
                    title: "Confirmaci\u00F3n de Eliminaci\u00F3n",
                    text: "Realmente desea eliminar El comentario?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Aceptar",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function (isConfirm) {
                    if (isConfirm) {
                        var objApiRest = new AJAXRest('/forum-comment/' + _btn.value + '/delete', {owner:'1',children:false}, 'GET');
                        objApiRest.extractDataAjax(function (_resultContent, status) {
                            if (status == 200) {
                                $('#ulCategories').html('');
                                $.each(_resultContent.categories,function(key,value){
                                    var code=0;
                                        if(!$.isEmptyObject(value.comments_count_owner)){
                                            code=value.comments_count_owner.aggregate;
                                        }

                                    $('#ulCategories').append('<li><a href="#"><i class="fa fa-filter"></i>'+value.nombre+'<span class="label label-success pull-right">'+code+'</span></a></li>');

                                });

                                $("#liComment_" + _btn.value).remove();
                                alertToastSuccess(_resultContent.data,3500);
                            } else {
                                alertToast(_resultContent.message, 3500);
                            }
                        });
                    } else {
                        alertToast("Acci\xf3n cancelada",3500);
                    }
                });
        }


    </script>
@endsection

