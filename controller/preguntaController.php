<?php
    require_once("../config/conexion.php");
    require_once("../models/Pregunta.php");
    $pregunta = new Pregunta();

    switch($_GET["op"]){

        case "listar":
            $datos=$pregunta->get_pregunta();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["pregunta"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["id_preg"].');"  id="'.$row["id_preg"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["id_preg"].');"  id="'.$row["id_preg"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
                $data[]=$sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

            break;

        case "guardaryeditar":
            $datos=$pregunta->get_pregunta_x_id($_POST["id_preg"]);
            if(empty($_POST["id_preg"])){
                if(is_array($datos)==true and count($datos)==0){
                    $pregunta->insert_pregunta($_POST["pregunta"]);
                }
            }else{
                $pregunta->update_pregunta($_POST["id_preg"],$_POST["pregunta"]);
            }
            break;

        case "mostrar":
            $datos=$pregunta->get_pregunta_x_id($_POST["id_preg"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["id_preg"] = $row["id_preg"];
                    $output["pregunta"] = $row["pregunta"];
                }
                echo json_encode($output);
            }
            break;

        case "eliminar":
            $pregunta->delete_pregunta($_POST["id_preg"]);
            break;



/*         case "guardar_respuesta":
            $datos=$pregunta->get_resp_com($_POST["id_com"],$_POST["id_user"]);
            if(is_array($datos)==true){               
                foreach($datos as $row){
                    $output["id_com"] = $row["id_com"];
                    $output["id_preg"] = $row["id_preg"];
                    $output["id_userx"] = $row["id_userx"];
                    $output["id_user"] = $row["id_user"];
                    $output["rate"] = $row["rate{$rate[$v]}"];
                    
                    $pregunta->insertar_respuesta($_POST["id_com"],$_POST["id_preg"],$_POST["id_userx"],$_POST["id_user"],$_POST["rate"]);
                }
                } 
            
            break; */

/*             case "guardar_respuesta2":
                $datos=$pregunta->get_pregunta_x_id($_POST["id_preg"]);
                if(empty($_POST["id_preg"])){
                $datos=$pregunta->insertar_respuesta($_POST["id_com"],$_POST["id_preg"],$_POST["id_userx"],$_POST["id_user"],$_POST["rate"]);
                if(is_array($datos)==true and count($datos)==0){            
                    foreach($datos as $row){
                        $output["id_com"] = $row["id_com"];
                        $output["id_preg"] = $row["id_preg"];
                        $output["id_userx"] = $row["id_userx"];
                        $output["id_user"] = $row["id_user"];
                        $output["rate"] = $row["rate"];
                        
                    }
                    } }
                
                break;

            case "guardar_respuesta3":
                $pregunta->insertar_respuesta($_GET["id_com"],$_POST["id_preg"],$_POST["id_userx"],$_POST["id_user"],$_POST["rate"]);

                
                break;
        
            case "guardaryeditar2":
                $datos=$pregunta->get_pregunta_x_id($_POST["id_preg"]);
                if(empty($_POST["id_preg"])){
                    if(is_array($datos)==true and count($datos)==0){
                        $pregunta->insertar_respuesta($_GET["id_com"],$_GET["id_preg"],$_GET["id_userx"],$_GET["id_user"],$_GET["rate"]);
                    }
                }
                break; */


                
    }
?>
