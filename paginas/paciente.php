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
            width: 50%;
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
        <h3>Perfil Paciente</h3>
        
        <div>
            <?php 
                $sql = "SELECT * FROM PACIENTE WHERE RG = '".$_SESSION['RG']."'";
            
                $result = mysqli_query($connect, $sql);

                if($result){
                    $dados = mysqli_fetch_array($result);
                    echo $dados['NOME'] . '<br>';
                    echo $dados['RG'] . '<br>';
                    echo $dados['DATA_NASC'] . '<br>';
                    echo $dados['ETNIA'] . '<br>';
                    echo $dados['GENERO'] . '<br>';
                    echo $dados['NACIONALIDADE'] . '<br>';
                    echo $dados['CEP'] . '<br>';
                }
            ?>
        </div>

        <div>
            <h3>Histórico de Vacinas</h3>

            <?php
                $resultado = mysqli_query($connect, "SELECT aplicacao_dose.id, aplicacao_dose.NUMERO_VACINA, aplicacao_dose.ID_LOTE, aplicacao_dose.ID_MARCA, aplicacao_dose.DATA_APLICACAO, aplicacao_dose.NUMERO_DOSE, aplicacao_dose.RG_PACIENTE, aplicacao_dose.RG_FUNCIONARIO, paciente.NOME as NOME_PACIENTE, funcionario.NOME as NOME_FUNCIONARIO, marca.NOME as NOME_MARCA FROM aplicacao_dose INNER JOIN paciente ON aplicacao_dose.RG_PACIENTE = paciente.RG INNER JOIN funcionario ON funcionario.RG = aplicacao_dose.RG_FUNCIONARIO INNER JOIN marca ON marca.ID_MARCA = aplicacao_dose.ID_MARCA WHERE RG_PACIENTE = '".$_SESSION['RG']."';"); 

                if(mysqli_num_rows($resultado) > 0){

                    echo 
                    '<table>
                        <tr>
                            <th>ID Lote</th>
                            <th>Marca</th>
                            <th>Data Aplicação</th>
                            <th>Funcionário</th>
                        </tr>
                    ';

                    while($linha = $resultado->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>'.$linha['ID_LOTE'].'</td>';
                        echo '<td>'.$linha['NOME_MARCA'].'</td>';
                        echo '<td>'.$linha['DATA_APLICACAO'].'</td>';
                        echo '<td>'.$linha['NOME_FUNCIONARIO'].'</td>';
                    }

                    echo '</table>';
                } else {
                    echo ' Você ainda não tomou nenhuma vacina. ';
                }
            ?>
        </div>
        
        <br>
        <button onclick="window.location.href='../api/sair.php'">Sair</button>
    </body>
</html>