<?php

require_once('../api/db.php');

$db = new dbClass();
$connect = $db->conectar();

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
            width: 90%;
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

        <p>Gerenciar de Doses</p>

        <button onclick="window.location.href='../paginas/funcionario.php'">Voltar</button>

        <div>
            <h3 style="text-align: center;">Lista de doses aplicadas</h3>

            <table>
                <tr>
                    <th>ID Lote</th>
                    <th>ID Marca</th>
                    <th>Data de Aplicação</th>
                    <th>Número da Dose</th>
                    <th>Nome Paciente</th>
                    <th>Nome Funcionário</th>
                    <th>Ação</th>
                </tr>

                <?php
                    $resultado = mysqli_query($connect, "SELECT aplicacao_dose.id, aplicacao_dose.ID_LOTE, aplicacao_dose.ID_MARCA, aplicacao_dose.DATA_APLICACAO, '%d/%m/%Y', aplicacao_dose.NUMERO_DOSE, paciente.NOME as NOME_PACIENTE, funcionario.NOME as NOME_FUNCIONARIO, aplicacao_dose.RG_PACIENTE, aplicacao_dose.RG_FUNCIONARIO  FROM aplicacao_dose INNER JOIN paciente ON paciente.rg = aplicacao_dose.RG_PACIENTE INNER JOIN funcionario ON funcionario.RG = aplicacao_dose.RG_FUNCIONARIO ORDER BY id;"); 

                    if($resultado){
                        while($linha = $resultado->fetch_assoc()) {

                            echo '<tr>';
                            echo '<td>'.$linha['ID_LOTE'].'</td>';
                            echo '<td>'.$linha['ID_MARCA'].'</td>';
                            echo '<td>'.$linha['DATA_APLICACAO'].'</td>';
                            echo '<td>'.$linha['NUMERO_DOSE'].'</td>';
                            echo '<td>'.$linha['NOME_PACIENTE'].'</td>';
                            echo '<td>'.$linha['NOME_FUNCIONARIO'].'</td>';
                            
                            echo 
                                '<td>
                                    <form action="../api/remover_dose.php" method="post" style="display: inline;">
                                        <button name="remover" value="'.$linha['id'].'" style="margin-right: 5px">Remover</button>
                                    </form>
                                </td>';

                            echo '</tr>';

                        }
                    }
                ?>
            </table>

        </div>
    </body>
</html>