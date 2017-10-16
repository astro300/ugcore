<div id="dvModalActivityAnexos" class="modal fade" tabindex="-1" style="display:none" >
    <div class="modal-dialog " style="width: 80%">
        <div class="modal-content ">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h6 class="modal-title">Vista de Anexos</h6>
            </div>

            <div class="form-horizontal">
                <div class="modal-body">
                   <div class="row">
                    <div class="col-lg-4">
                       <div class="col-lg-12">
                           <?php echo Field::text('date',null,['label'=>'FECHA','readonly']); ?>

                           <?php echo Field::text('n_hours',null,['label'=>'N° HORAS','readonly']); ?>

                           <?php echo Field::textarea('description',null,['label'=>'DESCRIPCION','style'=>'resize:none','rows'=>3,'readonly']); ?>

                           <?php echo Field::textarea('observation',null,['label'=>'OBSERVACION','style'=>'resize:none','rows'=>3,'readonly']); ?>

                       </div>



                    </div>
                    <div class="col-lg-8">
                        <div class="box box-solid box-primary">
                            <div class="box-body" id="boxBodyItem">

                            </div>
                        </div>
                        <!-- /.box -->
                    </div>
                   </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning legitRipple" style="margin-top: 14px;"
                            data-dismiss="modal">Salir
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
