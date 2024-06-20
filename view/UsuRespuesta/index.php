<?php

require_once("../../config/conexion.php");
if ($_SESSION["id_roles"] == 2) {

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("../html/MainHead.php"); ?>
    <title> :: Evaluacion 360 :: </title>
</head>

<body>
    <?php require_once("../html/MainMenu.php"); ?>
    <?php require_once("../html/MainHeader.php"); ?>


    <div class="br-mainpanel">
        <div class="br-pageheader pd-y-15 pd-l-20">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="../UsuEva/index.php">Competencias</a>
            </nav>
        </div>
        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
            <h4 class="tx-gray-800 mg-b-5" id="name_com"> </h4>
            <p class="mg-b-0">Preguntas por Competencia</p>
        </div>

        <div class="br-pagebody">
            <div class="col-md-9">
                <div class="card card-outline card-info">
                    <div class="card-header">
                    <h6 class="card-title tx-uppercase tx-12">Hola: <?php echo $_SESSION['name_user'] ?>. </br>Evalua a tus compañeros en las siguientes preguntas: </h6>
                    <div class="card-tools">
                        <button type="submit" form="respuesta_form" name="btnenviar" class="btn btn-outline-primary btn-block mg-b-10">Enviar Evaluacion</button>                       
					</div>
                    </div>
                    <div class="card card-body">
                        <fieldset class="form-group">
                            <legend class="w-auto">Leyenda</legend>
                            <p>10 = Siempre, 8 = Casi siempre, 6 = Normalmente, 4 = A veces, 2 = Exporadicamente, 0 = Nunca</p>
                            <p>10 = Siempre, 9 = Muy a menudo, 8 = Casi siempre, 7 = Con frecuencia, 6 = Normalmente, 5 = Algunas veces, 4 = A veces, 3 = Ocasionalmente, 2 = Esporádicamente, 1 = Muy raramente, 0 = Nunca</p>
                        </fieldset>
                        <form action="model.php" method="POST" id="respuesta_form">
                            <?php $id_com = $_GET["id_com"] ?>
                            <input type="hidden" name="id_com" value="<?php echo $_GET["id_com"] ?>">
                            <input type="hidden" name="id_userx" value="<?php echo $_SESSION["id_user"] ?>">

                            <div class="clear-fix mt-2"></div>

                            <?php $q_arr = array();
                            $pregunta = $conn->query("SELECT * FROM preguntas WHERE id_preg IN (SELECT id_preg FROM lista_preg WHERE id_com = $id_com)");
                            while($crow = mysqli_fetch_array($pregunta)):
                            ?>

                            <table class="table table-striped">
                                <thead>
                                    <tr class="bg-gradient-secondary">
                                        <th class="wd-40p"><b><?php echo $crow['pregunta'] ?><input type="hidden" name="id_preg" value="<?php echo $crow['id_preg'] ?>"></b></th>
                                        <th class="text-center">Evaluacion</th>

                                    </tr>
                                </thead>
                                <tbody class="tr-sortable">
                                    <?php
                                    $id_preg = $crow['id_preg'];
                                    $user = $conn->query("SELECT usuario.id_user,usuario.name_user FROM usuario INNER JOIN lista_preg ON usuario.id_wl=lista_preg.id_wl WHERE usuario.id_dep = {$_SESSION['id_dep']} AND lista_preg.id_preg = $id_preg AND usuario.id_user <> '2' ORDER BY lista_preg.id_preg,lista_preg.id_wl,usuario.id_user");
                                    while ($row = mysqli_fetch_array($user)):
                                    $q_arr[$row['id_user']] = $row;
                                    ?>
                                    <tr class="bg-white">
                                        <td class="p-1" width="20%">
                                            <?php echo $row['name_user'] ?>
                                            <input type="hidden" name="id_user[]" value="<?php echo $row['id_user'] ?>">
                                            <?php $radio_name = $row['id_user'] . '_' . $crow['id_preg'] ?>
                                        </td>

                                        <td class="text-center">
                                            <div class="row">
                                            <div class="col">
                                            <input type="radio" name="opciones[<?php echo $radio_name ?>]" id="ravi" class="radio-button" value="<?php echo $radio_name ?>_0"></br>
                                            <label for="qradio<?php echo $row['name_user'] ?>">0</label>
                                            </div>
                                            <div class="col">
                                            <input type="radio" name="opciones[<?php echo $radio_name ?>]" id="ravi1" class="radio-button" value="<?php echo $radio_name ?>_1"></br>
                                            <label for="qradio<?php echo $row['name_user'] ?>">1</label>
                                            </div>
                                            <div class="col">
                                            <input type="radio" name="opciones[<?php echo $radio_name ?>]" id="ravi" class="radio-button" value="<?php echo $radio_name ?>_2"></br>
                                            <label for="qradio<?php echo $row['name_user'] ?>">2</label>
                                            </div>
                                            <div class="col">
                                            <input type="radio" name="opciones[<?php echo $radio_name ?>]" id="ravi1" class="radio-button" value="<?php echo $radio_name ?>_3"></br>
                                            <label for="qradio<?php echo $row['name_user'] ?>">3</label>
                                            </div>
                                            <div class="col">
                                            <input type="radio" name="opciones[<?php echo $radio_name ?>]" id="ravi" class="radio-button" value="<?php echo $radio_name ?>_4"></br>
                                            <label for="qradio<?php echo $row['name_user'] ?>">4</label>
                                            </div>
                                            <div class="col">
                                            <input type="radio" name="opciones[<?php echo $radio_name ?>]" id="ravi1" class="radio-button" value="<?php echo $radio_name ?>_5"></br>
                                            <label for="qradio<?php echo $row['name_user'] ?>">5</label>
                                            </div>
                                            <div class="col">
                                            <input type="radio" name="opciones[<?php echo $radio_name ?>]" id="ravi1" class="radio-button" value="<?php echo $radio_name ?>_6"></br>
                                            <label for="qradio<?php echo $row['name_user'] ?>">6</label>
                                            </div>
                                            <div class="col">
                                            <input type="radio" name="opciones[<?php echo $radio_name ?>]" id="ravi" class="radio-button" value="<?php echo $radio_name ?>_7"></br>
                                            <label for="qradio<?php echo $row['name_user'] ?>">7</label>
                                            </div>
                                            <div class="col">
                                            <input type="radio" name="opciones[<?php echo $radio_name ?>]" id="ravi1" class="radio-button" value="<?php echo $radio_name ?>_8"></br>
                                            <label for="qradio<?php echo $row['name_user'] ?>">8</label>
                                            </div>
                                            <div class="col">
                                            <input type="radio" name="opciones[<?php echo $radio_name ?>]" id="ravi" class="radio-button" value="<?php echo $radio_name ?>_9"></br>
                                            <label for="qradio<?php echo $row['name_user'] ?>">9</label>
                                            </div>
                                            <div class="col">
                                            <input type="radio" name="opciones[<?php echo $radio_name ?>]" id="ravi1" class="radio-button" value="<?php echo $radio_name ?>_10" checked></br>
                                            <label for="qradio<?php echo $row['name_user'] ?>">10</label>
                                            </div>
                                        </td>

                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                            <?php endwhile; ?>
                        </form>
                    </div>

                </div>

            </div>

        </div>

        <?php require_once("../html/MainJs.php"); ?>
        <script type="text/javascript" src="usurespuesta.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </div>
</body>

</html>

<?php


} else {
    header("Location:".Conectar::ruta()."index.php");
}
?>