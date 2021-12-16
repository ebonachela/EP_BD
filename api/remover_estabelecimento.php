<?php

require_once('../api/db.php');

$db = new dbClass();
$connect = $db->conectar();

if(isset($_POST['remover'])){
    $sql = "DELETE FROM ESTABELECIMENTO WHERE CNES = '".$_POST['remover']."'";
    
    $result = mysqli_query($connect, $sql);

    if($result){
        header("Location: ../gerenciador/gerenciar_estabelecimentos.php"); 
    }
}

?>