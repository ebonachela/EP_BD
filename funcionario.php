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
            width: 60%;
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
            <h4>Lista de funcionários:</h4>

            <table>
                <tr>
                    <th>Nome</th>
                    <th>RG</th>
                    <th>Hora de início</th>
                    <th>CNES</th>
                </tr>

                <?php
                    $resultado = mysqli_query($connect, "SELECT * FROM FUNCIONARIO"); 

                    if($resultado){
                        while($linha = $resultado->fetch_assoc()) {

                            echo '<tr>';
                            echo '<td>'.$linha['NOME'].'</td>';
                            echo '<td>'.$linha['RG'].'</td>';
                            echo '<td>'.$linha['HORA_INICIO'].'</td>';
                            echo '<td>'.$linha['CNES_ESTABELEC'].'</td>';
                            echo '</tr>';

                        }
                    }
                ?>
            </table>

        </div>
    </body>
</html>