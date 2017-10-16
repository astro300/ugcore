@extends('admin.template.main')
@section('masterTitle')
    Formación Profesional - UATH
@endsection
@section('masterTitleModule')
    Formación Profesional - UATH
@endsection
@section('masterDescription')
    <div class="panel-heading">
        <h5 class="panel-title text-bold">Reportes de Formación Profesional - UATH</h5>
    </div>
@endsection
@section('mainContent')
    <div class="row">
        <div class="panel-group col-lg-10 col-lg-offset-1" id="accordion">
            <div class="panel panel-group-control border-right-info border-top-info border-bottom-info border-left-info">
                <div class="panel-body">
                    <table class="table table-hover table-responsive">
                        <thead class="bg-primary-700">
                        <tr>
                            <th>NO.</th>
                            <th>REPORTE</th>
                            <th style="text-align: center">PARÁMETROS</th>
                            <th style="text-align: center">VER</th>
                            <th style="text-align: center">DESCARGAR</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>NÓMINA POR GRUPO</td>
                            <td style="text-align: center">
                                {!! Form::select('selgruposrp', $listaComboGruposRp, null,['placeholder'=>'-Seleccione-','required' => 'required','class' => 'form-control select',"id"=>'selgruposrp']) !!}
                            </td>
                            <td align="center"><a href="#" id="a1" onclick="enviar1('a1',1,document.getElementById('selgruposrp').value)" target="_blank">
                                    <button class="btn btn-info"><span class="fa fa-eye"></span></button>
                                </a></td>
                            <td align="center"><a href="#" id="a2" onclick="enviar1('a2',2,document.getElementById('selgruposrp').value)" target="_blank">
                                    <button class="btn btn-success"><span class="fa fa-download"></span></button>
                                </a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>NÓMINA POR ESTADO</td>
                            <td>
                                {!! Form::select('selgruposestrp', $listaComboGruposRp, null,['placeholder'=>'-Grupos-','required' => 'required','class' => 'form-control select',"id"=>'selgruposestrp']) !!}
                                {!! Form::select('selestadorp', ['T'=>'Todos','A'=>'Aprobados','R'=>'Reprobados'], null,['placeholder'=>'-Estado-','required' => 'required','class' => 'form-control select',"id"=>'selestadorp']) !!}
                            </td>
                            <td align="center"><a href="#s" id="b1" onclick="enviar2('b1',1,document.getElementById('selgruposestrp').value,document.getElementById('selestadorp').value)"  target="_blank">
                                    <button class="btn btn-info"><span class="fa fa-eye"></span></button>
                                </a></td>
                            <td align="center"><a href="#" id="b2" onclick="enviar2('b2',2,document.getElementById('selgruposestrp').value,document.getElementById('selestadorp').value)"  target="_blank">
                                    <button class="btn btn-success"><span class="fa fa-download"></span></button>
                                </a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("masterJsCustom")
    {!!Html::script('https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js')!!}
    {!!Html::script('https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/md5.min.js')!!}
    <script type="text/javascript">
        function enviar1(id, tipo, r1) {
            var grupo=$("#selgruposrp option:selected").html();
            var wordArray = CryptoJS.enc.Utf8.parse(r1+";"+grupo);
            var base64 = CryptoJS.enc.Base64.stringify(wordArray);
            $("#" + id).attr("href", "reportes/rpNominaGrupo/" + tipo + "/NominaGrupo;" + base64);
        }

        function enviar2(id, tipo, r1,r2) {
            var grupo = $("#selgruposestrp option:selected").html();
            var estado = $("#selestadorp option:selected").html();
            var wordArray = CryptoJS.enc.Utf8.parse(r1 + ";" + r2 + ";" + estado + ";" + grupo);
            var base64 = CryptoJS.enc.Base64.stringify(wordArray);
            $("#" + id).attr("href", "reportes/rpNominaEstado/" + tipo + "/NominaEstado;" + base64);
        }
    </script>
@endsection
