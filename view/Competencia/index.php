<?php
require_once("../../config/conexion.php");
if ($_SESSION["id_roles"] == 1) {
    
    ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once("../html/MainHead.php"); ?> 
  <title>Mantenimiento de Competencias</title>
</head>

<body>

<?php require_once("../html/AdminMenu.php"); ?>
<?php require_once("../html/MainHeader.php"); ?>

  <!-- ########## START: MAIN PANEL ########## -->
  <div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Mantenimiento</a>
        <span class="breadcrumb-item active">Competencias</span>
      </nav>
    </div><!-- br-pageheader -->
    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5">Competencias</h4>
      <p class="mg-b-0">Desde esta ventana podra dar mantenimiento a las competencias</p>
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Mantenimiento de competencias</h6>
        <button id="btnnuevo" class="btn btn-outline-primary btn-block mg-b-10">Nuevo Registro</button>

        <div class="table-wrapper">
          <table id="competencia_data" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-30p">Nombre</th>
                <th class="wd-40p">Descripcion</th>
                <th class="wd-10p"></th>
                <th class="wd-10p"></th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div><!-- br-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->

  <?php require_once("competenciamantenimiento.php"); ?>
  <?php require_once("../html/MainJs.php"); ?>

  <script type="text/javascript" src="competencia.js"></script>
</body>

</html>

<?php
} else {
    header("Location:" . Conectar::ruta() . "index.php");
}
?>