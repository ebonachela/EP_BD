<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "vacinacao";

$connect = mysqli_connect($host, $user, $password, $db);

if(isset($_POST['rg'])){
    $rg = $_POST['rg'];
    $data = $_POST['data'];
    $etnia = $_POST['etnia'];
    $genero = $_POST['genero'];
    $nacionalidade = $_POST['nacionalidade'];
    $cep = $_POST['cep'];
    $senha = $_POST['senha'];

    $sql = "INSERT INTO PACIENTE VALUES('.$rg.')";
}

?>

<html>
    <body>

        <p>Cadastrar</p>

        <form method="POST" action="#">
            <label for="rg">RG:</label><br>
            <input type="text" id="rg" name="rg"><br>

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
                <option value="Mulher">Mulher</option>
                <option value="Homem">Homem</option>
                <option value="Outro">Outro</option>
                <option value="Prefiro não dizer">Prefiro não dizer</option>
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

    </body>
</html>