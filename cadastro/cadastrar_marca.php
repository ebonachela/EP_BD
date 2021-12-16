<?php

require_once('../api/db.php');

$db = new dbClass();
$connect = $db->conectar();

if(isset($_POST['nome']) && !isset($_POST['atualizar'])){
    $nome = $db->escape($_POST['nome']);
    $numero_doses = $db->escape($_POST['numero_doses']);

    if(!isset($_POST['update'])) {
        $sql = "INSERT INTO MARCA(NOME, NUMERO_DOSES) VALUES('".$nome."', '".$numero_doses."');";
    } else {
        $id_marca = $_POST['update'];
        $sql = "UPDATE MARCA SET NOME = '".$nome."', NUMERO_DOSES = '".$numero_doses."' WHERE ID_MARCA = '".$id_marca."';";
    }

    if(mysqli_query($connect, $sql)){
        echo " Cadastro feito com sucesso! ";
        header("Location: ../gerenciador/gerenciar_vacinas.php"); 
    } else {
        echo " Erro ao realizar cadastro! ";
        die();
    }

} else if(isset($_POST['atualizar'])){
    $id_marca = $db->escape($_POST['atualizar']);

    $sql = "SELECT * FROM MARCA WHERE ID_MARCA = '".$id_marca."';";
    
    $result = mysqli_query($connect, $sql); 

    if($result){
        $dados = mysqli_fetch_array($result);
        $nome = $dados['NOME'];
        $numero_doses = $dados['NUMERO_DOSES'];
    }
}

?>

<html>
    <body>

        <p>Cadastrar Marca</p>

        <form method="POST" action="#">
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$nome.'"' : ''; ?>><br>

            <label for="numero_doses">Número de Doses:</label><br>
            <input type="text" id="numero_doses" name="numero_doses" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$numero_doses.'"' : ''; ?>><br>

            <input type="submit" value="Enviar" <?php echo (isset($_POST['atualizar'])) ? 'name="update"' : ''; ?>>
        </form>

        <button onclick="window.location.href='../gerenciador/gerenciar_vacinas.php'">Voltar</button>
    </body>
</html>