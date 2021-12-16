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

        <h2 style="text-align: center; margin-top: 20px">Gerenciar Funcionários</h2>

        <div style="display: flex; justify-content: center;">
            <button onclick="window.location.href='../cadastro/cadastrar_funcionario.php'">Adicionar funcionário</button>
            <button onclick="window.location.href='../paginas/funcionario.php'">Voltar</button>
        </div>

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
                    <th>Dependente</th>
                    <th>Parentesco</th>
                    <th>Ação</th>
                </tr>

                <?php
                    $resultado = mysqli_query($connect, "SELECT funcionario.RG, funcionario.NOME, funcionario.DATA_NASC, funcionario.HORA_INICIO, funcionario.SALARIO, funcionario.CEP, funcionario.CNES_ESTABELEC, funcionario.SENHA, dependente.RG as RG_DEPENDENTE, dependente.NOME as NOME_DEPENDENTE, dependente.PARENTESCO FROM funcionario INNER JOIN dependente ON dependente.RG_FUNCIONARIO = funcionario.rg ORDER BY NOME"); 

                    if($resultado){
                        while($linha = $resultado->fetch_assoc()) {

                            echo '<tr>';
                            echo '<td>'.$linha['NOME'].'</td>';
                            echo '<td>'.$linha['RG'].'</td>';
                            echo '<td>'.$linha['HORA_INICIO'].'</td>';
                            echo '<td>R$'.$linha['SALARIO'].'</td>';
                            echo '<td>'.$linha['CEP'].'</td>';
                            echo '<td>'.$linha['CNES_ESTABELEC'].'</td>';
                            echo '<td>'.$linha['NOME_DEPENDENTE'].'</td>';
                            echo '<td>'.$linha['PARENTESCO'].'</td>';
                            
                            echo 
                                '<td>
                                    <form action="../cadastro/cadastrar_funcionario.php" method="post" style="display: inline;">
                                        <button name="atualizar" value="'.$linha['RG'].'" style="margin-right: 5px">Alterar</button>
                                    </form>
                                    <form action="../api/remover_funcionario.php" method="post" style="display: inline;">
                                        <button name="remover" value="'.$linha['RG'].'" style="margin-right: 5px">Remover</button>
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