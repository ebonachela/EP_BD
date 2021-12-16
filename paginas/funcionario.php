<?php

require_once('../api/db.php');

$db = new dbClass();
$connect = $db->conectar();

session_start();

?>


<html>
    <style>

    </style>
    <body>

        <h2 style="text-align: center; margin-top: 20px">Página do Funcionário</h2>

        <div>
            <h3 style="text-align: center;">Gerenciar Setores</h3>
            <div style="display: flex; justify-content: center;">
                <button onclick="window.location.href='../gerenciador/gerenciar_funcionarios.php'">Gerenciar funcionários</button>
                <button onclick="window.location.href='../gerenciador/gerenciar_pacientes.php'">Gerenciar pacientes</button>
                <button onclick="window.location.href='../gerenciador/gerenciar_estabelecimentos.php'">Gerenciar estabelecimentos</button>
                <button onclick="window.location.href='../gerenciador/gerenciar_vacinas.php'">Gerenciar vacinas</button>
                <button onclick="window.location.href='../gerenciador/gerenciar_doses.php'">Gerenciar aplicação</button>
            </div>
        </div>

        <div>
            <h3 style="text-align: center;">Vacinação</h3>
            <div style="display: flex; justify-content: center;">
                <button onclick="window.location.href='../cadastro/aplicar_dose.php'">Aplicar dose</button>
            </div>
        </div>

        <div style="display: flex; justify-content: center; margin-top: 30px;">
            <button onclick="window.location.href='../api/sair.php'">Sair</button>
        </div>
    </body>
</html>