<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "vacinacao";

$connect = mysqli_connect($host, $user, $password, $db);

if(isset($_POST['remover'])){
    $sql = "DELETE FROM PACIENTE WHERE RG = '".$_POST['remover']."'";
    
    $result = mysqli_query($connect, $sql);

    if($result){
        header("Location: gerenciar_pacientes.php"); 
    }
}

?>