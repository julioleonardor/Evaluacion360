<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "360eva";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

$stmt = mysqli_prepare($conn, "INSERT INTO eva_resp (id_com, id_preg) VALUES (?, ?)");
foreach ($_POST['id_com'] as $pregunta => $respuesta) {
  mysqli_stmt_bind_param($stmt, "ss", $pregunta, $respuesta);
  mysqli_stmt_execute($stmt);
}

mysqli_stmt_close($stmt);

mysqli_close($conn);







?>
