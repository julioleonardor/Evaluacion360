<?php
require_once("../../config/conexion.php");
if ($_SESSION["id_roles"] == 2) {
    
    ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("../html/MainHead.php"); ?>
    <title>Perfil</title>
</head>

<body>
    <?php require_once("../html/MainMenu.php"); ?>
    <?php require_once("../html/MainHeader.php"); ?>

    <div class="br-mainpanel">
        <div class="br-pageheader pd-y-15 pd-l-20">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="#">Perfil</a>
            </nav>
        </div>
        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
            <h4 class="tx-gray-800 mg-b-5">Perfil</h4>
            <p class="mg-b-0">Pantalla Perfil</p>
        </div>

        <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Perfil</h6>
          <p class="mg-b-30 tx-gray-600">Actualize sus datos</p>

          <form method="post" id="usuperfil_form">
          <div class="form-layout form-layout-1">
            <div class="row mg-b-25">
            <div class="col-lg-2">
                <div class="form-group">
                  <label class="form-control-label">Codigo: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="codigo_user" id="codigo_user" readonly>
                </div>
              </div>
              <div class="col-lg-10">
                <div class="form-group">
                  <label class="form-control-label">Nombre: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="name_user" id="name_user" placeholder="Nombre" readonly>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Correo Electronico: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="email_user" id="email_user" readonly>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Contraseña: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="password" name="pass_user" id="pass_user" placeholder="Ingrese Contraseña">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Departamento: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="name_dep" id="name_dep" readonly>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Cargo: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="cargo_user" id="cargo_user" readonly>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Worklevel: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="name_wl" id="name_wl" readonly>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Supervisor: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="supervisor_user" id="supervisor_user" readonly>
                </div>
              </div>

            </div>

            <div class="form-layout-footer">
              <button class="btn btn-info" id="btnactualizar">Actualizar</button>
            </div>
          </div>
          </form>




        </div>

    </div>

    <?php require_once("../html/MainJs.php"); ?>
    <script type="text/javascript" src="usuperfil.js"></script>
</body>

</html>
<?php
} else {
    header("Location:" . Conectar::ruta() . "index.php");
}
?>