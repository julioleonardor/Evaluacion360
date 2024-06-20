<?php 
class Model {
    private $conn;

public function insertData($data) {
        try {
            $query = "INSERT INTO eva_resp (id_res, id_com, id_preg, id_userx, id_user, rate, evaluated_at) VALUES 
            (NULL, id_com, id_preg, id_userx, id_user, rate, now())";
            $stmt = $this->conn->prepare($query);

            while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                $stmt->execute(array(
                    "id_com" => $row["id_com"],
                    "id_preg" => $row["id_preg"],
                    "id_userx" => $row["id_userx"],
                    "id_user" => $row["id_user"],
                    "rate" => $row["rate"]
                ));
            }

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

}

?>