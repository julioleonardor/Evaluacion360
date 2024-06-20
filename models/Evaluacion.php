<?php
class Evaluacion extends Conectar
{
    public function get_evaluacion()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT *
            FROM
            evaluacion";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_evaluacion_x_id($id_eva)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM evaluacion WHERE id_eva = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_eva);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function delete_evaluacion($id_eva)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE evaluacion
                WHERE
                    id_eva = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_eva);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function insert_evaluacion($name_eva, $description_eva, $est_eva)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO evaluacion
                (id_eva,name_eva,description_eva,created_at,update_at,est_eva) 
                VALUES
                (NULL,?,?,now(),NULL,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $name_eva);
        $sql->bindValue(2, $description_eva);
        $sql->bindValue(3, $est_eva);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_evaluacion($id_eva, $name_eva, $description_eva, $est_eva)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE evaluacion
                SET
                    name_eva=?,
                    description_eva=?,   
                    updated_at=now(),
                    est_eva=?
                WHERE
                    id_eva = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $name_eva);
        $sql->bindValue(2, $description_eva);
        $sql->bindValue(3, $est_eva);
        $sql->bindValue(4, $id_eva);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

     public function get_eva_usu($id_user)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT evaluacion.id_eva, 
        evaluacion.name_eva, 
        evaluacion.description_eva, 
        evaluacion.est_eva, 
        pregunta.id_preg, 
        pregunta.pregunta,
        pregunta.id_com, 
        pregunta.id_wl, 
        pregunta.est_preg,
        opcion_preg.id_opc, 
        opcion_preg.text_opc, 
        opcion_preg.value_opc, 
        opcion_preg.est_opc,
        worklevel.name_wl, 
        competencia.name_com, 
        usuario.name_user
        FROM evaluacion
        INNER JOIN pregunta ON evaluacion.id_eva=pregunta.id_eva
        INNER JOIN opcion_preg ON pregunta.id_preg=opcion_preg.id_preg
        INNER JOIN worklevel ON pregunta.id_wl=worklevel.id_wl
        INNER JOIN competencia ON pregunta.id_com=competencia.id_com
        INNER JOIN usuario ON worklevel.id_wl=usuario.id_wl
        WHERE usuario.id_user=? AND evaluacion.est_eva='iniciada'";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_user);
        $sql->execute();
        return $resultado = $sql->fetchAll();

    } 
}
?>