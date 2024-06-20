<?php

class Worklevel extends Conectar{
    public function get_worklevel(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
        worklevel.id_wl,
        worklevel.name_wl,
        worklevel.description_wl
        FROM 
        worklevel";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function get_worklevel_x_id($id_wl){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM worklevel WHERE id_wl = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_wl);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function delete_worklevel($id_wl){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="DELETE FROM worklevel
            WHERE
                id_wl = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_wl);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function insert_worklevel($id_wl,$name_wl,$description_wl){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="INSERT INTO worklevel
            (id_wl,name_wl, description_wl, created_at, updated_at) 
            VALUES
            (?,?,?,now(),NULL);";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_wl);
        $sql->bindValue(2,$name_wl);
        $sql->bindValue(3,$description_wl);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function update_worklevel($id_wl,$name_wl,$description_wl){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE worklevel
            SET
                name_wl=?,
                description_wl=?,
                updated_at=now()
            WHERE
                id_wl = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$name_wl);
        $sql->bindValue(2,$description_wl);
        $sql->bindValue(3,$id_wl);
        
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
}

?>