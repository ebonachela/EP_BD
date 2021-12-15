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

        <p>Gerenciar Vacinas</p>

        <button onclick="window.location.href='../cadastro/cadastrar_fabricantes.php'">Adicionar fabricantes</button>
        <button onclick="window.location.href='../paginas/funcionario.php'">Voltar</button>

        <div>
            <h3 style="text-align: center;">Lista de fabricantes</h3>

            <table>
                <tr>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>CEP</th>
                    <th>Ação</th>
                </tr>

                <?php
                    $resultado = mysqli_query($connect, "SELECT * FROM FABRICANTE ORDER BY NOME"); 

                    if($resultado){
                        while($linha = $resultado->fetch_assoc()) {

                            echo '<tr>';
                            echo '<td>'.$linha['NOME'].'</td>';
                            echo '<td>'.$linha['CNPJ'].'</td>';
                            echo '<td>'.$linha['CEP'].'</td>';
                            
                            echo 
                                '<td>
                                    <form action="../cadastro/cadastrar_fabricante.php" method="post" style="display: inline;">
                                        <button name="atualizar" value="'.$linha['CNPJ'].'" style="margin-right: 5px">Alterar</button>
                                    </form>
                                    <form action="../api/remover_fabricante.php" method="post" style="display: inline;">
                                        <button name="remover" value="'.$linha['CNPJ'].'" style="margin-right: 5px">Remover</button>
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