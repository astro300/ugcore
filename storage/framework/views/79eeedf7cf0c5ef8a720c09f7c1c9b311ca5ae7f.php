<?php $__env->startSection('masterTitle'); ?>
    Tipos de Documentos Para Formulario
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
    Tipos de Documentos Para Formulario del Proceso de Selecci&oacute;n de Personal
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    Campos para tipos de Documentos
<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainContent'); ?>
    <div class="col-lg-5">
        <div>
            <div class="panel panel-primary panel-bordered">
                <div class="panel-heading " style="padding: 4px">
                    <h5 class="panel-title text-bold" style="text-align: center;">TIPO DE DOCUMENTOS</h5>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <?php echo Form::label('name','Nombre: ',["class"=>"text-bold col-lg-3 control-label"]); ?>

                        <div class="col-lg-9">
                            <?php echo Form::label('name',$objTypeDocument->name,["class"=>"col-lg-12 normalText"]); ?>

                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo Form::label('description','Descripci&oacute;n: ',
                        ["class"=>"text-bold col-lg-3 control-label"]); ?>

                        <div class="col-lg-9">
                            <?php echo Form::label('description',$objTypeDocument->description,["class"=>"col-lg-12 normalText"]); ?>

                        </div>
                    </div>


                    <div class="form-group">
                        <?php echo Form::label('prefix','Prefijo: ',
                        ["class"=>"text-bold col-lg-3 control-label"]); ?>

                        <div class="col-lg-9">
                            <?php echo Form::label('prefix',$objTypeDocument->prefix,["class"=>"col-lg-12 normalText"]); ?>

                        </div>
                    </div>


                    <div class="form-group">
                        <?php echo Form::label('status','Estado: ',["class"=>"text-bold col-lg-3 control-label"]); ?>

                        <div class="col-lg-9">
                            <?php echo Form::label('status',Config::get('dataselects.status')[$objTypeDocument->status],["class"=>"col-lg-12 normalText"]); ?>

                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo Form::label('nametable','Tabla: ',
                        ["class"=>"text-bold col-lg-3 control-label"]); ?>

                        <div class="col-lg-9">
                            <?php echo Form::label('nametable',$objTypeDocument->nametable==''?'--':$objTypeDocument->nametable,["class"=>"col-lg-12 normalText"]); ?>

                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                        <a href="<?php echo e(route('selection.typedocument.index')); ?>"
                           class="btn btn-danger btn-xs"><b><i
                                        class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="form-horizontal">
            <div class="panel panel-primary panel-bordered">
                <div class="panel-heading" style="padding: 4px">
                    <h5 class="panel-title text-bold" style="text-align: center;">CAMPOS EN BASE DE DATOS</h5>
                </div>
                <div class="panel-body">
                    <?php echo Form::hidden('codeField','',[]); ?>

                    <?php echo Form::hidden('codeTR','',[]); ?>

                    <?php echo Form::hidden('codeDocument',$objTypeDocument->id,[]); ?>


                    <div class="form-group">
                        <?php echo Form::label('titulo','Titulo: ',["class"=>"text-bold col-lg-3 control-label"]); ?>

                        <div class="col-lg-9">
                            <?php echo Form::text('titulo','',["class"=>"col-lg-12 form-control"]); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo Form::label('nombre','Nombre: ',["class"=>"text-bold col-lg-3 control-label"]); ?>

                        <div class="col-lg-9">
                            <?php echo Form::text('nombre','',["class"=>"col-lg-12 form-control"]); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo Form::label('validacion','Validaci&oacute;n: ',["class"=>"text-bold col-lg-3 control-label"]); ?>

                        <div class="col-lg-9">
                            <?php echo Form::text('validacion','',["class"=>"col-lg-12 form-control"]); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo Form::label('estado','Estado: ',["class"=>"text-bold col-lg-3 control-label"]); ?>

                        <div class="col-lg-9">
                            <?php echo Form::select('estado',['A'=>'ACTIVO','I'=>'INACTIVO'],'A',["class"=>"select2"]); ?>

                        </div>
                    </div>
                    <div class="row text-center">
                        <button onclick="addFields()" class="btn btn-primary btn-xs btn-labeled legitRipple btn-xs" id="btnSaveFieldDocument"><b><i
                                        class=" icon-plus-circle2 position-left"> </i></b>AGREGAR</button>

                        <button style="display: none" onclick="clearFormFields()" class="btn btn-danger btn-xs btn-labeled
                        legitRipple btn-xs" id="btnClearFieldDocument"><b><i
                                        class=" icon-close2 position-left"> </i></b>CANCELAR</button>

                        <button  style="display: none"  id="btnUpdateFieldDocument" onclick="updateFields()"
                                 class="btn btn-success btn-xs"><b><i class=" icon-spinner9"></i></b>ACTUALIZAR</button>
                    </div>
                    <hr/>
                    <div class="form-group">

                       <div class="table-responsive">
                        <table class="table table-bordered ">
                            <thead>
                            <th width="40%">LABEL</th>
                                <th width="40%">CAMPO</th>
                            <th width="10%">ESTADO</th>
                                <th width="10%">ACCIONES</th>
                            </thead>
                            <tbody id="tBodyField">
                               <?php $__currentLoopData = $objTypeDocument->meritTypeDocumentFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td id="td_0_<?php echo e($key); ?>"><?php echo e($field->name); ?></td>
                                    <td id="td_1_<?php echo e($key); ?>"><?php echo e($field->fields); ?></td>
                                    <td id="td_2_<?php echo e($key); ?>"><?php echo e($field->status=='A'?'ACTIVO':'INACTIVO'); ?></td>
                                    <td> <a onclick="actionFields(this)" data-tr="<?php echo e($key); ?>" data-code="<?php echo e($field->id); ?>" class="text-primary text-bold"><i class="fa fa-pencil" ></i></a></td>
                                </tr>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br/>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('masterCssCustom'); ?>
    <?php echo Html::style('css/datatables.css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('masterJsCustom'); ?>
<script type="text/javascript">
    function actionFields(_field){
        var objApiRest = new AJAXRest('/selection/fields-document/'+$(_field).data('code'), {}, 'POST');
        objApiRest.extractDataAjax(function (_resultContent) {
            if(!$.isEmptyObject(_resultContent)){
                try{
                    $("input[name=codeTR]").val($(_field).data('tr'));
                    $("input[name=titulo]").val(_resultContent.data.name);
                    $("input[name=nombre]").val(_resultContent.data.fields);
                    $("input[name=nombre]").prop('readonly', true);
                    $("input[name=validacion]").val(_resultContent.data.regexdata);
                    $("input[name=codeField]").val(_resultContent.data.id);
                    $('select[name=estado]').val(_resultContent.data.status);
                    $("#btnSaveFieldDocument").hide();
                    $("#btnUpdateFieldDocument").show();
                    $("#btnClearFieldDocument").show();

                }catch (ex){
                    console.log(ex);
                }
            }
        });

    }

    function addFields(){
        var objApiRest = new AJAXRest('/selection/fields-document-save/'+$("input[name=codeDocument]").val(), {
            'titulo':$("input[name=titulo]").val(),
            'nombre':$("input[name=nombre]").val(),
            'validacion':$("input[name=validacion]").val(),
            'estado':$("select[name=estado]").val()
        }, 'POST');
        objApiRest.extractDataAjax(function (_resultContent) {
            if(!$.isEmptyObject(_resultContent)){
                try{
                    alertToastSuccess(_resultContent.data,3500);
                    var date=new Date();
                    var nTime = date.getTime();
                    var estado=$('select[name=estado]').val()=='A'?'ACTIVO':'INACTIVO';

                    $("#tBodyField").append(
                        "<tr>" +
                            "<td id='td_0_"+nTime+"'>"+$('input[name=titulo]').val()+"</td>" +
                            "<td id='td_1_"+nTime+"'>"+$('input[name=nombre]').val()+"</td>" +
                            "<td id='td_2_"+nTime+"'>"+estado+"</td>" +
                            "<td><a onclick='actionFields(this)' data-tr='"+nTime+"' data-code='"+_resultContent.code+"' class='text-primary text-bold'><i class='fa fa-pencil' ></i>&nbsp;Editar</a></td>" +
                        "</tr>"
                    );

                    clearFormFields();
                }catch (ex){
                    console.log(ex);
                }
            }
        });
    }

    function updateFields(){
        var objApiRest = new AJAXRest('/selection/fields-document-update/'+$("input[name=codeField]").val(), {
            'titulo':$("input[name=titulo]").val(),
            'nombre':$("input[name=nombre]").val(),
            'validacion':$("input[name=validacion]").val(),
            'estado':$("select[name=estado]").val()
    }, 'POST');
        objApiRest.extractDataAjax(function (_resultContent) {
            if(!$.isEmptyObject(_resultContent)){
                try{
                    alertToastSuccess(_resultContent.data,3500);
                    var codeTR=$("input[name=codeTR]").val();
                    $("#td_0_"+codeTR).html($("input[name=titulo]").val());
                    $("#td_2_"+codeTR).html($("select[name=estado]").val()=='A'?'ACTIVO':'INACTIVO');
                    clearFormFields();
                }catch (ex){
                    console.log(ex);
                }
            }
        });
    }

    function clearFormFields() {
        clearInputName(['titulo','nombre','validacion','codeField','codeTR'],'');
        clearSelectName(['estado'],'');
        $("input[name=nombre]").prop('readonly', false);
        $("#btnSaveFieldDocument").show();
        $("#btnUpdateFieldDocument").hide();
        $("#btnClearFieldDocument").hide();
    }
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>