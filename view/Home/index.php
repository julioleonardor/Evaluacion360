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


    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="index.html">Pagina de administración</a>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Administración</h4>
      </div>

      <div class="br-pagebody">

        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-body">
                <a href="../ReporteGeneral/"><img class="card-img-top img-fluid" src="../../docs/img/report.png">
                  <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
                    <h5 class="card-title tx-dark tx-medium mg-b-auto">Reporte General</h5>
                  </div>
                </a>
              </div>
            </div><!-- card -->
          </div><!-- col -->
          <div class="col-md mg-t-20 mg-md-t-0">
            <div class="card bg-teal tx-white bd-0">
              <div class="card-body">
              <a href="../ReporteCompetencia/"><img class="card-img-top img-fluid" src="../../docs/img/competence.png" alt="Image">
                <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
                  <h5 class="card-title tx-white tx-medium mg-b-auto">Reporte por Competencias</h5>
                </div></a>
              </div>
            </div><!-- card -->
          </div><!-- col -->
          <div class="col-md mg-t-20 mg-md-t-0">
            <div class="card bg-dark tx-white bd-0">
              <div class="card-body">
              <a href="../ReportePregunta/"><img class="card-img-top img-fluid" src="../../docs/img/question.png">
                <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
                  <h5 class="card-title tx-white tx-medium mg-b-auto">Reporte por Preguntas</h5>
                </div></a>
              </div>
            </div><!-- card -->
          </div><!-- col -->
        </div><!-- row -->

      </div>

    </div><!-- br-mainpanel -->


    <?php require_once("../html/MainJs.php"); ?>

    <script type="text/javascript" src="home.js"></script>
  </body>

  </html>

<?php
} else {
  header("Location:" . Conectar::ruta() . "index.php");
}
?>