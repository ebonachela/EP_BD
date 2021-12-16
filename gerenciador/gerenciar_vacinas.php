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

        <button onclick="window.location.href='../cadastro/cadastrar_fabricante.php'">Adicionar fabricantes</button>
        <button onclick="window.location.href='../cadastro/cadastrar_lote.php'">Adicionar lotes</button>
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

        <div>
            <h3 style="text-align: center;">Lista de lotes</h3>

            <table>
                <tr>
                    <th>ID Lote</th>
                    <th>ID Marca</th>
                    <th>Fabricação</th>
                    <th>Validade</th>
                    <th>Nome do Fabricante</th>
                    <th>Ação</th>
                </tr>

                <?php
                    $resultado2 = mysqli_query($connect, "SELECT lote.ID_LOTE, lote.ID_MARCA, lote.VALIDADE, lote.DATA_FABRIC, lote.CNPJ_FABRIC, fabricante.NOME as NOME_FABRICANTE FROM lote INNER JOIN fabricante on fabricante.CNPJ = lote.CNPJ_FABRIC ORDER BY lote.ID_LOTE"); 

                    if($resultado2){
                        while($linha = $resultado2->fetch_assoc()) {

                            echo '<tr>';
                            echo '<td>'.$linha['ID_LOTE'].'</td>';
                            echo '<td>'.$linha['ID_MARCA'].'</td>';
                            echo '<td>'.$linha['DATA_FABRIC'].'</td>';
                            echo '<td>'.$linha['VALIDADE'].'</td>';
                            echo '<td>'.$linha['NOME_FABRICANTE'].'</td>';
                            
                            echo 
                                '<td>
                                    <form action="../cadastro/cadastrar_lote.php" method="post" style="display: inline;">
                                        <button name="atualizar" value="'.$linha['ID_LOTE'].'" style="margin-right: 5px">Alterar</button>
                                    </form>
                                    <form action="../api/remover_lote.php" method="post" style="display: inline;">
                                        <button name="remover" value="'.$linha['ID_LOTE'].'" style="margin-right: 5px">Remover</button>
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