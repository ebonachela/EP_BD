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

        <button onclick="window.location.href='../gerenciador/gerenciar_funcionarios.php'">Gerenciar funcionários</button>
        <button onclick="window.location.href='../gerenciador/gerenciar_pacientes.php'">Gerenciar pacientes</button>
        <button onclick="window.location.href='../gerenciador/gerenciar_estabelecimentos.php'">Gerenciar estabelecimentos</button>
        <button onclick="window.location.href='../gerenciador/gerenciar_doses.php'">Gerenciar doses</button>
        <button onclick="window.location.href='../cadastro/aplicar_dose.php'">Aplicar dose</button>
        <button onclick="window.location.href='../api/sair.php'">Sair</button>
    </body>
</html>