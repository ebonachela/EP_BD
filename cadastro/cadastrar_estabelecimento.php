<?php

require_once('../api/db.php');

$db = new dbClass();
$connect = $db->conectar();

if(isset($_POST['cnes']) && !isset($_POST['atualizar'])){
    $nome_fantasia = $db->escape($_POST['nome_fantasia']);
    $razao_social = $db->escape($_POST['razao_social']);
    $cnpj = $db->escape($_POST['cnpj']);
    $cep = $db->escape($_POST['cep']);
    $cnes = $db->escape($_POST['cnes']);


    if(!isset($_POST['update'])) {
        $sql = "INSERT INTO ESTABELECIMENTO VALUES('".$cnes."', '".$razao_social."', '".$cnpj."', '".$cep."', '".$nome_fantasia."');";
    } else {
        $saferg = isset($_POST['update']);
        $sql = "UPDATE ESTABELECIMENTO SET RAZAO_SOCIAL = '".$razao_social."', CNPJ = '".$cnpj."', CEP = '".$cep."', NOME_FANTASIA = '".$nome_fantasia."' WHERE CNES = '".$cnes."';";
    }

    if(mysqli_query($connect, $sql)){
        echo " Cadastro feito com sucesso! ";
        header("Location: ../gerenciador/gerenciar_estabelecimentos.php"); 
    } else {
        echo " Erro ao realizar cadastro! ";
        die();
    }

} else if(isset($_POST['atualizar'])){
    $cnes = $db->escape($_POST['atualizar']);

    $sql = "SELECT * FROM ESTABELECIMENTO WHERE CNES = '".$cnes."';";
    
    $result = mysqli_query($connect, $sql); 

    if($result){
        $dados = mysqli_fetch_array($result);
        $nome_fantasia = $dados['NOME_FANTASIA'];
        $razao_social = $dados['RAZAO_SOCIAL'];
        $cnpj = $dados['CNPJ'];
        $cep = $dados['CEP'];
        $cnes = $dados['CNES'];
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

        <h2>Cadastrar Estabelecimento</h2>

        <form method="POST" action="#">
            <label for="nome_fantasia">Nome fantasia:</label><br>
            <input class="item" type="text" id="nome_fantasia" name="nome_fantasia" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$nome_fantasia.'"' : ''; ?>><br>

            <label for="razao_social">Razão Social:</label><br>
            <input class="item" type="text" id="razao_social" name="razao_social" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$razao_social.'"' : ''; ?>><br>

            <label for="cnpj">CNPJ:</label><br>
            <input class="item" type="text" id="cnpj" name="cnpj" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$cnpj.'"' : ''; ?>><br>

            <label for="cep">CEP:</label><br>
            <input class="item" type="text" id="cep" name="cep" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$cep.'"' : ''; ?>><br>

            <label for="cnes">CNES:</label><br>
            <input class="item" type="text" id="cnes" name="cnes" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$cnes.'"' : ''; ?>><br>

            <div id="containerentrar">
                <input type="submit" value="Enviar" <?php echo (isset($_POST['atualizar'])) ? 'name="update"' : ''; ?>>
            </div>
        </form>

        <div>
            <button onclick="window.location.href='../gerenciador/gerenciar_estabelecimentos.php'">Voltar</button>
        </div>      
    </body>
</html>