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
                    <a class="breadcrumb-item" href="#">Evaluacion</a>
                </nav>
            </div>
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">Evaluacion</h4>
                <p class="mg-b-0">Pantalla Evaluacion</p>
            </div>

            <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Evaluacion de Competencia</h6>

            <div class="table-wrapper">
              <table id="usueva_data" class="table display responsive nowrap">
                <thead>
                  <tr>
                    <th class="wd-80p">Competencia</th>
                    <th class="wd-20p"></th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
        </div>
      </div>

        </div>
        <?php require_once("../html/MainJs.php"); ?>
        <script type="text/javascript" src="usueva.js"></script>
        
    </body>

    </html>
    <?php
} else {
    header("Location:" . Conectar::ruta() . "index.php");
}
?>