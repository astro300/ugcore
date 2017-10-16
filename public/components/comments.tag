<comment-form>
    <div class="modal fade" tabindex="-1" style="display:none" id="commentForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-teal">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{title}</h4>
                </div>


                <div class="modal-body">
                    <div if="{!load}">
                        cargando informacion
                    </div>
                    <div if="{load}">
                        <input type="hidden" id="id" value="{id}"/>
                        <div class="form-group" if="{category}">
                            <label for="categories" class="control-label">
                                Categor&iacute;a:
                            </label>
                            <div class="controls">
                                <select id="categories" class="form-control select2">
                                    <option each={categories} value="{id}">{nombre}</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="comment" class="control-label">
                                Comentario:
                            </label>
                            <textarea id="comment" class="form-control" style="resize:none" rows="4" width="100%"
                                      maxlength="500">{model.comentario}</textarea>
                        </div>
                        <div class="form-group">
                            <div id="divEvidencia"></div>
                            <label for="evidencia" class="control-label">
                                Evidencia:
                            </label>

                            <input id="evidencia" type="file"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-lg-6 div_padding">
                        <button type="button" class="btn btn-danger btn-block" data-dismiss="modal"><i
                                class="fa fa-close"></i>&nbsp;Cerrar
                        </button>
                    </div>
                    <div class="col-lg-6 div_padding">
                        <button type="button" class="btn btn-success btn-block" onclick="{saveComment}"
                                if="{action=='guardar' && load==true}"><i class="fa fa-floppy-o"></i>&nbsp;Publicar
                        </button>
                        <button type="button" class="btn btn-success btn-block" onclick="{updateComment}"
                                if="{action=='actualizar' && load==true}"><i class="fa fa-floppy-o"></i>&nbsp;Actualizar
                        </button>
                        <button type="button" class="btn btn-success btn-block" onclick="{responseComment}"
                                if="{action=='responder' && load==true}"><i class="fa fa-paper-plane"></i>&nbsp;Responder
                        </button>
                        <button type="button" class="btn btn-success btn-block" onclick="{updateCommentDetail}"
                                if="{action=='actualizarDetail' && load==true}"><i class="fa fa-paper-plane"></i>&nbsp;Actualizar
                            Respuesta
                        </button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        var self = this;
        self.model = [];
        self.id = opts.id;
        self.action = opts.action;
        self.load = false;
        self.categories = $.parseJSON(opts.categories);
        self.owner = opts.owner;
        self.category = true;

        if (self.action == 'guardar') {
            self.title = "Crear Comentario";
            self.load = true;
        } else {
            if (self.action == 'responder') {
                self.title = "Respuesta al Comentario";
                self.category = false;
                self.load = true;
            } else {
                if (self.action == 'actualizarDetail') {
                    self.title = "Actualizar Comentario de Respuesta";
                    self.category = false;
                    if (self.id != '0') {
                        getCommentDetail(self.id);
                    }
                } else {
                    self.title = "Actualizar Comentario";
                    if (self.id != '0') {
                        getComment(self.id);
                    }
                }


            }

        }


        self.on('mount', function () {
            initElements();
            $("#commentForm").modal({
                show: false,
                backdrop: 'static'
            });
            $("#commentForm").modal('show');
        });


        saveComment()
        {
            var _url = "/forum-comment/save";
            var form_data = new FormData();
            form_data.append('evidencia', $("#evidencia").prop("files")[0]);
            form_data.append('categoria', $("#categories").val());
            form_data.append('comentario', $("#comment").val());
            form_data.append('owner', self.owner);
            var objApiRest = new AJAXRestFilePOST(_url, form_data);
            objApiRest.extractDataAjaxFile(function (_resultContent,status) {
                if (status==200) {
                    try {
                        $("#timeline").prepend(_resultContent.data);
                        $('#ulCategories').html('');
                        $.each(_resultContent.categories, function (key, value) {
                            var code = 0;
                            if (self.owner=='1') {
                                if ((value.comments_count_owner)!=null) {
                                    code = value.comments_count_owner.aggregate;
                                }
                            } else {
                                if ((value.comments_count)!=null) {
                                    code = value.comments_count.aggregate;
                                }
                            }
                            $('#ulCategories').append('<li><a href="#"><i class="fa fa-filter"></i>' + value.nombre + '<span class="label label-success pull-right">' + code + '</span></a></li>');

                        });
                        $('#commentForm').modal('toggle');
                        alertToastSuccess('Comentario publicado correctamente', 3500);

                    } catch (ex) {
                        console.log(ex);
                    }
                }else {
                    alertToast(_resultContent.message, 3500);
                }
            });
        }

        updateComment()
        {
            var _url = "/forum-comment/update";
            var form_data = new FormData();
            form_data.append('id', $("#id").val());
            form_data.append('evidencia', $("#evidencia").prop("files")[0]);
            form_data.append('categoria', $("#categories").val());
            form_data.append('comentario', $("#comment").val());
            form_data.append('owner', self.owner);
            var objApiRest = new AJAXRestFilePOST(_url, form_data);
            objApiRest.extractDataAjaxFile(function (_resultContent,status) {
                if (status==200) {
                    try {
                        $("#liComment_" + $("#id").val()).remove();
                        $("#timeline").prepend(_resultContent.data);

                        $('#ulCategories').html('');

                        $.each(_resultContent.categories, function (key, value) {
                            var code = 0;
                            if (self.owner=='1') {
                                if ((value.comments_count_owner)!=null) {
                                    code = value.comments_count_owner.aggregate;
                                }
                            } else {
                                if ((value.comments_count)!=null) {
                                    code = value.comments_count.aggregate;
                                }
                            }
                            $('#ulCategories').append('<li><a href="#"><i class="fa fa-filter"></i>' + value.nombre + '<span class="label label-success pull-right">' + code + '</span></a></li>');

                        });


                        $('#commentForm').modal('toggle');
                        alertToastSuccess('Comentario actualizado correctamente', 3500);

                    } catch (ex) {
                        console.log(ex);
                    }
                }else {
                    alertToast(_resultContent.message, 3500);
                }
            });
        }

        responseComment()
        {
            var _url = "/forum-comment/response";
            var form_data = new FormData();
            form_data.append('id', $("#id").val());
            form_data.append('evidencia', $("#evidencia").prop("files")[0]);
            form_data.append('comentario', $("#comment").val());
            var objApiRest = new AJAXRestFilePOST(_url, form_data);
            objApiRest.extractDataAjaxFile(function (_resultContent,status) {
                if (status==200) {
                    $('#comment_' + $("#id").val()).html(_resultContent.comentarios);
                    $('#commentForm').modal('toggle');
                    alertToastSuccess('Comentario respondido correctamente', 3500);
                    $('#divCommentsDetail_' + $("#id").val()).html('');
                }
                else {
                    alertToast(_resultContent.message, 3500);
                }
            });
        }

        updateCommentDetail()
        {
            var _url = "/forum-comment/update-detail";
            var form_data = new FormData();
            form_data.append('id', $("#id").val());
            form_data.append('evidencia', $("#evidencia").prop("files")[0]);
            form_data.append('comentario', $("#comment").val());
            form_data.append('owner', self.owner);
            var objApiRest = new AJAXRestFilePOST(_url, form_data);
            objApiRest.extractDataAjaxFile(function (_resultContent,status) {
                if (status==200) {
                    try {
                        $("#commentDetailBody_" + $("#id").val()).html(_resultContent.body);
                        if (_resultContent.file!=null && _resultContent.file!='null' && _resultContent.file!='') {
                            $("#commentDetailFile_" + $("#id").val()).html(" <b>Adjunto:</b>  <a target='_blank' href='/file-ftp/FORO/" + _resultContent.file + "'>Descargar Adjunto</a>");
                        }else{
                            $("#commentDetailFile_" + $("#id").val()).html("");
                        }

                        $('#commentForm').modal('toggle');
                        alertToastSuccess('Comentario actualizado correctamente', 3500);

                    } catch (ex) {
                        console.log(ex);
                    }
                }else {
                    alertToast(_resultContent.message, 3500);
                }
            });
        }

        function getCommentDetail(_id) {
            var _url = "/forum-comment/" + _id + "/detail-get";
            var objApiRest = new AJAXRest(_url, {}, 'GET');
            objApiRest.extractDataAjax(function (_resultContent,status) {
                if (status == 200) {
                    try {
                        self.model = _resultContent.data;
                        self.id = _resultContent.data.id;
                        self.load = true;
                        self.update();
                        initElements();
                        if (!$.isEmptyObject(_resultContent.data.adjunto)) {
                            $("#divEvidencia").html('<b>Adjunto:</b><a target="_blank" href="/file-ftp/FORO/' + _resultContent.data.adjunto + '">Descargar Adjunto</a>');
                        } else {
                            $("#divEvidencia").html('');
                        }
                    } catch (ex) {
                        console.log(ex);
                    }
                } else {
                    alertToast(_resultContent.message, 3500);
                }

            });
        }

        function getComment(_id) {
            var _url = "/forum-comment/" + _id + "/view";
            var objApiRest = new AJAXRest(_url, {}, 'GET');
            objApiRest.extractDataAjax(function (_resultContent,status) {
                if (status == 200) {
                    try {
                        self.model = _resultContent.data;
                        self.id = _resultContent.data.id;
                        self.load = true;
                        self.update();
                        initElements();
                        valueSelect('categories', _resultContent.data.foro_categoria_id);
                        if (!$.isEmptyObject(_resultContent.data.adjunto)) {
                            $("#divEvidencia").html('<b>Adjunto:</b><a target="_blank" href="/file-ftp/FORO/' + _resultContent.data.adjunto + '">Descargar Adjunto</a>');
                        } else {
                            $("#divEvidencia").html('');
                        }
                    } catch (ex) {
                        console.log(ex);
                    }
                }else {
                    alertToast(_resultContent.message, 3500);
                }

            });
        }
        function initElements() {
            $('input[type=file]').fileinput({
                showUpload: false,
                showPreview: false,
                browseLabel: "Buscar",
                removeLabel: "Quitar",
                allowedFileExtensions: ['jpg', 'jpeg', 'png', 'bmp', 'pdf'],
                maxFileSize: 10240
            });
            $(".select2").select2({
                language: "es",
                width: '100%'
            });
        }
    </script>


</comment-form>