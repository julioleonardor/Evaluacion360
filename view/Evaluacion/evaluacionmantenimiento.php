<div id="evaluacionmantenimiento" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" id="evaluacion_form">
                <div class="modal-header pd-y-20 pd-x-25">
                    <h4 class="modal-title" id="mdltitulo"></h4>
                </div>
                <div class="modal-body pd-25">
                    <input type="hidden" id="id_eva" name="id_eva">
                    <div class="form-group">
                        <label class="form-label" for="name_eva">Nombre</label>
                        <input type="text" class="form-control" id="name_eva" name="name_eva" placeholder="Ingrese Nombre" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="description_eva">Descripcion</label>
                        <textarea class="form-control" id="description_eva" name="description_eva" placeholder="Ingrese la descripcion" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="est_eva">EStado</label>
                        <input type="text" class="form-control" id="est_eva" name="est_eva" placeholder="Ingrese El EStado" required>
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