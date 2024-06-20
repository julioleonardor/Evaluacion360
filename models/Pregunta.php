<?php
    class Pregunta extends Conectar{
        public function get_pregunta(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
            preguntas.id_preg,
            preguntas.pregunta
            FROM
            preguntas";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_pregunta_x_id($id_preg){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM preguntas WHERE id_preg = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id_preg);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_pregunta($id_preg){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="DELETE preguntas
                WHERE
                    id_preg = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id_preg);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_pregunta($pregunta){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO preguntas
                (id_preg, pregunta) 
                VALUES
                (NULL,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$pregunta);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_pregunta($id_preg,$pregunta){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE preguntas
                SET
                    pregunta=?    
                WHERE
                    id_preg = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$pregunta);
            $sql->bindValue(2,$id_preg);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insertar_respuesta($id_com, $id_preg, $id_userx, $id_user, $rate){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO eva_resp 
            (id_resp, id_com, id_preg, id_userx, id_user, rate, evaluated_at) VALUES 
            (NULL, ?, ?, ?, ?, ?, now())";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_com);
            $sql->bindValue(2, $id_preg);
            $sql->bindValue(3, $id_userx);
            $sql->bindValue(4, $id_user);
            $sql->bindValue(5, $rate);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


        //validacion de respuesta por competencia
        public function get_resp_com($id_com,$id_user){
            $conectar=parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM eva_resp where id_com = ? and id_user = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_com);
            $sql->bindValue(2, $id_user);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function save_eva(){
            extract($_POST);
            foreach($_POST['id_preg'] as $q){
                if($_POST['pregunta'][$q] != NULL){
                //explode $answer array items to get answer id and value
                $answer = explode("_",$_POST['pregunta'][$q]);
                
                $data['id_com'] = $_POST['$id_com'];
                $data['id_preg'] = $q;
                $data['id_user'] = $_POST['$id_user'];
                $data['id_user'] = $answer[0];
                $data['a_date'] = date("Y-m-d h:i:s a");
                
                $db->query_insert("eva_resp", $data);
                unset($data);
                }
            }
        }
/* 
        public function insertData2($data) {
            $conectar=parent::conexion();
            parent::set_names();
            $stmt = "(id_res, id_com, id_preg, id_userx, id_user, rate, evaluated_at) VALUES 
            (NULL, ?, ?, ?, ?, ?, now())";
            $stmt->$conectar->prepare($stmt);

            $stmt->execute($data);
            return $stmt->rowCount();
        } */

        public function insertData($data) {
            $stmt = $this->dbh->prepare("(id_res, id_com, id_preg, id_userx, id_user, rate, evaluated_at) VALUES 
            (NULL, ?, ?, ?, ?, ?, now())");
            $stmt->execute($data);
            return $stmt->rowCount();
        }

        
            

            
/* 
    public function get_preg_x_com($id_com,$id_dep){
        $conectar = parent::Conexion();
        parent::set_names();
        $sql = "
        SELECT 
        pregunta.id_preg,
        pregunta.pregunta,
        worklevel.id_wl,
        worklevel.name_wl,
        competencia.id_com,
        competencia.name_com,
        evaluacion.id_eva,
        evaluacion.name_eva,
        usuario.id_user,
        usuario.name_user,
        departamento.id_dep,
        departamento.name_dep
        FROM lista_preg
        INNER JOIN pregunta ON lista_preg.id_preg = pregunta.id_preg
        INNER JOIN worklevel ON lista_preg.id_wl = worklevel.id_wl
        INNER JOIN competencia ON lista_preg.id_com = competencia.id_com
        INNER JOIN evaluacion ON lista_preg.id_eva = evaluacion.id_eva
        INNER JOIN usuario ON worklevel.id_wl = usuario.id_wl
        INNER JOIN departamento ON usuario.id_dep = departamento.id_dep
        WHERE competencia.id_com = ? AND usuario.id_dep = ?
        ORDER BY competencia.id_com,pregunta.id_preg,worklevel.id_wl,usuario.id_user;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_com);
        $sql->bindValue(2, $id_dep);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


    function preg_com($id_com){
        $conectar = parent::Conexion();
        parent::set_names();
        $sql = "SELECT * FROM pregunta WHERE id_preg IN (SELECT id_preg FROM lista_preg WHERE id_com = ?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_com);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    function user_preg($id_com,$id_dep){
        $conectar = parent::Conexion();
        parent::set_names();
        $sql = "SELECT usuario.name_user, lista_preg.id_wl, pregunta.pregunta
        FROM usuario
        INNER JOIN lista_preg ON usuario.id_wl=lista_preg.id_wl
        INNER JOIN pregunta ON lista_preg.id_preg=pregunta.id_preg
        WHERE lista_preg.id_com = ? AND usuario.id_dep = ?
        ORDER BY lista_preg.id_preg,lista_preg.id_wl,usuario.id_user";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_com);
        $sql->bindValue(2, $id_dep);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    } */


public function vote($data = array()){
    if(!isset($data['poll_id']) || !isset($data['poll_option_id']) || isset($_COOKIE[$data['poll_id']])) {
        return false;
    }else{
        $sql = "SELECT * FROM eva_resp WHERE id_user = $_POST[id_userx] AND id_preg = $_POST[id_preg]"; 
        $preVote = $this->$data($sql, 'count');
        if($preVote = 0){
            $query = "INSERT INTO eva_resp 
            (id_res, id_com, id_preg, id_userx, id_user, rate, evaluated_at) VALUES 
            (NULL, ?, ?, ?, ?, ?, now())";
        }
        return true;
    }
}
    }


?>