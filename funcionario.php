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

        <button onclick="window.location.href='gerenciar_funcionarios.php'">Gerenciar funcionários</button>
        <button onclick="window.location.href='gerenciar_pacientes.php'">Gerenciar pacientes</button>
        <button onclick="window.location.href='sair.php'">Sair</button>
    </body>
</html>