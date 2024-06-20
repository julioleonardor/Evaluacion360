<?php

class Usuario extends Conectar
{
    public function login()
    {
        $conectar = parent::conexion();
        parent::set_names();
        if (isset($_POST["enviar"])) {
            $email = $_POST["email_user"];
            $pass = $_POST["pass_user"];
            if (empty($email) and empty($pass)) {
                header("Location:".Conectar::ruta()."index.php?m2");
                exit();
            } else {
                $sql = "SELECT * FROM usuario WHERE email_user=? AND pass_user=? AND est_user = 1";
                $stmt = $conectar->prepare($sql);
                $stmt->bindValue(1, $email);
                $stmt->bindValue(2, $pass);
                $stmt->execute(); 
                $resultado = $stmt->fetch();
                if (is_array($resultado) and count($resultado)>0) {
                    $_SESSION["id_user"] = $resultado["id_user"];
                    $_SESSION["name_user"] = $resultado["name_user"];
                    $_SESSION["email_user"] = $resultado["email_user"];
                    $_SESSION["codigo_user"] = $resultado["codigo_user"];
                    $_SESSION["cargo_user"] = $resultado["cargo_user"];
                    $_SESSION["id_dep"] = $resultado["id_dep"];
                    $_SESSION["id_roles"] = $resultado["id_roles"];
                    $_SESSION["id_wl"] = $resultado["id_wl"];
                    $_SESSION["supervisor_user"] = $resultado["supervisor_id"];
                    if ($resultado['id_roles'] == 1){
                        header("Location:".Conectar::ruta()."view/Home/");
                        exit();
                    }
                    else {
                        if($resultado['id_roles'] == 2){
                        header("Location:".Conectar::ruta()."view/UsuHome/");
                        exit();
                    }
                    }

                } else {
                    header("Location:".Conectar::ruta()."index.php?m1");
                    exit();
                }
            }
        }
    }

    public function get_usuario_x_id($id_user){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT usuario.id_user, usuario.name_user, usuario.email_user, usuario.codigo_user, usuario.cargo_user, usuario.supervisor_user, 
        departamento.id_dep, departamento.name_dep,
        worklevel.id_wl, worklevel.name_wl
        FROM usuario 
        INNER JOIN departamento ON departamento.id_dep=usuario.id_dep
        INNER JOIN worklevel ON worklevel.id_wl=usuario.id_wl
        WHERE usuario.id_user = ? AND usuario.est_user = 1;";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id_user);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function update_usuario_perfil($id_user,$pass_user){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE usuario 
            SET
                pass_user = ?,
                updated_at = now()
            WHERE
                id_user = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $pass_user);
        $sql->bindValue(2, $id_user);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }   
}
?>