<!--
 * Created by PhpStorm.
 * User: jairoman
 * Date: 26/6/2017
 * Time: 10:42
 -->

<!--Ventana de Ingresa Materias-->
<div id="modal_add_matter" class="modal fade in" style="display: none; padding-right: 15px;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title text-bold">Agregar Materias</h5>
            </div>
            <div class="modal-body panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Concurso</th>
                            <th>Área</th>
                            <th>Materia</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <hr>
                <div class="col-lg-12">{!! Field::select('areamodal',['*'=>'-Seleccione-'], null,['required'=>'required','label'=>'Área','class' => 'select2','empty'=>'-Seleccione-',"id"=>'areamodal']) !!}</div>
                <hr>
                <div class="col-lg-6">{!! Field::select('facultadmodal',['*'=>'-Seleccione-'], null,['required'=>'required','label'=>'Facultad','class' => 'select2','empty'=>'-Seleccione-',"id"=>'facultadmodal']) !!}</div>
                <div class="col-lg-6">{!! Field::select('carreramodal',['*'=>'-Seleccione-'],null,['required'=>'required','label'=>'Carrera','class' => 'select2','placeholder'=>'-Seleccione-',"id"=>'carreramodal']) !!}</div>
                <div class="col-lg-9">{!! Field::select('materiamodal[]',[],null,['required'=>'required','label'=>'Materia','class' => 'select2',"id"=>'materiamodal','multiple'=>'multiple']) !!}</div>
                <div class="col-lg-3">
                    <br>
                    <button class="btn btn-icon btn-rounded btn-success" id="agregacar" data-popup="tooltip" title=""
                            data-placement="bottom" data-original-title="Agregar Materias" onclick="agregaMateriasConcurso()">
                        Agregar
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Regresar
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Fin ventana-->