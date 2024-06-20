<?php
require_once("../config/conexion.php");
require_once("../models/Worklevel.php");

$worklevel = new Worklevel();

switch ($_GET["op"]) {

    case "listar":
        $datos = $worklevel->get_worklevel();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["name_wl"];
            $sub_array[] = $row["description_wl"];
            $sub_array[] = '<button type="button" onClick="editar(' . $row["id_wl"] . ');"  id="' . $row["id_wl"] . '" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["id_wl"] . ');"  id="' . $row["id_wl"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
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
        $datos = $worklevel->get_worklevel_x_id($_POST["id_wl"]);
        if (empty($_POST["id_wl"])) {
            if (is_array($datos) == true and count($datos) == 0) {
                $worklevel->insert_worklevel($_POST["id_wl)"], $_POST["name_wl"],$_POST["description_wl"]);
            }
        } else {
            $worklevel->update_worklevel($_POST["id_wl)"], $_POST["name_wl"],$_POST["description_wl"]);
        }
        break;

    case "mostrar":
        $datos = $worklevel->get_worklevel_x_id($_POST["id_wl"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["id_wl"] = $row["id_wl"];
                $output["name_wl"] = $row["name_wl"];
                $output["description_wl"] = $row["description_wl"];
            }
            echo json_encode($output);
        }
        break;


    case "eliminar":
        $worklevel->delete_worklevel($_POST["id_wl"]);
        break;

    case "combo":
        $datos = $worklevel->get_worklevel();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html.= "<option value='".$row["id_wl"]."'>".$row["name_wl"]."</option>";
            }
            echo $html;
        }
        break;

}
?>