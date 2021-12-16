<?php

class dbClass{

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $database = 'vacinacao';

    public function conectar(){
        $con = mysqli_connect($this->host, $this->user, $this->pass, $this->database);
        mysqli_set_charset($con, 'utf8');

        //Erro de conexão
        if (mysqli_connect_errno()){
            echo 'Erro na conexão com o banco de dados';
        }

        return $con;
    }

    public function escape($inp) { 
        if(is_array($inp)) 
            return array_map(__METHOD__, $inp); 
    
        if(!empty($inp) && is_string($inp)) { 
            return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp); 
        } 
    
        return $inp;
    }

}