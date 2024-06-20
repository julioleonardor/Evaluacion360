<?php
require_once("../config/conexion.php");
require_once("../models/Evaluacion.php");

$evaluacion = new Evaluacion();

switch ($_GET["op"]) {

    case "listar":
        $datos = $evaluacion->get_evaluacion();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["name_eva"];
            $sub_array[] = $row["description_eva"];
            $sub_array[] = $row["est_eva"];
            $sub_array[] = '<button type="button" onClick="editar(' . $row["id_eva"] . ');"  id="' . $row["id_eva"] . '" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["id_eva"] . ');"  id="' . $row["id_eva"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
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
        $datos = $evaluacion->get_evaluacion_x_id($_POST["id_eva"]);
        if (empty($_POST["id_wl"])) {
            if (is_array($datos) == true and count($datos) == 0) {
                $evaluacion->insert_evaluacion($_POST["name_eva"],$_POST["description_eva"], $_POST["est_eva)"]);
            }
        } else {
            $evaluacion->update_evaluacion($_POST["id_eva"],$_POST["name_eva"],$_POST["description_eva"], $_POST["est_eva)"]);
        }
        break;

    case "mostrar":
        $datos = $evaluacion->get_evaluacion_x_id($_POST["id_eva"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["id_eva"] = $row["id_eva"];
                $output["name_eva"] = $row["name_eva"];
                $output["description_eva"] = $row["description_eva"];
                $output["est_eva"] = $row["est_eva"];
            }
            echo json_encode($output);
        }
        break;


    case "eliminar":
        $worklevel->delete_worklevel($_POST["id_eva"]);
        break;

    case "combo":
        $datos = $evaluacion->get_evaluacion();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html.= "<option value='".$row["id_eva"]."'>".$row["name_eva"]."</option>";
            }
            echo $html;
        }
        break;


}
?>