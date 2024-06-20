<?php
require_once("config/conexion.php");
if (isset($_POST["enviar"]) and $_POST["enviar"] == "si") {
  require_once("models/Usuario.php");
  $usuario = new Usuario();
  $usuario->login();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Twitter -->
  <meta name="twitter:site" content="@themepixels">
  <meta name="twitter:creator" content="@themepixels">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Bracket">
  <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
  <meta name="twitter:image" content="http://themepixels.me/bracket/img/bracket-social.png">

  <!-- Facebook -->
  <meta property="og:url" content="http://themepixels.me/bracket">
  <meta property="og:title" content="Bracket">
  <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

  <meta property="og:image" content="http://themepixels.me/bracket/img/bracket-social.png">
  <meta property="og:image:secure_url" content="http://themepixels.me/bracket/img/bracket-social.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="600">

  <!-- Meta -->
  <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
  <meta name="author" content="ThemePixels">

  <title>EVA::Evaluacion 360</title>

  <!-- vendor css -->
  <link href="public/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="public/lib/Ionicons/css/ionicons.css" rel="stylesheet">

  <!-- Bracket CSS -->
  <link rel="stylesheet" href="public/css/bracket.css">
</head>

<body>

  <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">
    <form action="" method="post">
      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">

        <?php
        if (isset($_GET["m"])) {
          switch ($_GET["m"]) {
            case "1";
              ?>
              <div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <strong class="d-block d-sm-inline-block-force">Error!</strong> Datos Incorrectos
              </div>

              <?php
            break;

            case "2";
              ?>
              <div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <strong class="d-block d-sm-inline-block-force">Error!</strong> Campos Vacios
              </div>
              <?php
            break;
          }
        }

        ?>


        <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal">[</span> Evalucion 360 <span
            class="tx-normal">]</span></div>
        <div class="tx-center mg-b-30">Acceso Evaluacion 360</div>

        <div class="form-group">
          <input type="text" id="email_user" name="email_user" class="form-control"
            placeholder="Ingrese Correo Electronico">
        </div>
        <div class="form-group">
          <input type="password" id="pass_user" name="pass_user" class="form-control" placeholder="Ingrese Contraseña">
        </div>

        <input type="hidden" name="enviar" class="form-control" value="si">
        <button type="submit" class="btn btn-info btn-block">Entrar</button><br>

        <!-- <div class="mg-t-60 tx-center">Restablecer contraseña: <a href="modaluser.php" class="tx-info">Click Aquí</a></div> -->
        <button type="button" id="recuperar"class="btn btn-warning btn-block" data-toggle="modal" data-target="modaluser.php">Restablecer Contraseña</button>
      </div>
    </form>
  </div>




  <?php require_once("modaluser.php"); ?>
  <script src="public/lib/jquery/jquery.js"></script>
  <script src="public/lib/popper.js/popper.js"></script>
  <script src="public/lib/bootstrap/bootstrap.js"></script>

  <script>
$(document).on("click","#recuperar", function(){
    $('#mdltitulo').html('Recuperar Contraseña');
    $('#modaluser').modal('show');
});

  </script>

  
</body>

</html>