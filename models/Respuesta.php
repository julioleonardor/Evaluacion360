<?php
class Respuesta extends Conectar
{
    function __construct()
    {
    }

    public function get_eva($id_eva)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT evaluacion.id_eva, 
        evaluacion.name_eva, 
        evaluacion.description_eva, 
        evaluacion.code_eva, 
        evaluacion.est_eva, 
        pregunta.id_preg,
        pregunta.pregunta,
        pregunta.id_com, 
        pregunta.id_wl, 
        pregunta.est_preg,
        opcion_preg.id_opc, 
        opcion_preg.text_opc, 
        opcion_preg.value_opc, 
        opcion_preg.est_opc
        FROM evaluacion
        INNER JOIN pregunta ON evaluacion.id_eva=pregunta.id_eva
        INNER JOIN opcion_preg ON pregunta.id_preg=opcion_preg.id_preg
        WHERE ;";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function get_eva_x_id($id_eva){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM evaluacion WHERE id_eva = ? AND est_eva='open'";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_eva);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function get_eva_complete($id_dep,$id_com){
        $conectar= parent::conexion();
        parent::set_names();
        $sql = "SELECT 
        pregunta.id_preg,
        pregunta.id_eva,
        pregunta.id_com,
        pregunta.id_wl,
        pregunta.format_preg,
        pregunta.pregunta,
        pregunta.est_preg,
        evaluacion.id_eva,
        evaluacion.name_eva, 
        competencia.id_com,
        competencia.name_com,
        worklevel.id_wl,
        worklevel.name_wl,
        usuario.id_user,
        usuario.name_user,
        departamento.id_dep,
        departamento.name_dep
        FROM pregunta
        INNER JOIN evaluacion ON pregunta.id_eva=evaluacion.id_eva
        INNER JOIN competencia ON pregunta.id_com=competencia.id_com
        INNER JOIN worklevel ON pregunta.id_wl=worklevel.id_wl
        INNER JOIN usuario ON worklevel.id_wl=usuario.id_wl
        INNER JOIN departamento ON usuario.id_dep=departamento.id_dep
        WHERE departamento.id_dep = ? AND competencia.id_com = ?;";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id_dep);
        $sql->bindValue(2, $id_com);
        $sql->execute();
        return $resultado=$sql->fetchAll();

    }




    public function get_resp_x_user(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql = "";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
    

}

?>