<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "vacinacao";

$connect = mysqli_connect($host, $user, $password, $db);

if(isset($_POST['remover'])){
    $sql = "DELETE FROM FUNCIONARIO WHERE RG = '".$_POST['remover']."'";
    $sql2 = "DELETE FROM DEPENDENTE WHERE RG_FUNCIONARIO = '".$_POST['remover']."'";
    
    $result = mysqli_query($connect, $sql);
    $result2 = mysqli_query($connect, $sql2);

    if($result && $result2){
        header("Location: ../gerenciador/gerenciar_funcionarios.php"); 
    }
}

?>