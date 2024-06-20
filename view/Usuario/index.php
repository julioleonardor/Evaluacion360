<?php
require_once("../../config/conexion.php");
if ($_SESSION["id_roles"] == 1) {
    
    ?>


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
        <a class="breadcrumb-item" href="index.html">Mantenimiento</a>
        <span class="breadcrumb-item active">Usuarios</span>
      </nav>
    </div><!-- br-pageheader -->
    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5">Usuarios</h4>
      <p class="mg-b-0">Desde esta ventana podra dar mantenimiento a los usuarios</p>
    </div>

    <div class="br-pagebody">


    
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

































<?php
} else {
    header("Location:" . Conectar::ruta() . "index.php");
}
?>