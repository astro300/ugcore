<div  id="dvModalinsertsecretary" class="modal fade" tabindex="-1">
            <div class="modal-dialog" id="mdialTamanio">
              <div class="modal-content">
                <div class="modal-header bg-info">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h6 class="modal-title">AGREGAR INFORMACION ADICIONAL PARA EL CERTIFICADO</h6>
                </div>

          {!! Form::open(['route'=>['preprofessional.practices.pdfCertificate'],'method'=>'POST']) !!}

                <div class="modal-body">

                        <div class="col-lg-12">
                            {!! Field::textarea('secretary',null,['label'=>'NOMBRE DEL SECRETARIO','style'=>'resize:none','rows'=>3,'required'=>'required',
                            'placeholder'=>"Ingrese secretario de la carrera.."]) !!}
                        </div>
                        <div class="col-lg-12">
                              {!! Field::textarea('deca',null,['label'=>'NOMBRE DEL DECANO','style'=>'resize:none','rows'=>3,'required'=>'required',
                              'placeholder'=>"Ingrese Decano de la Facultad.."]) !!}
                        </div>

                        <div class="col-lg-12">
                            {!! Field::textarea('cordinator',null,['label'=>'NOMBRE DEL COORDINADOR','style'=>'resize:none','rows'=>3,'required'=>'required',
                            'placeholder'=>"Ingrese coordinador de las practicas Pre Profesionales.."]) !!}
                        </div>

                        <input type="text" name="id_studen"  style="visibility:hidden" class="form-control" id="id_studen" placeholder="">
                </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info legitRipple" style="margin-top: 14px;" >DESCARGAR CERTIFICADO</button>

                      <button type="button" class="btn btn-warning legitRipple" style="margin-top: 14px;" data-dismiss="modal">Salir</button>

                      <input type="hidden" id="eid" value="" name="eid" />
                
                    </div>
          {!! Form::close() !!}  
              </div>
            </div>
          </div>

  <style>
    #mdialTamanio{
      width: 50% !important;
      height: 50% !important;
    }
  </style>