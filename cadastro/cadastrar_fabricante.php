<?php

require_once('../api/db.php');

$db = new dbClass();
$connect = $db->conectar();

if(isset($_POST['cnpj']) && !isset($_POST['atualizar'])){
    $nome = $_POST['nome'];
    $cnpj = $_POST['cnpj'];
    $cep = $_POST['cep'];


    if(!isset($_POST['update'])) {
        $sql = "INSERT INTO FABRICANTE VALUES('".$nome."', '".$cnpj."', '".$cep."');";
    } else {
        $saferg = isset($_POST['update']);
        $sql = "UPDATE FABRICANTE SET NOME = '".$nome."', CEP = '".$cep."' WHERE CNPJ = '".$cnpj."';";
    }

    if(mysqli_query($connect, $sql)){
        echo " Cadastro feito com sucesso! ";
        header("Location: ../gerenciador/gerenciar_vacinas.php"); 
    } else {
        echo " Erro ao realizar cadastro! ";
        die();
    }

} else if(isset($_POST['atualizar'])){
    $cnes = $_POST['atualizar'];

    $sql = "SELECT * FROM FABRICANTE WHERE CNPJ = '".$cnes."';";
    
    $result = mysqli_query($connect, $sql); 

    if($result){
        $dados = mysqli_fetch_array($result);
        $nome = $dados['NOME'];
        $cnpj = $dados['CNPJ'];
        $cep = $dados['CEP'];
    }
}

?>

<html>
    <body>

        <p>Cadastrar Fabricante</p>

        <form method="POST" action="#">
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$nome.'"' : ''; ?>><br>

            <label for="cnpj">CNPJ:</label><br>
            <input type="text" id="cnpj" name="cnpj" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$cnpj.'"' : ''; ?>><br>

            <label for="cep">CEP:</label><br>
            <input type="text" id="cep" name="cep" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$cep.'"' : ''; ?>><br>

            <input type="submit" value="Enviar" <?php echo (isset($_POST['atualizar'])) ? 'name="update"' : ''; ?>>
        </form>

        <button onclick="window.location.href='../gerenciador/gerenciar_vacinas.php'">Voltar</button>
    </body>
</html>