<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "vacinacao";

$connect = mysqli_connect($host, $user, $password, $db);

if(isset($_POST['rg']) && !isset($_POST['atualizar'])){
    $rg = $_POST['rg'];
    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $salario = $_POST['salario'];
    $cep = $_POST['cep'];
    $cnes = $_POST['cnes'];
    $senha = $_POST['senha'];

    if(!isset($_POST['update'])) {
        $sql = "INSERT INTO FUNCIONARIO VALUES('".$rg."', '".$nome."', '".$data."', '".$hora."', '".$salario."', '".$cep."', '".$cnes."', '".$senha."');";
    } else {
        $saferg = isset($_POST['update']);
        $sql = "UPDATE FUNCIONARIO SET NOME = '".$nome."', DATA_NASC = '".$data."', HORA_INICIO = '".$hora."', SALARIO = '".$salario."', CEP = '".$cep."', CNES_ESTABELEC = '".$cnes."', SENHA = '".$senha."' WHERE RG = '".$rg."'";
    }

    if(mysqli_query($connect, $sql)){
        echo " Cadastro feito com sucesso! ";
        header("Location: gerenciar_funcionarios.php"); 
    } else {
        echo " Erro ao realizar cadastro! ";
        die();
    }

} else if(isset($_POST['atualizar'])){
    $rg = $_POST['atualizar'];

    $sql = "select * from FUNCIONARIO where RG = '".$rg."'";
    
    $result = mysqli_query($connect, $sql); 

    if($result){
        $dados = mysqli_fetch_array($result);
        $nome = $dados['NOME'];
        $data = $dados['DATA_NASC'];
        $hora = $dados['HORA_INICIO'];
        $salario = $dados['SALARIO'];
        $cep = $dados['CEP'];
        $cnes = $dados['CNES_ESTABELEC'];
        $senha = $dados['SENHA'];
    }
}

?>

<html>
    <body>

        <p>Cadastrar Funcionário</p>

        <form method="POST" action="#">
            <label for="rg">RG:</label><br>
            <input type="text" id="rg" name="rg" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$rg.'"' : ''; ?>><br>

            <label for="nome">Nome Completo:</label><br>
            <input type="text" id="nome" name="nome" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$nome.'"' : ''; ?>><br>

            <label for="data">Data de Nascimento:</label><br>
            <input type="text" id="data" name="data" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$data.'"' : ''; ?>><br>

            <label for="hora">Hora de Início:</label><br>
            <input type="text" id="hora" name="hora" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$hora.'"' : ''; ?>><br>

            <label for="salario">Salário:</label><br>
            <input type="text" id="salario" name="salario" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$salario.'"' : ''; ?>><br>

            <label for="cep">CEP:</label><br>
            <input type="text" id="cep" name="cep" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$cep.'"' : ''; ?>><br>

            <label for="cnes">CNES de onde trabalha:</label><br>
            <input type="text" id="cnes" name="cnes" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$cnes.'"' : ''; ?>><br>

            <label for="senha">Senha:</label><br>
            <input type="password" id="senha" name="senha" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$senha.'"' : ''; ?>><br>

            <input type="submit" value="Enviar" <?php echo (isset($_POST['atualizar'])) ? 'name="update"' : ''; ?>>
        </form>

        <button onclick="window.location.href='gerenciar_funcionarios.php'">Voltar</button>
    </body>
</html>