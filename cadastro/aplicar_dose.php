<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "vacinacao";

$connect = mysqli_connect($host, $user, $password, $db);

session_start();

if(isset($_POST['lote'])){
    $lote = $_POST['lote'];
    $marca = $_POST['marca'];
    $data = $_POST['data'];
    $numerodose = $_POST['numerodose'];
    $rgpaciente = $_POST['rgpaciente'];

    $sql = "INSERT INTO APLICACAO_DOSE VALUES('1', '".$lote."', '".$marca."', '".$data."', '".$numerodose."', '".$rgpaciente."', '".$_SESSION['RG']."');";

    if(mysqli_query($connect, $sql)){
        echo ' Aplicação realizada com sucesso! ';
    } else {
        echo ' Erro ao realizar aplicação! ';
    }
}
?>


<html>
    <body>

        <p>Aplicar Dose</p>

        <form method="POST" action="#">
            <label for="lote">ID Lote:</label><br>
            <input type="text" id="lote" name="lote"><br>

            <label for="marca">ID Marca:</label><br>
            <input type="text" id="marca" name="marca"><br>

            <label for="data">Data Aplicação:</label><br>
            <input type="text" id="data" name="data"><br>

            <label for="numerodose">Número da Dose:</label><br>
            <input type="text" id="numerodose" name="numerodose"><br>

            <label for="rgpaciente">RG Paciente:</label><br>
            <input type="text" id="rgpaciente" name="rgpaciente"><br>

            <input type="submit" value="Enviar">
        </form>

        <button onclick="window.location.href='../paginas/funcionario.php'">Voltar</button>
    </body>

</html>