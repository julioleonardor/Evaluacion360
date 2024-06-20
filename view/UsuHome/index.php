<?php
require_once("../../config/conexion.php");
if ($_SESSION["id_roles"] == 2) {
    
    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php require_once("../html/MainHead.php"); ?>
        <title>Home</title>
    </head>

    <body>
        <?php require_once("../html/MainMenu.php"); ?>
        <?php require_once("../html/MainHeader.php"); ?>

        <div class="br-mainpanel">
            <div class="br-pageheader pd-y-15 pd-l-20">
                <nav class="breadcrumb pd-0 mg-0 tx-12">
                    <a class="breadcrumb-item" href="#">Home</a>
                </nav>
            </div>
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">Evaluacion 360</h4>
                <p class="mg-b-0">Pantalla Home</p>
            </div>

            <div class="br-pagebody">

            <!-- Desarrollo para el dashboard de la vista usuarios -->

  <!--           <div style="width: 300px; border: 1px solid #ccc;">
    <div id="progress-bar"  class="progress-bar bg-success wd-10p" ></div>
  </div> -->


            
        <div class="row row-sm mg-t-20">
          <div class="col-lg-6">
            <div class="card shadow-base card-body pd-25 bd-0">
              <div class="row">
                <div class="col-sm-12">
                  <h6 class="card-title tx-uppercase tx-12">Estadisticas</h6>
                  <h4 class="tx-gray-800 mg-b-5" id="total_porcentaje" > </h4>
                  <!-- <p class="display-4 tx-medium tx-inverse mg-b-5 tx-lato"> </p> -->
                  <div class="progress mg-b-10">
                    <div id="progress-bar" class="progress-bar bg-primary progress-bar-xs" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="tx-12">Porcentaje de competencias evaluadas, favor realizar las que faltan</p>
                </div>
              </div>
            </div>
          </div>
        </div>



        </div>
        <?php require_once("../html/MainJs.php"); ?>
        <script type="text/javascript" src="usuhome.js"></script>
    </body>

    </html>
    <?php
} else {
    header("Location:" . Conectar::ruta() . "index.php");
}
?>