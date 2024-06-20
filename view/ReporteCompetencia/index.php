<?php
require_once("../../config/conexion.php");
if ($_SESSION["id_roles"] == 1) {    


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("../html/MainHead.php");?>
    <title>Reportes Por Competencias</title>
</head>

<body>
    <?php require_once("../html/AdminMenu.php");?>
    <?php require_once("../html/MainHeader.php");?>

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


        <div class="br-section-wrapper">
            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Mantenimiento de Reportes</h6>

            <div class="table-wrapper">
              <table id="reportes_data" class="table display responsive nowrap">
                <thead>
                  <tr>
                    <th class="wd-5p">Codigo</th>
                    <th class="wd-35p">Evaluado</th>
                    <th class="wd-35p">Competencia</th>
                    <th class="wd-10p">Promedio</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
        </div>



        </div>
        <?php require_once("../html/MainJs.php");?>
        <script type="text/javascript" src="reportecompetencia.js"></script>
</body>

</html>
<?php
} else {
    header("Location:" . Conectar::ruta() . "index.php");
}
?>