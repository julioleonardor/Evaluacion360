<?php

class Departamento extends Conectar{
    public function get_departamento(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
        departamento.id_dep,
        departamento.name_dep
        FROM 
        departamento
        ORDER BY 
        id_dep";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function get_departamento_x_id($id_dep){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM departamento WHERE id_dep = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_dep);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function delete_departamento($id_dep){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="DELETE FROM departamento
            WHERE
                id_dep = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_dep);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function insert_departamento($id_dep,$name_dep){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="INSERT INTO departamento
            (id_dep,name_dep, created_at, updated_at) 
            VALUES
            (?,?,now(),NULL);";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_dep);
        $sql->bindValue(2,$name_dep);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function update_departamento($id_dep,$name_dep){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE departamento
            SET
                name_dep=?,
                updated_at=now()
            WHERE
                id_dep = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$name_dep);
        $sql->bindValue(2,$id_dep);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
}

?>