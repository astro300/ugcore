<div id="dvModalupdateactivity" class="modal fade" tabindex="-1" style="display:none" >
    <div class="modal-dialog" id="mdialTamanio">
        <div class="modal-content ">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h6 class="modal-title">AGREGAR/EDITAR ACTIVIDAD</h6>
            </div>

            <form class="form-horizontal" method="post" id="formActivityStudent" action="" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>


            <div class="modal-body">
                <div class="form-group">
                    <?php echo Form::label('date','FECHA',["class"=>"text-bold col-lg-3 control-label"]); ?>

                    <div class="col-lg-9">
                            <input type="text" name="date" class="form-control pickadate"
                                      placeholder="Agregar una Fecha...">
                    </div>
                </div>
                <div class="form-group">
                       <?php echo Form::label('n_hours','N° HORAS',["class"=>"text-bold col-lg-3 control-label"]); ?>

                        <div class="col-lg-9">
                            <?php echo Form::select('n_hours',Config::get('dataselects.horasActividad'),null,["class"=>"from-control select2" ,"id"=>"n_hours"]); ?>

                        </div>

                </div>


                <div class="form-group">
                        <?php echo Form::label('description','DESCRIPCIÓN',["class"=>"text-bold col-lg-3 control-label"]); ?>

                        <div class="col-lg-9">
                            <textarea  style="resize:none" type="text" name="description" class="form-control"
                                      placeholder="Describir la Actividad Diaria..." rows="3" cols="200"></textarea>
                        </div>
                </div>
                <div class="form-group">
                        <?php echo Form::label('observation','OBSERVACIÓN',["class"=>"text-bold col-lg-3 control-label"]); ?>

                        <div class="col-lg-9">
                            <textarea  style="resize:none" type="text" name="observation" class="form-control"
                                      placeholder="Describir Observación de la Actividad Diaria..." rows="3"
                                      cols="200"></textarea>
                        </div>
                </div>

                <div class="form-group" id="dvAnexosOld">

                </div>
                <div class="form-group">
                    <?php echo Form::label('anexo','ANEXOS',["class"=>"text-bold col-lg-3 control-label"]); ?>

                    <div class="col-lg-9">
                           <input type="file" name="anexo[]" id="anexo" multiple="multiple" class="file-input-new"/>
                    </div>
                </div>

                <input type="hidden" class="form-control" id="id_actividad" name="id_actividad">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info legitRipple" style="margin-top: 14px;">Grabar</button>
                <button type="button" class="btn btn-warning legitRipple" style="margin-top: 14px;"
                        data-dismiss="modal">Salir
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>


</script>