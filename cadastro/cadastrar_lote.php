<?php

require_once('../api/db.php');

$db = new dbClass();
$connect = $db->conectar();

if(isset($_POST['cnpj_fabric']) && !isset($_POST['atualizar'])){
    $id_marca = $db->escape($_POST['id_marca']);
    $validade = $db->escape($_POST['validade']);
    $data_fabric = $db->escape($_POST['data_fabric']);
    $cnpj_fabric = $db->escape($_POST['cnpj_fabric']);


    if(!isset($_POST['update'])) {
        $sql = "INSERT INTO LOTE (ID_MARCA, VALIDADE, DATA_FABRIC, CNPJ_FABRIC) VALUES('".$id_marca."', '".$validade."', '".$data_fabric."', '".$cnpj_fabric."');";
    } else {
        $id_lote = isset($_POST['id_lote']);
        $sql = "UPDATE LOTE SET ID_MARCA = '".$id_marca."', VALIDADE = '".$validade."', DATA_FABRIC = '".$data_fabric."', CNPJ_FABRIC = '".$cnpj_fabric."' WHERE ID_LOTE = '".$id_lote."';";
    }

    if(mysqli_query($connect, $sql)){
        echo " Cadastro feito com sucesso! ";
        header("Location: ../gerenciador/gerenciar_vacinas.php"); 
    } else {
        echo " Erro ao realizar cadastro! ";
        die();
    }

} else if(isset($_POST['atualizar'])){
    $id_lote = $db->escape($_POST['atualizar']);

    $sql = "SELECT * FROM LOTE WHERE ID_LOTE = '".$id_lote."';";
    
    $result = mysqli_query($connect, $sql); 

    if($result){
        $dados = mysqli_fetch_array($result);
        $id_marca = $dados['ID_MARCA'];
        $validade = $dados['VALIDADE'];
        $data_fabric = $dados['DATA_FABRIC'];
        $cnpj_fabric = $dados['CNPJ_FABRIC'];
    }
}

?>

<html>
    <body>

        <p>Cadastrar Lote</p>

        <form method="POST" action="#">
            <label for="id_marca">ID Marca:</label><br>
            <select name="id_marca" id="id_marca" style="width: 170px" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$id_marca.'"' : ''; ?>>
                <?php 
                    $resultado = mysqli_query($connect, "SELECT * FROM marca ORDER BY ID_MARCA"); 

                    if($resultado){
                        while($linha = $resultado->fetch_assoc()) {
                            echo '<option value="'.$linha['ID_MARCA'].'">'.$linha['ID_MARCA'].':'.$linha['NOME'].'</option>';
                        }
                    }
                ?>
            </select><br>

            <label for="validade">Validade:</label><br>
            <input type="text" id="validade" name="validade" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$validade.'"' : ''; ?>><br>

            <label for="data_fabric">Data Fabricação:</label><br>
            <input type="text" id="data_fabric" name="data_fabric" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$data_fabric.'"' : ''; ?>><br>

            <label for="cnpj_fabric">Fabricante:</label><br>
            <select name="cnpj_fabric" id="cnpj_fabric" style="width: 170px" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$cnpj_fabric.'"' : ''; ?>>
                <?php 
                    $resultado = mysqli_query($connect, "SELECT * FROM FABRICANTE ORDER BY NOME"); 

                    if($resultado){
                        while($linha = $resultado->fetch_assoc()) {
                            echo '<option value="'.$linha['CNPJ'].'">'.$linha['NOME'].'</option>';
                        }
                    }
                ?>
            </select><br>

            <input type="submit" value="Enviar" <?php echo (isset($_POST['atualizar'])) ? 'name="update"' : ''; ?>>
        </form>

        <button onclick="window.location.href='../gerenciador/gerenciar_vacinas.php'">Voltar</button>
    </body>
</html>