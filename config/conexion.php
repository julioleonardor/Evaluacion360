<?php

session_start();
class Conectar
{
    protected $dbh;

    protected function conexion()
    {
        try {
            $conectar = $this->dbh = new PDO("mysql:local=localhost:4430;dbname=360eva", "root", "");
            return $conectar;
        } catch (Exception $e) {
            print "¡Error BD!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");
    }

    public static function ruta()
    {
        return "http://localhost:4430/evaluacion-360/";
    }



}


$conn= new mysqli('127.0.0.1','root','','360eva')or die("Could not connect to mysql".mysqli_error($conn));
?>