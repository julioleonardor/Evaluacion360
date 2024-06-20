<?php
require_once("../config/conexion.php");
require_once("../models/Competencia.php");

$competencia = new competencia();

switch ($_GET["op"]) {

    case "listar":
        $datos = $competencia->get_competencia();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["name_com"];
            $sub_array[] = $row["description_com"];
            $sub_array[] = '<button type="button" onClick="editar(' . $row["id_com"] . ');"  id="' . $row["id_com"] . '" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["id_com"] . ');"  id="' . $row["id_com"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
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
        $datos = $competencia->get_competencia_x_id($_POST["id_com"]);
        if (empty($_POST["id_com"])) {
            if (is_array($datos) == true and count($datos) == 0) {
                $competencia->insert_competencia($_POST["id_com)"], $_POST["name_com"], $_POST["description_com"]);
            }
        } else {
            $competencia->update_competencia($_POST["id_com)"], $_POST["name_com"], $_POST["description_com"]);
        }
        break;

    case "mostrar":
        $datos = $competencia->get_competencia_x_id($_POST["id_com"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["id_com"] = $row["id_com"];
                $output["name_com"] = $row["name_com"];
                $output["description_com"] = $row["description_com"];
            }
            echo json_encode($output);
        }
        break;


    case "eliminar":
        $competencia->delete_competencia($_POST["id_com"]);
        break;


    case "combo":
        $datos = $competencia->get_competencia();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html.= "<option value='".$row["id_com"]."'>".$row["name_com"]."</option>";
            }
            echo $html;
        }
        break; 

    case "competencia_evaluar":
        $datos = $competencia->get_competencia();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["name_com"];
            $sub_array[] = '<button type="button" onClick="evaluar('.$row["id_com"].');"  id="'.$row["id_com"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
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


}
?>