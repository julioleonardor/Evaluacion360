<?php

class Poll{
    private $dbHost  = '127.0.0.1';
    private $dbUser  = 'root';
    private $dbPwd   = '';
    private $dbName  = '360eva';            
    private $db      = false;
    private $pollTbl = 'pregunta';
    private $optTbl  = 'opcion_preg';
    private $voteTbl = 'respuesta';
    
    public function __construct(){
        if(!$this->db){ 
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUser, $this->dbPwd, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
    
    /*
     * Runs query to the database
     * @param string SQL
     * @param string count, single, all
     */
    private function getQuery($sql,$returnType = ''){
        $data = '';
        $result = $this->db->query($sql);
        if($result){
            switch($returnType){
                case 'count':
                    $data = $result->num_rows;
                    break;
                case 'single':
                    $data = $result->fetch_assoc();
                    break;
                default:
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            $data[] = $row;
                        }
                    }
            }
        }
        return !empty($data)?$data:false;
    }
    
    /*
     * Get polls data
     * Returns single or multiple poll data with respective options
     * @param string single, all
     */
    public function getPolls($pollType = 'single'){
        $pollData = array();
        $sql = "SELECT * FROM ".$this->pollTbl." WHERE est_preg = 'on' ORDER BY id_wl DESC";
        $pollResult = $this->getQuery($sql, $pollType);
        if(!empty($pollResult)){
            if($pollType == 'single'){
                $pollData['eva'] = $pollResult;
                $sql2 = "SELECT * FROM ".$this->optTbl." WHERE id_opc = ".$pollResult['id_opc']." AND est_opc = 'on'";
                $optionResult = $this->getQuery($sql2);
                $pollData['options'] = $optionResult;
            }else{
                $i = 0;
                foreach($pollResult as $prow){
                    $pollData[$i]['eva'] = $prow;
                    $sql2 = "SELECT * FROM ".$this->optTbl." WHERE id_opc = ".$prow['id_opc']." AND est_opc = 'on'";
                    $optionResult = $this->getQuery($sql2);
                    $pollData[$i]['options'] = $optionResult;
                } 
            }
        }
        return !empty($pollData)?$pollData:false;
    }
    
    /*
     * Submit vote
     * @param array of poll option data
     */
    public function vote($data = array()){
        if(!isset($data['id_preg']) || !isset($data['id_opc']) || isset($_COOKIE[$data['id_preg']])) {
            return false;
        }else{
            $sql = "SELECT * FROM ".$this->voteTbl." WHERE id_preg = ".$data['id_preg']." AND id_opc = ".$data['id_opc'];
            $preVote = $this->getQuery($sql, 'count');
            if($preVote > 0){
                $query = "UPDATE ".$this->voteTbl." SET value_opc = 6 WHERE id_preg = ".$data['id_preg']." AND id_opc = ".$data['id_preg'];
                $update = $this->db->query($query);
            }else{
                $query = "INSERT INTO ".$this->voteTbl." (id_eva,id_pre,id_opc,value_opc,date_res,id_user) VALUES (1,".$data['id_preg'].",".$data['id_opc'].",8,'2023-01-26',1)";
                $insert = $this->db->query($query);
            }
            return true;
        }
    }
    
    /*
     * Get poll result
     * @param poll ID
     */
    public function getResult($pollID){
        $resultData = array();
        if(!empty($pollID)){
            $sql = "SELECT p.name_preg, SUM(v.value_opc) as total_votos FROM ".$this->voteTbl." as v LEFT JOIN ".$this->pollTbl." as p ON p.id_preg = v.id_preg WHERE id_preg = ".$pollID;
            $pollResult = $this->getQuery($sql,'single');
            if(!empty($pollResult)){
                $resultData['eva'] = $pollResult['name_preg'];
                $resultData['total'] = $pollResult['value_opc'];
                $sql2 = "SELECT o.id_opc, o.text_opc, v.value_opc 
                FROM ".$this->optTbl." as o 
                LEFT JOIN ".$this->voteTbl." as v ON v.id_opc = o.id_opc WHERE o.id_preg = ".$pollID;
                $optResult = $this->getQuery($sql2);
                if(!empty($optResult)){
                    foreach($optResult as $orow){
                        $resultData['options'][$orow['name']] = $orow['value_opc']; 
                    }
                }
            }
        }
        return !empty($resultData)?$resultData:false;
    }
}