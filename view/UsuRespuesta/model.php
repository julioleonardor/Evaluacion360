<?php

include '../../config/conexion.php';


    $id_com = $_POST['id_com'];
    $id_userx = $_POST['id_userx'];
    $rate = $_POST['opciones'];
    $decode = implode(", ", $rate);

/*     $query = "INSERT INTO respuesta (id_resp, id_com, id_userx, data_result, evaluated_at) VALUES 
    (NULL, '$id_com', '$id_userx', IFNULL('$decode', '0_0_0'), now())";  */

    $query = "CALL insert_respuesta('$id_com', '$id_userx', '$decode');";
    
    
    $ejecutar = mysqli_query($conn, $query);

    if ($ejecutar) {
        echo '<script>
        alert("Correcto, Evaluacion Completado");
                window.location = "../UsuEva";
        </script>';
    }else{
        echo '<script>
        alert("Error, Inténtalo de nuevo");
        window.location = "../UsuEva";
    </script>';
    } 

?>