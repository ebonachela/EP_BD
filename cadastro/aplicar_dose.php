<?php

require_once('../api/db.php');

$db = new dbClass();
$connect = $db->conectar();

session_start();

if(isset($_POST['lote'])){
    $lote = $_POST['lote'];

    $resultado = mysqli_query($connect, "SELECT ID_MARCA FROM lote WHERE ID_LOTE = '".$lote."';"); 
    $dados = mysqli_fetch_array($resultado);

    $marca = $db->escape($dados['ID_MARCA']);
    $data = $db->escape($_POST['data']);
    $numerodose = $db->escape($_POST['numerodose']);
    $rgpaciente = $db->escape($_POST['rgpaciente']);

    $sql = "INSERT INTO aplicacao_dose (NUMERO_VACINA, ID_LOTE, ID_MARCA, DATA_APLICACAO, NUMERO_DOSE, RG_PACIENTE, RG_FUNCIONARIO) VALUES('1', '".$lote."', '".$marca."', '".$data."', '".$numerodose."', '".$rgpaciente."', '".$_SESSION['RG']."');";

    if(mysqli_query($connect, $sql)){
        echo ' Aplicação realizada com sucesso! ';
    } else {
        echo ' Erro ao realizar aplicação! ';
    }
}
?>


<html>
    <style>
        body { 
            text-align: center; 
        }

        #containerentrar{
            text-align: center;
        }

        form {
            display: inline-block;
            margin-left: auto;
            margin-right: auto;
            text-align: left;
        }

        .item {
            margin-bottom: 10px;
        }

        h2 {
            text-align: center; 
            margin-top: 20px"
        }
    </style>

    <body>

        <h2>Aplicar Dose</h2>

        <form method="POST" action="#">
            <label for="lote">ID Lote:</label><br>
            <select class="item" name="lote" id="lote" style="width: 170px">
                <?php 
                    $resultado = mysqli_query($connect, "SELECT * FROM lote ORDER BY ID_LOTE"); 

                    if($resultado){
                        while($linha = $resultado->fetch_assoc()) {
                            echo '<option value="'.$linha['ID_LOTE'].'">'.$linha['ID_LOTE'].'</option>';
                        }
                    }
                ?>
            </select><br>

            <label for="data">Data Aplicação:</label><br>
            <input class="item" type="text" id="data" name="data"><br>

            <label for="numerodose">Número da Dose:</label><br>
            <input class="item" type="text" id="numerodose" name="numerodose"><br>

            <label for="rgpaciente">RG Paciente:</label><br>
            <input class="item" type="text" id="rgpaciente" name="rgpaciente"><br>
            
            <div id="containerentrar">
                <input type="submit" value="Enviar">
            </div>
        </form>
        
        <div>
            <button onclick="window.location.href='../paginas/funcionario.php'">Voltar</button>
        </div>
    </body>

</html>