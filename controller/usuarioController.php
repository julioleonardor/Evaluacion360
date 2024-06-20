<?php
require_once("../config/conexion.php");
require_once("../models/Usuario.php");
$usuario = new Usuario();

switch ($_GET["op"]) {    
    case "mostrar":
        $datos = $usuario->get_usuario_x_id($_POST["id_user"]);
        if(is_array($datos)==true and count($datos)<>0){
            foreach($datos as $row){
                $output["id_user"] = $row["id_user"];
                $output["name_user"] = $row["name_user"];
                $output["email_user"] = $row["email_user"];
                $output["codigo_user"] = $row["codigo_user"];
                $output["cargo_user"] = $row["cargo_user"];
                $output["supervisor_user"] = $row["supervisor_user"];
                $output["name_dep"] = $row["name_dep"];
                $output["name_wl"] = $row["name_wl"];
            }
            echo json_encode($output);
        }
        break;

    case "update_perfil":
        $usuario->update_usuario_perfil($_POST["id_user"],$_POST["pass_user"]);
        break;
}


?>
