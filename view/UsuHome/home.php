<?php
require_once("../../config/conexion.php");
// Execute query to get total number of tasks
$result = mysqli_query($conn, "SELECT COUNT(*) as total_tasks FROM competencia");
$row = mysqli_fetch_assoc($result);
$total_tasks = $row['total_tasks'];

// Execute query to get total number of completed tasks
$result = mysqli_query($conn, "SELECT COUNT(*) as completed_tasks FROM respuesta WHERE id_userx = $_SESSION[id_user]");
$row = mysqli_fetch_assoc($result);
$completed_tasks = $row['completed_tasks'];

// Calculate percentage of completed tasks
$percent_complete = ($completed_tasks / $total_tasks) * 100;
$percent_complete = number_format($percent_complete, 2);

// Return result as JSON object
echo json_encode(array('percent_complete' => $percent_complete));

// Close MySQL connection
mysqli_close($conn);
?>