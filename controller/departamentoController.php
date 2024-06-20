<?php
require_once("../config/conexion.php");
require_once("../models/Departamento.php");

$departamento = new Departamento();

switch ($_GET["op"]) {

    case "listar":
        $datos = $departamento->get_departamento();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["name_dep"];
            $sub_array[] = '<button type="button" onClick="editar(' . $row["id_dep"] . ');"  id="' . $row["id_dep"] . '" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["id_dep"] . ');"  id="' . $row["id_dep"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
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
        $datos = $departamento->get_departamento_x_id($_POST["id_dep"]);
        if (empty($_POST["id_dep"])) {
            if (is_array($datos) == true and count($datos) == 0) {
                $departamento->insert_departamento($_POST["id_dep)"], $_POST["name_dep"]);
            }
        } else {
            $departamento->update_departamento($_POST["id_dep"], $_POST["name_dep"]);
        }
        break;

    case "mostrar":
        $datos = $departamento->get_departamento_x_id($_POST["id_dep"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["id_dep"] = $row["id_dep"];
                $output["name_dep"] = $row["name_dep"];
            }
            echo json_encode($output);
        }
        break;


    case "eliminar":
        $departamento->delete_departamento($_POST["id_dep"]);
        break;


}
?>