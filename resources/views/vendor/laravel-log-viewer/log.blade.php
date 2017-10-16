@extends('layouts.back')
@section('masterTitle')
    Logs
@endsection
@section('masterTitleModule')
    Logs
@endsection
@section('masterDescription')
    Pantalla de logs generados en el Sistema.
@endsection
@section('mainContent')

    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> {{ env('APP_NAME') }} Log View
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-3 col-md-2 sidebar">

                        <div class="list-group">
                            @foreach($files as $file)
                                <a href="?l={{ base64_encode($file) }}" class="list-group-item @if ($current_file == $file) llv-active @endif">
                                    {{$file}}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-9 col-md-10 table-container">

                        @if ($logs === null)
                            <div class=" alert important bg-danger text-center text-bold">
                                <span> Archivo de Logs pesa mas de 50M, por favor proceda a descargarlo.</span>
                            </div>
                        @else
                            <div class="table-responsive no-padding">
                                <table id="table-log" class="table table-bordered table-striped table-hover">
                                    <thead>

                                    <th>Nivel</th>
                                    <th>Contexto</th>
                                    <th>Fecha</th>
                                    <th>Contenido</th>

                                    </thead>
                                    <tbody>

                                    @foreach($logs as $key => $log)
                                        <tr>
                                            <td class="text-{{$log['level_class']}} text-center"><span class="glyphicon glyphicon-{{$log['level_img']}}-sign" aria-hidden="true"></span> &nbsp;{{$log['level']}}</td>
                                            <td>{{$log['context']}}</td>
                                            <td>{{Carbon::parse($log['date'])->diffForHumans() }}</td>
                                            <td>
                                                @if ($log['stack']) <a class="pull-right expand btn btn-default btn-xs"

                                                                       data-toggle="modal" data-target="#stack{{$key}}"
                                                                      ><span class="glyphicon glyphicon-search"></span></a>@endif
                                                <code>{{$log['text']}}</code>

                                                @if (isset($log['in_file'])) <br /><code>{{$log['in_file']}}</code>@endif
                                                @if ($log['stack']) <div class="modal fade" id="stack{{$key}}">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header headerError">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title">{{$log['context']}} - {{$log['date']}}</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {{ trim($log['stack']) }}
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                       </div>@endif
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>

                        @endif

                    </div>
                </div>
            </div>
            <div class="panel-footer">
                @if($current_file)
                    <a href="?dl={{ base64_encode($current_file) }}" class="btn btn-twitter"><span class="glyphicon glyphicon-download-alt"></span> Descargar Archivo</a>
                    -
                    <a id="delete-log" href="?del={{ base64_encode($current_file) }}" class="btn btn-google"><span class="glyphicon glyphicon-trash"></span> Eliminar Archivo</a>
                    @if(count($files) > 1)
                        -
                        <a id="delete-all-log" href="?delall=true" class="btn btn-flickr"><span class="glyphicon glyphicon-trash"></span> Eliminar Todo</a>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection

@section('masterCssCustom')
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
@endsection

@section('masterJsCustom')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#table-log').DataTable({
            "order": [ 1, 'desc' ],
            responsive: true, "oLanguage": {
                "sUrl": "/js/config/datatablespanish.json"
            },
        });

        $('#delete-log, #delete-all-log').click(function(){
            return confirm('Est\u00E1s seguro que deseas eliminar el archivo?');
        });
    });
</script>
@endsection