<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "vacinacao";

$connect = mysqli_connect($host, $user, $password, $db);
mysqli_set_charset($connect,"utf8mb4");

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

        <p>Gerenciar Estabelecimentos</p>

        <button onclick="window.location.href='../cadastro/cadastrar_estabelecimento.php'">Adicionar estabelecimento</button>
        <button onclick="window.location.href='../paginas/funcionario.php'">Voltar</button>

        <div>
            <h3 style="text-align: center;">Lista de estabelecimentos</h3>

            <table>
                <tr>
                    <th>Nome Fantasia</th>
                    <th>Razão Social</th>
                    <th>CNPJ</th>
                    <th>CEP</th>
                    <th>CNES</th>
                    <th>Ação</th>
                </tr>

                <?php
                    $resultado = mysqli_query($connect, "SELECT * FROM ESTABELECIMENTO ORDER BY NOME_FANTASIA"); 

                    if($resultado){
                        while($linha = $resultado->fetch_assoc()) {

                            echo '<tr>';
                            echo '<td>'.$linha['NOME_FANTASIA'].'</td>';
                            echo '<td>'.$linha['RAZAO_SOCIAL'].'</td>';
                            echo '<td>'.$linha['CNPJ'].'</td>';
                            echo '<td>'.$linha['CEP'].'</td>';
                            echo '<td>'.$linha['CNES'].'</td>';
                            
                            echo 
                                '<td>
                                    <form action="../cadastro/cadastrar_estabelecimento.php" method="post" style="display: inline;">
                                        <button name="atualizar" value="'.$linha['CNES'].'" style="margin-right: 5px">Alterar</button>
                                    </form>
                                    <form action="../api/remover_estabelecimento.php" method="post" style="display: inline;">
                                        <button name="remover" value="'.$linha['CNES'].'" style="margin-right: 5px">Remover</button>
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