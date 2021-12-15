<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "vacinacao";

$connect = mysqli_connect($host, $user, $password, $db);

session_start();

?>


<html>
    <style>
        span {
            padding-right: 5px;
        }
        
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

    </style>
    <body>

        <p>Funcionário</p>

        <button onclick="window.location.href='cadastrar_funcionario.php'">Adicionar funcionário</button>
        <button onclick="window.location.href='sair.php'">Sair</button>

        <div>
            <h3 style="text-align: center;">Lista de funcionários</h3>

            <table>
                <tr>
                    <th>Nome</th>
                    <th>RG</th>
                    <th>Hora de início</th>
                    <th>Salário</th>
                    <th>CEP</th>
                    <th>CNES</th>
                    <th>Ação</th>
                </tr>

                <?php
                    $resultado = mysqli_query($connect, "SELECT * FROM FUNCIONARIO"); 

                    if($resultado){
                        while($linha = $resultado->fetch_assoc()) {

                            echo '<tr>';
                            echo '<td>'.$linha['NOME'].'</td>';
                            echo '<td>'.$linha['RG'].'</td>';
                            echo '<td>'.$linha['HORA_INICIO'].'</td>';
                            echo '<td>R$'.$linha['SALARIO'].'</td>';
                            echo '<td>'.$linha['CEP'].'</td>';
                            echo '<td>'.$linha['CNES_ESTABELEC'].'</td>';
                            echo '<td><button style="margin-right: 5px">Alterar</button><button>Remover</button></td>';
                            echo '</tr>';

                        }
                    }
                ?>
            </table>

        </div>
    </body>
</html>