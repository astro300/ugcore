<div  id="dvModalupdatedocument" class="modal fade" tabindex="-1">
            <div class="modal-dialog" id="mdialTamanio">
              <div class="modal-content">
                <div class="modal-header bg-info">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h6 class="modal-title">EDITAR ACTIVIDAD</h6>
                </div>

          {!! Form::open(['enctype'=>"multipart/form-data",'route'=>['preprofessional.practices.updateDocuments'],'method'=>'POST']) !!}

                <div class="modal-body">
                        <div class="form-group">
                                <div class="col-lg-12">
                                         {!! Form::label('parameters','SUBIR DOCUMENTO',array("class" => "text-bold col-lg-6 control-label")) !!} 
                                </div> 
                                <div class="col-lg-15">
                                <input required="required" name="archivo" type="file" class="file-inputall" data-show-preview="false" data-show-upload="false">
                                </div>  
                                
                            </div>  
                          <input type="text" name="id_document" style="visibility:hidden" class="form-control" id="id_document" placeholder="">
                          <input type="text" name="id_student" style="visibility:hidden" class="form-control" id="id_student" placeholder="">
                          <input type="text" name="id_faculty" style="visibility:hidden" class="form-control" id="id_faculty" placeholder="">
                          <input type="text" name="id_carreer" style="visibility:hidden" class="form-control" id="id_carreer" placeholder="">
                      </div>
                      <div class="modal-footer">
                          <button type="submit" class="btn btn-info legitRipple" style="margin-top: 14px;" >MODIFICAR</button>

                        <button type="button" class="btn btn-warning legitRipple" style="margin-top: 14px;" data-dismiss="modal">SALIR</button>
                      <input type="hidden" id="eid" value="" name="eid" />
                      </div>
          {!! Form::close() !!}  
              </div>
            </div>
          </div>

  <style>
    #mdialTamanio{
      width: 40% !important;
      height: 40% !important;
    }
  </style>

