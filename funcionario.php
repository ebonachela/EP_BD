<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "vacinacao";

$connect = mysqli_connect($host, $user, $password, $db);

session_start();

?>


<html>
    <body>

        <p>Funcionário</p>

        <button onclick="window.location.href='cadastrar_funcionario.php'">Adicionar funcionário</button>
        <button onclick="window.location.href='sair.php'">Sair</button>
    </body>
</html>