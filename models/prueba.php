<?php 
include "../config/conexion.php";
$db->conn();


Class Action {

private $db;

public function __construct(){
include "../config/conexion.php";
$this->db = $conn;

}

    public function save_eva(){
    //for each question
    foreach($_POST['id_user'] as $q){
        if($_POST['id_user'][$q] != NULL){
        //explode $answer array items to get answer id and value
        $answer = explode("_",$_POST['id_preg'][$q]);
        
        $data['id_com'] = $_POST['$id_com'];
        $data['id_preg'] = $_POST['$id_preg'];
        $data['id_user'] = $q;
        $data['id_userx'] = $answer[0];
        $data['evaluated_at'] = date("Y-m-d h:i:s a");

        /* $db->query_insert("eva_resp", $data); */
        unset($data);
    
        }
    }
}



function save_evaluation(){
    extract($_POST);
    $data = " id_userx = {$_SESSION['id_user']} ";
    $data .= ", id_com = $id_com ";
    $save = $this->db->query("INSERT INTO lista set $data");
    if($save){
        $id_com = $this->db->insert_id;
        foreach($id_user as $k => $v){
            $data = " id_user = $id_user ";
            $data .= ", id_preg = $v ";
            $data .= ", rate = {$rate[$v][$k]} ";
            $ins[] = $this->db->query("INSERT INTO lista2 set $data ");
        }
        if(isset($ins))
            return 1;
    }
}

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
            $insert = $this->db->query($query);
        }
        return true;
    }
}



/* foreach($qid as $k => $v){
    $data = " evaluation_id = $eid ";
    $data .= ", question_id = $v ";
    $data .= ", rate = {$rate[$v]} ";
    $ins[] = $this->db->query("INSERT INTO evaluation_answers set $data ");
}
if(isset($ins))
    return 1; */




}