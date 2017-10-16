<div class="text-center div_padding">
    <img src="/images/logo_.png" width="100px">

</div>
<br/>

<button id="btnComment" class="btn btn-primary btn-block margin-bottom">Publicar</button>
<input value="{{$categories}}" id="hdfCategories" type="hidden"/>
<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Categor&iacute;as</h3>

        <div class="box-tools">

            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked" id="ulCategories">
            @foreach($categories as $category)
                @if($owner)
                    <li><a href="{{route('forum.comment.owner.category',$category->slug)}}"><i class="fa fa-filter"></i> {{$category->nombre}}
                            <span class="label label-success pull-right">{{$category->commentsCountOwner}}</span></a>
                    </li>
                @else
                    <li><a href="{{route('forum.comment.category',$category->slug)}}"><i class="fa fa-filter"></i> {{$category->nombre}}
                            <span class="label label-success pull-right">{{$category->commentsCount}}</span></a>
                    </li>
                @endif

            @endforeach
        </ul>
    </div>
    <!-- /.box-body -->
</div>


<a id="btnCommentOwner"  href="{{route('forum.comment.owner',Auth::user()->id)}}" class="btn bg-slate-600 btn-block margin-bottom">Publicaciones Propias</a>
<a href="{{route('forum.index')}}" id="btnCommentGlobal" class="btn bg-slate-600 btn-block margin-bottom"><span class="label label-danger pull-right"></span>Todos las Publicaciones</a>
<!-- /.box -->