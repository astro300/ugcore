@if(!empty($errors))
    @if(count($errors->all())>0)
        <div class="modal fade" id="modalerrors" tabindex="-1" role="dialog" style="display: none;">
            <div class="modal-dialog  type-danger" role="document">
                <div class="modal-content">
                    <div class="modal-header headerError">
                        <h4 class="modal-title" id="largeModalLabel">
                            <i class="fa fa-cog fa-spin fa-fw"></i>Errores de Validaci&oacute;n</h4>
                    </div>
                    <div class="modal-body">
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li class="text-danger boldText">{{ $message}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif


