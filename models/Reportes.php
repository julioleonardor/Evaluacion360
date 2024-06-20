<?php

class Reportes extends Conectar{


    public function get_reporte_competencia(){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
        usuario.codigo_user,
        usuario.id_user,
        usuario.name_user AS Evaluado,
        COUNT(DISTINCT lista_preg.id_preg) AS TotalPreg,
        usuario.id_wl AS Worklevel, 
        COUNT(DISTINCT data_result2.id_userx) AS TotalEvaluadores,
        competencia.id_com, 
        competencia.name_com AS Competencia, 
        (COUNT(DISTINCT lista_preg.id_preg)*10) AS Meta,
        FORMAT(SUM(rate) / COUNT(DISTINCT lista_preg.id_preg),0) AS Totas,
        FORMAT((SUM(rate) / COUNT(DISTINCT lista_preg.id_preg)) / COUNT(DISTINCT data_result2.id_userx),0) AS Promedio, 
        FORMAT((((SUM(rate) / COUNT(DISTINCT lista_preg.id_preg)) / COUNT(DISTINCT data_result2.id_userx) * 10)) / COUNT(DISTINCT lista_preg.id_preg),0) AS Total 
    FROM 
        usuario 
        INNER JOIN data_result2 ON data_result2.id_user = usuario.id_user 
        INNER JOIN competencia ON competencia.id_com = data_result2.id_com 
        INNER JOIN lista_preg ON lista_preg.id_wl = usuario.id_wl AND lista_preg.id_com = data_result2.id_com 
    GROUP BY 
        data_result2.id_com, 
        data_result2.id_user 
    ORDER BY 
        Evaluado,Competencia ASC;";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }



    public function get_reporte_general(){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
        usuario.codigo_user,
        usuario.name_user AS Evaluado,
        departamento.name_dep,
        FORMAT((((SUM(rate) / COUNT(DISTINCT data_result2.id_userx)) / COUNT(DISTINCT lista_preg.id_preg)) * 100) / (COUNT(DISTINCT lista_preg.id_preg) * 10),2) AS Promedio,
        FORMAT(((((SUM(rate) / COUNT(DISTINCT data_result2.id_userx)) / COUNT(DISTINCT lista_preg.id_preg)) * 100) / (COUNT(DISTINCT lista_preg.id_preg) * 10) * 30) / 100,2) AS Total
        FROM data_result2 
        INNER JOIN usuario ON usuario.id_user = data_result2.id_user
        INNER JOIN lista_preg ON lista_preg.id_wl = usuario.id_wl
        INNER JOIN departamento ON departamento.id_dep = usuario.id_dep
        GROUP BY data_result2.id_user,usuario.id_wl;";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_reporte_pregunta(){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
        usuario.codigo_user,
        usuario.name_user AS Evaluado,
        (SELECT name_com FROM competencia WHERE data_result2.id_com = competencia.id_com) AS Competencia,
        preguntas.pregunta AS Pregunta,
        (SELECT name_user FROM usuario WHERE usuario.id_user = data_result2.id_userx) AS Evaluador, 
        data_result2.rate AS Puntuacion
        FROM data_result2
        INNER JOIN usuario ON usuario.id_user = data_result2.id_user
        INNER JOIN preguntas ON preguntas.id_preg = data_result2.id_preg
        ORDER BY usuario.name_user,preguntas.id_preg,Evaluador;";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}

?>