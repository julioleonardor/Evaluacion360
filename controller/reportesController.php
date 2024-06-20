<?php
    require_once("../config/conexion.php");
    require_once("../models/Reportes.php");
    $reportes = new Reportes();

    switch($_GET["op"]){
        
        case "listarGeneral":
            $datos=$reportes->get_reporte_general();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["codigo_user"];
                $sub_array[] = $row["Evaluado"];
                $sub_array[] = $row["name_dep"];
                $sub_array[] = $row["Promedio"];
                $sub_array[] = $row["Total"];
                $data[]=$sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

            break;

        case "listarCompetencia":
            $datos=$reportes->get_reporte_competencia();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["codigo_user"];
                $sub_array[] = $row["Evaluado"];
                $sub_array[] = $row["Competencia"];
                $sub_array[] = $row["Total"];
                $data[]=$sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

            break;


            case "listarPregunta":
                $datos=$reportes->get_reporte_pregunta();
                $data= Array();
                foreach($datos as $row){
                    $sub_array = array();
                    $sub_array[] = $row["codigo_user"];
                    $sub_array[] = $row["Evaluado"];
                    $sub_array[] = $row["Competencia"];
                    $sub_array[] = $row["Pregunta"];
                    $sub_array[] = $row["Evaluador"];
                    $sub_array[] = $row["Puntuacion"]; 
                    $data[]=$sub_array;
                }
    
                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);
    
                break;

        
            




        
    }