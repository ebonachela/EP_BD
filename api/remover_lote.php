<?php

require_once('../api/db.php');

$db = new dbClass();
$connect = $db->conectar();

if(isset($_POST['remover'])){
    $sql = "DELETE FROM LOTE WHERE ID_LOTE = '".$db->escape($_POST['remover'])."'";
    
    $result = mysqli_query($connect, $sql);

    if($result){
        header("Location: ../gerenciador/gerenciar_vacinas.php"); 
    }
}

?>