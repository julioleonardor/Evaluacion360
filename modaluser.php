<!-- 
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="caja_popup" id="modaluser">
                <form action="recuperar.php" class="contenedor_popup" method="POST">
                    <table>
                        <tr>
                            <th colspan="2">Recuperar contraseña</th>
                        </tr>
                        <tr>
                            <td><b>Correo</b></td>
                            <td><input type="text" name="email_user2" required class="cajaentradatexto"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="button" onclick="cancelarform()">Cancelar</button>
                                <input type="submit" name="btnrecuperar" value="Enviar" onClick="javascript: return confirm('¿Deseas enviar tu contraseña a tu correo?');">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
 -->


<div id="modaluser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" id="pass_form">
                <div class="modal-header pd-y-20 pd-x-25">
                    <h4 class="modal-title" id="mdltitulo"></h4>
                </div>
                <div class="modal-body pd-25">

                <div class="form-group">
                    <label class="form-label" for="email_user">Correo Electronico</label>
                    <input type="text" class="form-control" id="email_user2" name="email_user2" placeholder="Ingrese Correo" required>
                </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="btnrecuperar" value="Enviar" class="btn btn-rounded btn-primary" onClick="javascript: return confirm('¿Deseas enviar tu contraseña a tu correo?');">
                </div>
            </form>
        </div>
    </div>
</div>