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

        <h2 style="text-align: center; margin-top: 20px">Gerenciar Pacientes</h2>

        <div style="display: flex; justify-content: center;">
            <button onclick="window.location.href='../paginas/funcionario.php'">Voltar</button>
        </div>

        <div>
            <h3 style="text-align: center;">Lista de pacientes</h3>

            <table>
                <tr>
                    <th>Nome</th>
                    <th>RG</th>
                    <th>Data de Nascimento</th>
                    <th>Etnia</th>
                    <th>Gênero</th>
                    <th>Nacionalidade</th>
                    <th>CEP</th>
                    <th>Ação</th>
                </tr>

                <?php
                    $resultado = mysqli_query($connect, "SELECT * FROM PACIENTE ORDER BY NOME"); 

                    if($resultado){
                        while($linha = $resultado->fetch_assoc()) {

                            echo '<tr>';
                            echo '<td>'.$linha['NOME'].'</td>';
                            echo '<td>'.$linha['RG'].'</td>';
                            echo '<td>'.$linha['DATA_NASC'].'</td>';
                            echo '<td>'.$linha['ETNIA'].'</td>';
                            echo '<td>'.$linha['GENERO'].'</td>';
                            echo '<td>'.$linha['NACIONALIDADE'].'</td>';
                            echo '<td>'.$linha['CEP'].'</td>';
                            
                            echo 
                                '<td>
                                    <form action="../cadastro/cadastrar.php" method="post" style="display: inline;">
                                        <button name="atualizar" value="'.$linha['RG'].'" style="margin-right: 5px">Alterar</button>
                                    </form>
                                    <form action="../api/remover_paciente.php" method="post" style="display: inline;">
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