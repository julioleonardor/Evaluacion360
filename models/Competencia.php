<?php

class Competencia extends Conectar{
    public function get_competencia(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
        *
        FROM 
        competencia";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function get_competencia_x_id($id_com){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM competencia WHERE id_com = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_com);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function delete_competencia($id_com){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="DELETE FROM competencia
            WHERE
                id_com = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_com);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function insert_competencia($id_com,$name_com,$description_com){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="INSERT INTO competencia
            (id_com,name_com, description_com, created_at, updated_at) 
            VALUES
            (?,?,?,now(),NULL);";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_com);
        $sql->bindValue(2,$name_com);
        $sql->bindValue(3,$description_com);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function update_competencia($id_com,$name_com,$description_com){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE competencia
            SET
                name_com=?,
                description_com=?,
                updated_at=now()
            WHERE
                id_com = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$name_com);
        $sql->bindValue(2,$description_com);
        $sql->bindValue(3,$id_com);
        
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function get_competencia_eva($id_com,$id_userx){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM respuesta WHERE id_com = ? AND id_userx = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_com);
        $sql->bindValue(2,$id_userx);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
}

?>