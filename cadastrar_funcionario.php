<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "vacinacao";

$connect = mysqli_connect($host, $user, $password, $db);

if(isset($_POST['rg'])){
    $rg = $_POST['rg'];
    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $salario = $_POST['salario'];
    $cep = $_POST['cep'];
    $cnes = $_POST['cnes'];
    $senha = $_POST['senha'];

    $sql = "INSERT INTO FUNCIONARIO VALUES('".$rg."', '".$nome."', '".$data."', '".$hora."', '".$salario."', '".$cep."', '".$cnes."', '".$senha."');";

    if(mysqli_query($connect, $sql)){
        echo " Cadastro feito com sucesso! ";
    } else {
        echo " Erro ao realizar cadastro! ";
    }
}

?>

<html>
    <body>

        <p>Cadastrar Funcionário</p>

        <form method="POST" action="#">
            <label for="rg">RG:</label><br>
            <input type="text" id="rg" name="rg"><br>

            <label for="nome">Nome Completo:</label><br>
            <input type="text" id="nome" name="nome"><br>

            <label for="data">Data de Nascimento:</label><br>
            <input type="text" id="data" name="data"><br>

            <label for="hora">Hora de Início:</label><br>
            <input type="text" id="hora" name="hora"><br>

            <label for="salario">Salário:</label><br>
            <input type="text" id="salario" name="salario"><br>

            <label for="cep">CEP:</label><br>
            <input type="text" id="cep" name="cep"><br>

            <label for="cnes">CNES de onde trabalha:</label><br>
            <input type="text" id="cnes" name="cnes"><br>

            <label for="senha">Senha:</label><br>
            <input type="password" id="senha" name="senha"><br>

            <input type="submit" value="Enviar">
        </form>

        <button onclick="window.location.href='funcionario.php'">Voltar</button>
    </body>
</html>