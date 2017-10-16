/**
 * Created by eliberio on 14/11/16.
 */

$(function () {

    $("#dvButtonActions").html('<button onclick="addConcepts()" id="btnAddConcepts" class="btn btn-primary"> <b><i class=" icon-plus-circle2"></i></b>AGREGAR</button> <a class="btn btn-danger" href="/selection/config"> <b><i class=" icon-circle-left2"></i></b> REGRESAR</a>');
});

function addConcepts() {
    assigmentDocumentConcourse($("select[name=requiredf]").val(), $("select[name=status]").val(), $("select[name=category]").val(), $("select[name=subCategory]").val(), $("select[name=typeDocument]").val(),
        $("select[name=order]").val(), $("input[name=observation]").val(), $("input[name='_urlAjaxPut']").val(),
        $("input[name='score']").val(),$("select[name='number_max_valid']").val(),$("input[name='max_score']").val(),$("select[name=many]").val());
}
function editConcepts() {
    assigmentDocumentConcourse($("select[name=requiredf]").val(), $("select[name=status]").val(), $("select[name=category]").val(), $("select[name=subCategory]").val(), $("select[name=typeDocument]").val(),
        $("select[name=order]").val(), $("input[name=observation]").val(), "/selection/config/conceptupdate/" + $("input[name='_conceptID']").val(),
        $("input[name='score']").val(),$("select[name='number_max_valid']").val(),$("input[name='max_score']").val(),$("select[name=many]").val());
}


function editConcept(button) {

    var objApiRest = new AJAXRest($(button).attr('data-href'), {}, 'GET');
    objApiRest.extractDataAjax(function (_resultContent, status) {
        if (status == 200) {
            $("select[name=category]").val(_resultContent.meritcategory_id);
            $("select[name=subCategory]").val(_resultContent.meritsubcategory_id);
            $("select[name=typeDocument]").val(_resultContent.merittypedocument_id);
            $("input[name=observation]").val(_resultContent.observation);
            $("select[name=order]").val(_resultContent.ubication);
            $("select[name=status]").val(_resultContent.status);
            $("select[name=requiredf]").val(_resultContent.required == null ? '2' : _resultContent.required);
            $("select[name=typeDocument]").attr('disabled', true);
            $("select").trigger("change");
            $("#dvButtonActions").html(' <button onclick="editConcepts()"  id="btnUpdateConcepts" class="btn btn-success"><b><i class=" icon-spinner9"></i></b>ACTUALIZAR</button>   <a class="btn btn-danger" href="/selection/config"> <b><i class=" icon-circle-left2"></i></b> REGRESAR</a>');
            $("input[name='_conceptID']").val(_resultContent.id);


            $("input[name='score']").val(_resultContent.score==null?'0':_resultContent.score);
            $("select[name='number_max_valid']").val(_resultContent.number_max_valid==null?'1':_resultContent.number_max_valid);
            $("input[name='max_score']").val(_resultContent.max_score==null?'0':_resultContent.max_score);
            valueSelect('many',_resultContent.many);
            $("input[name=score]").focus();
            $("html, body").animate({scrollTop: 0}, 600);
        } else {
            alertToast(_resultContent.message, 3500);
        }
    });
}


function assigmentDocumentConcourse(required, status, category, subCategory, typeDocument, order, observation, dataUrl,score,number_max_valid,max_score,many) {

    var objApiRest = new AJAXRest(dataUrl, {
            'requiredf': required,
            'category': category,
            'subCategory': subCategory,
            'typeDocument': typeDocument,
            'order': order,
            'observation': observation,
            'status': status,
            'score':score,
            'number_max_valid':number_max_valid,
            'max_score':max_score,
            'many':many
        }
        , 'POST');
    objApiRest.extractDataAjax(function (result, status) {
        if (status == 200) {
            if (result.type == "success") {

                if (result.action == "ADD") {
                    var tdRequired = "";
                    if (result.required == '1') {
                        tdRequired = ("<b style='color: #ff0000;font-size: 16px'>*</b> " + $("select[name=typeDocument]>option:selected").text());
                    } else {
                        tdRequired = ($("select[name=typeDocument]>option:selected").text());
                    }

                    $("#tBodyConcept").append("<tr id='_tr_" + result.conceptConcourse + "'><td  id='_td_" + result.conceptConcourse + "_0'>" + $("select[name=category]>option:selected").text() + "</td><td id='_td_" + result.conceptConcourse + "_1'>"
                        + $("select[name=subCategory]>option:selected").text() + "</td><td id='_td_" + result.conceptConcourse + "_2'>"
                        + tdRequired + "</td><td id='_td_" + result.conceptConcourse + "_3'>"
                        + $("input[name=observation]").val() + "</td><td id='_td_" + result.conceptConcourse + "_4'>"
                        + $("select[name=order]").val() + "</td><td id='_td_" + result.conceptConcourse + "_5'><button class='btn btn-primary btn-xs'  onclick='editConcept(this)' style='padding: 4px;'  data-href='/selection/config/conceptedit/" + result.conceptConcourse + "'><i class='fa fa-pencil'></i>&nbsp;<span style='padding: 1px 4px;'>EDITAR</span></button></td></tr>");

                } else {
                    if (result.status == "A") {
                        $("#_td_" + result.conceptConcourse + "_0").html($("select[name=category]>option:selected").text());
                        $("#_td_" + result.conceptConcourse + "_1").html($("select[name=subCategory]>option:selected").text());

                        if (result.required == '1') {
                            $("#_td_" + result.conceptConcourse + "_2").html("<b style='color: #ff0000;font-size: 16px'>*</b> " + $("select[name=typeDocument]>option:selected").text());
                        } else {
                            $("#_td_" + result.conceptConcourse + "_2").html($("select[name=typeDocument]>option:selected").text());
                        }
                        $("#_td_" + result.conceptConcourse + "_3").html($("input[name=observation]").val());
                        $("#_td_" + result.conceptConcourse + "_4").html($("select[name=order]>option:selected").text());
                    } else {
                        $("#_tr_" + result.conceptConcourse).remove();
                    }
                    $("#dvButtonActions").html('<button onclick="addConcepts()"  id="btnAddConcepts" class="btn btn-primary "> <b><i class=" icon-plus-circle2"></i></b>AGREGAR</button> <a  class="btn btn-danger" href="/selection/config"> <b><i class=" icon-circle-left2"></i></b> REGRESAR</a>');
                    $("#_hddAction").val('A');
                    $("select[name=typeDocument]").attr('disabled', false)
                }

                $("select[name=order]").val('1');
                $("input[name=observation]").val('');
                $("select[name=status]").val('A');
                $("select[name=requiredf]").val('2');
                $("input[name='score']").val('0');
                $("select[name='number_max_valid']").val('1');
                $("input[name='max_score']").val('0');
                $("select").prop('selectedIndex', 0);
                $("select").trigger("change");
            }
            new PNotify({
                icon: 'icon-notification2',
                title: 'Notificaci\u00F3n',
                text: result.text,
                addclass: 'alert ' + result.cssAlert + ' alert-styled-right',
                type: result.type,
                delay: 1000
            });

        } else {
            alertToast(result.message, 3500);
        }
    });


}