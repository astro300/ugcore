@extends('admin.template.main')
@section('masterTitle')
    Reportes de Encuestas
@endsection
@section('masterTitleModule')
    M&oacute;dulo de Encuestas
@endsection
@section('masterDescription')
    <b>{{ $objSurvey->name  }}</b>, <code>{{ $objSurvey->description }}</code>
@endsection

@section('masterButtonBreadCrumb')
    <ul class="breadcrumb-elements">
        <li style="background-color: #A2AEEA"><a href="{{route('surveys.report_global')}}" class="legitRipple"><i class="fa fa-reply position-left"></i>Regresar</a></li>
    </ul>
    @endsection


@section('mainContent')
    <div class="col-lg-12">
        {{--*/ $keyCode=1 /*--}}

        @forelse($dataReport['data'] as $data)
            <div class="panel panel-default panel-bordered" style="border: 1px solid  #00BCD4;">
                <div class="panel-heading" style="padding-left: 8px;padding-top: 2px;padding-bottom: 2px">
                    <h5 class="text-bold" id="question_{{$keyCode}}"> {{$keyCode}}.- {{$data['question']}}</h5>
                </div>
               <div class="panel-body" style="padding: 10px;">

                   <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="row" style="padding: 5px;">
                                <label class="text-teal-800"><b>Opciones disponibles:</b></label>
                            </div>
                            <div class="row" style="padding-bottom: 15px;">
                              @foreach($data['options'] as $keyResponse => $valueResponse)
                                    <div class="col-lg-3">
                                      <i class="text-bold icon-circle-small"></i>  {{$valueResponse}}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                       <div class="col-lg-12 col-md-12">
                            <input id="txtGraphData{{$keyCode}}"  data-key="{{$keyCode}}" value="{{json_encode($data['options'])}}" type="hidden">
                           <input id="txtGraphValue{{$keyCode}}" data-key="{{$keyCode}}" value="{{json_encode($data['cantidad'])}}" type="hidden">
                           <div id="dvGraphData{{$keyCode}}">

                           </div>
                       </div>
                   </div>
               </div>
                <div class="panel-footer panel-footer-transparent">
                    <div class="heading-elements">
                        <ul class="list-inline list-inline-condensed heading-text">
                            <li><label class="text-default"><i class=" icon-price-tags position-left text-danger-800"></i><b class="text-danger-800">Categoría:</b> {{$data['category']}}
                                </label></li>

                            <li><label class="text-default"><i class=" icon-list2 position-left text-danger-800"></i><b class="text-danger-800">Tipo: </b>{{$data['type']}}</label></li>
                        </ul>
                    </div>
                </div>
            </div>
            {{--*/ $keyCode++ /*--}}
        @empty
            <div class="panel panel-default panel-bordered" style="border: 1px solid  #00BCD4;">
                <div class="panel-heading" style="padding-left: 8px;padding-top: 2px;padding-bottom: 2px;text-align: center">
                    <h5 class="text-bold"> NO EXISTEN PREGUNTAS DE CATEGOR&Iacute;A TABULABLE</h5>
                </div>
                </div>
        @endforelse
    </div>
@endsection

@section('masterJsCustom')
    {!!Html::script('extcore/js/charts/highcharts.js')!!}
    {!!Html::script('extcore/js/charts/exporting.js')!!}
<script>
    $(document).ready(function(){

        alertSwal("En esta pantalla s\u00F3lo se presentaran las preguntas objetivas de la encuesta!!");

        $("input[id^=txtGraphData]").each(function() {
            var txtAttr=$(this).attr('data-key');
            var title=$("#question_"+txtAttr).html();
                getGraph(jQuery.parseJSON($( this ).val()), jQuery.parseJSON($('#txtGraphValue'+txtAttr).val()), 'dvGraphData'+txtAttr,title);
        });


    });

    function getGraph(arrayDate, arrayValor, element, title) {
        Highcharts.chart(element, {
            chart: {
                type: 'column'
            },
            title: {
                text: title,
                x: -20 //center
            },

            xAxis: {
                categories: arrayDate
            },
            yAxis: {
                title: {
                    text: 'Cantidad'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },

            legend: {
                enabled: false
            },
            series:  [{
                name: 'Cantidad',
                data: arrayValor
            }]

        });

    }
</script>
@endsection