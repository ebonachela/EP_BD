<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "vacinacao";

$connect = mysqli_connect($host, $user, $password, $db);

session_start();

if(isset($_POST['lote'])){
    $lote = $_POST['lote'];

    $resultado = mysqli_query($connect, "SELECT ID_MARCA FROM LOTE WHERE ID_LOTE = '".$lote."';"); 
    $dados = mysqli_fetch_array($resultado);

    $marca = $dados['ID_MARCA'];
    $data = $_POST['data'];
    $numerodose = $_POST['numerodose'];
    $rgpaciente = $_POST['rgpaciente'];

    $sql = "INSERT INTO APLICACAO_DOSE (NUMERO_VACINA, ID_LOTE, ID_MARCA, DATA_APLICACAO, NUMERO_DOSE, RG_PACIENTE, RG_FUNCIONARIO) VALUES('1', '".$lote."', '".$marca."', '".$data."', '".$numerodose."', '".$rgpaciente."', '".$_SESSION['RG']."');";

    if(mysqli_query($connect, $sql)){
        echo ' Aplicação realizada com sucesso! ';
    } else {
        echo ' Erro ao realizar aplicação! ';
    }
}
?>


<html>
    <body>

        <p>Aplicar Dose</p>

        <form method="POST" action="#">
            <label for="lote">ID Lote:</label><br>
            <select name="lote" id="lote" style="width: 170px">
                <?php 
                    $resultado = mysqli_query($connect, "SELECT * FROM LOTE ORDER BY ID_LOTE"); 

                    if($resultado){
                        while($linha = $resultado->fetch_assoc()) {
                            echo '<option value="'.$linha['ID_LOTE'].'">'.$linha['ID_LOTE'].'</option>';
                        }
                    }
                ?>
            </select><br>

            <label for="data">Data Aplicação:</label><br>
            <input type="text" id="data" name="data"><br>

            <label for="numerodose">Número da Dose:</label><br>
            <input type="text" id="numerodose" name="numerodose"><br>

            <label for="rgpaciente">RG Paciente:</label><br>
            <input type="text" id="rgpaciente" name="rgpaciente"><br>

            <input type="submit" value="Enviar">
        </form>

        <button onclick="window.location.href='../paginas/funcionario.php'">Voltar</button>
    </body>

</html>