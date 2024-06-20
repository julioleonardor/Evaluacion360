<?php
require_once("../config/conexion.php");
require_once("../models/Roles.php");

$roles = new Roles();

switch ($_GET["op"]) {

    case "listar":
        $datos = $roles->get_roles();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["name_roles"];
            $sub_array[] = $row["description_roles"];
            $sub_array[] = '<button type="button" onClick="editar(' . $row["id_roles"] . ');"  id="' . $row["id_roles"] . '" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["id_roles"] . ');"  id="' . $row["id_roles"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);

        break;

    case "guardaryeditar":
        $datos = $roles->get_roles_x_id($_POST["id_roles"]);
        if (empty($_POST["id_roles"])) {
            if (is_array($datos) == true and count($datos) == 0) {
                $roles->insert_roles($_POST["id_roles)"], $_POST["name_roles"],$_POST["description_roles"]);
            }
        } else {
            $roles->update_roles($_POST["id_roles)"], $_POST["name_roles"],$_POST["description_roles"]);
        }
        break;

    case "mostrar":
        $datos = $roles->get_roles_x_id($_POST["id_roles"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["id_roles"] = $row["id_roles"];
                $output["name_roles"] = $row["name_roles"];
                $output["description_roles"] = $row["description_roles"];
            }
            echo json_encode($output);
        }
        break;


    case "eliminar":
        $roles->delete_roles($_POST["id_roles"]);
        break;

}
?>