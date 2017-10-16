<div id="dvModalValidateActivity" class="modal fade" tabindex="-1" style="display:none">
    <div class="modal-dialog" id="mdialTamanio">
        <div class="modal-content ">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h6 class="modal-title">VALIDAR ACTIVIDAD</h6>
            </div>
                {!! csrf_field() !!}
                <div>
                    <div class="col-lg-12">
                        <div class="col-lg-6">
                            {!!  Field::text('date',null,['class'=>"pickadate",'disabled'=>"disabled",'style'=>'resize:none','label'=>'FECHA','placeholder'=>"sin datos...."]) !!}
                        </div>
                        <div class="col-lg-6">
                            {!! Field::select('n_hours',Config::get('dataselects.horasActividad'),null,["class"=>"from-control select2",'label'=>'N° HORAS','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col-lg-6">
                            {!!  Field::textarea('description',null,['style'=>'resize:none','label'=>'DESCRIPCI&Oacute;N','rows'=>6,'placeholder'=>"sin datos...."]) !!}
                        </div>
                        <div class="col-lg-6">
                            {!!  Field::textarea('observation',null,['style'=>'resize:none','label'=>'OBSERVACI&Oacute;N','rows'=>6,'placeholder'=>"sin datos...."]) !!}
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group" id="dvAnexosOld">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        {!! Field::select('veredicto',['1'=>'APROBADO','0'=>'REPROBADO'],'1',["class"=>"from-control select2",'label'=>'VEREDICTO']) !!}
                    </div>
                    <div class="col-lg-12">
                        {!!  Field::textarea('obs_veredict',null,['style'=>'resize:none','label'=>'OBSERVACI&Oacute;N VEREDICTO','rows'=>3,'maxlength'=>"500",'placeholder'=>"Escribir una observaci&oacute;n de ser necesario..."]) !!}
                    </div>

                    <input type="hidden" class="form-control" id="id_actividad" name="id_actividad">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info legitRipple" style="margin-top: 14px;" id="btnValidateActivity">GRABAR</button>
                    <button type="button" class="btn btn-warning legitRipple" style="margin-top: 14px;"
                            data-dismiss="modal">Salir
                    </button>
                </div>

        </div>
    </div>
</div>

