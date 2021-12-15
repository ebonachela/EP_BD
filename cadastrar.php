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
    $etnia = $_POST['etnia'];
    $genero = $_POST['genero'];
    $nacionalidade = $_POST['nacionalidade'];
    $cep = $_POST['cep'];
    $senha = $_POST['senha'];

    $sql = "INSERT INTO PACIENTE VALUES('".$rg."', '".$nome."', '".$data."', '".$etnia."', '".$genero."', '".$nacionalidade."', '".$cep."', '".$senha."');";

    if(mysqli_query($connect, $sql)){
        echo " Cadastro feito com sucesso! ";
    } else {
        echo " Erro ao realizar cadastro! ";
    }
}

?>

<html>
    <body>

        <p>Cadastrar Paciente</p>

        <form method="POST" action="#">
            <label for="rg">RG:</label><br>
            <input type="text" id="rg" name="rg"><br>

            <label for="nome">Nome Completo:</label><br>
            <input type="text" id="nome" name="nome"><br>

            <label for="data">Data de Nascimento:</label><br>
            <input type="text" id="data" name="data"><br>

            <label for="etnia">Etnia:</label><br>
            <select name="etnia" id="etnia" style="width: 170px">
                <option value="Negro">Negro</option>
                <option value="Indigena">Indigena</option>
                <option value="Branco">Branco</option>
                <option value="Pardo">Pardo</option>
                <option value="Outro">Outro</option>
            </select><br>

            <label for="genero">Gênero:</label><br>
            <select name="genero" id="genero" style="width: 170px">
                <option value="mulher">Mulher</option>
                <option value="momem">Homem</option>
                <option value="outro">Outro</option>
                <option value="prefiro não dizer">Prefiro não dizer</option>
            </select><br>

            <label for="nacionalidade">Nacionalidade:</label><br>
            <select name="nacionalidade" id="nacionalidade" style="width: 170px">
                <option value="Brasileiro">Brasileiro</option>
                <option value="Estrangeiro">Estrangeiro</option>
            </select><br>

            <label for="cep">CEP:</label><br>
            <input type="text" id="cep" name="cep"><br>

            <label for="senha">Senha:</label><br>
            <input type="password" id="senha" name="senha"><br>

            <input type="submit" value="Enviar">
        </form>

        <button onclick="window.location.href='index.php'">Voltar</button>
    </body>
</html>