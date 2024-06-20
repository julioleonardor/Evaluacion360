<?php
require_once("../../config/conexion.php");
if ($_SESSION["id_roles"] == 1) {
    
    ?>
    
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php require_once("../html/MainHead.php"); ?> 
    <title>Mantenimiento de Preguntas</title>
  </head>

  <body>

  <?php require_once("../html/AdminMenu.php"); ?>
<?php require_once("../html/MainHeader.php"); ?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="index.html">Mantenimiento</a>
          <span class="breadcrumb-item active">Preguntas</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Preguntas</h4>
        <p class="mg-b-0">Desde esta ventana podra dar mantenimiento a las preguntas</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Mantenimiento de Prreguntas</h6>
            <button id="btnnuevo" class="btn btn-outline-primary btn-block mg-b-10">Nuevo Registro</button>

            <div class="table-wrapper">
              <table id="pregunta_data" class="table display responsive nowrap">
                <thead>
                  <tr>
                    <th class="wd-70p">Pregunta</th>
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

    <?php require_once("preguntamantenimiento.php");?>
    <?php require_once("../html/MainJs.php"); ?>

    <script type="text/javascript" src="pregunta.js"></script>
  </body>
</html>
<?php
} else {
    header("Location:" . Conectar::ruta() . "index.php");
}
?>