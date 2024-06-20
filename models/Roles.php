<?php

class Roles extends Conectar{
    public function get_roles(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
        roles.id_roles,
        roles.name_roles,
        roles.description_roles
        FROM 
        roles";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function get_roles_x_id($id_roles){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM roles WHERE id_roles = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_roles);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function delete_roles($id_roles){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="DELETE FROM roles
            WHERE
                id_roles = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_roles);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function insert_roles($id_roles,$name_roles,$description_roles){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="INSERT INTO roles
            (id_roles,name_roles, description_roles, created_at, updated_at) 
            VALUES
            (?,?,?,now(),NULL);";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_roles);
        $sql->bindValue(2,$name_roles);
        $sql->bindValue(3,$description_roles);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function update_roles($id_roles,$name_roles,$description_roles){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE roles
            SET
                name_roles=?,
                description_roles=?,
                updated_at=now()
            WHERE
                id_roles = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$name_roles);
        $sql->bindValue(2,$description_roles);
        $sql->bindValue(3,$id_roles);
        
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
}

?>