<div id="preguntamantenimiento" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" id="pregunta_form">
                <div class="modal-header pd-y-20 pd-x-25">
                    <h4 class="modal-title" id="mdltitulo"></h4>
                </div>
                <div class="modal-body pd-25">
                    <input type="hidden" id="id_preg" name="id_preg">

                    <div class="form-group">
                        <label class="form-label" for="format_preg">Competencias</label>
                        <select class="form-control select2" id="format_preg" name="format_preg" data-placeholder="Seleccione" style="width: 100%">
 
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="pregunta">Pregunta</label>
                        <input type="text" class="form-control" id="pregunta" name="pregunta" placeholder="Ingrese Pregunta" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" id="#" value="add" class="btn btn-rounded btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>