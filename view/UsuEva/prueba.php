<?php

require_once("../../config/conexion.php");
    
$id_com = $_POST['id_com'];
$id_userx = $_POST['id_userx'];

$query = "SELECT COUNT(*) FROM respuesta WHERE id_com = $id_com AND id_userx = $id_userx";


$resultado = mysqli_query($conn, $query);

if ($resultado) {
    $fila = mysqli_fetch_row($resultado);
    $num_filas = $fila[0];
    echo $num_filas;
} else {
    echo "Error al ejecutar la consulta";
}

?>