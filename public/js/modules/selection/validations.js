$.ajaxSetup({
    // Disable caching of AJAX responses
    cache: false
});
$(function () {


    $('[data-popup=popover-custom]').popover({
        template: '<div class="popover border-teal-400"><div class="arrow"></div><h3 class="popover-title bg-teal-400"></h3><div class="popover-content"></div></div>'
    });

    $("select[name=concourses]").on('change', function (event) {
        event.preventDefault();
        var contentValue = (this.value);
        $("#hddConcourse").val(contentValue);
        if (contentValue != '*') {
            var option = $(this).find("option:selected");
            var status = option.attr('data-status') == 'A' ? 'ACTIVO' : 'INACTIVO';

            $("#lblRangeProcess").html( option.attr('data-date_initial')+" / "+option.attr('data-date_finish'));
            $("#lblStatusProcess").html( status);

            var objApiRest = new AJAXRest('/selection/selection-config-statistics', {id:contentValue}, 'POST');
            objApiRest.extractDataAjax(function (_resultContent,status) {
                if (status != 200) {
                    alertToast(_resultContent.message, 3500);
                } else {
                    $("#postulantes").html(_resultContent.postulants);

                    var idxData=0;
                    var btnData='';
                    $.each( _resultContent.steps, function( key, value ) {
                        console.log(value);
                        btnData="<a href='/selection/selection-config-validation-users-"+value.id+"' style='padding: 4px 13px;' class='btn btn-primary btn-xs'>PROCESAR</a>";
                        if(idxData!=0 && value.step_old==null){
                            btnData='';
                        }
                        $("#trDescriptions").append("<tr><td>"+value.description+"</td><td>"+value.date_start+" / "+value.date_end+"</td><td>"+btnData+"</td></tr>");
                   idxData++;
                    });
                    $("#reportPostulants").attr('href', '/selection/selection-config-statistics-postulants-' + contentValue);
                    getCharts();
                }
            });



        } else {
            $("#postulantes").html('0');
            $("#validate").html('0');
            $("#trDescriptions").html("");
            $("#reportPostulants").attr('href', '#');
            $("#reportValidate").attr('href', '#');

            $('#basic_lines').html('');

            $("#lblRangeProcess").html( "--");
            $("#lblStatusProcess").html("--");
        }
    });


    $("button[id=btnProcess]").on('click', function (event) {
        event.preventDefault();
        if ($("select[name=concourses]").val() != '*') {
            var url = $("#frmConcourse").attr('action').replace("%7Bid%7D", $("select[name=concourses]").val());
            window.location.href = url;
        } else {
            alertToast("Debes seleccionar un proceso antes de continuar", 3500);
        }
    });


});

function getCharts() {

    var objApiRest = new AJAXRest('/selection/selection-config-statistics-global', {'id': $("#hddConcourse").val()}, 'POST');
    objApiRest.extractDataAjax(function (_resultContent,status) {
        if (status != 200) {
            alertToast(_resultContent.message, 3500);
        } else {
            var arrayDate = new Array();
            var arrayValor = new Array();
            for (i = 0; i < _resultContent.global.length; i++) {
                arrayDate.push(_resultContent.global[i].date);
                arrayValor.push(parseInt(_resultContent.global[i].valor));
            }
            getGraph(arrayDate, arrayValor, 'basic_lines', 'POSTULACIONES REALIZADAS '+$("#concourses option:selected").text());
        }
    });
}

function getGraph(arrayDate, arrayValor, element, title) {
    Highcharts.chart(element, {
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
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Users',
            data: arrayValor
        }]
    });

}
