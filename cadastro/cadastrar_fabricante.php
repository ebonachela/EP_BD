<?php

require_once('../api/db.php');

$db = new dbClass();
$connect = $db->conectar();

if(isset($_POST['cnpj']) && !isset($_POST['atualizar'])){
    $nome = $db->escape($_POST['nome']);
    $cnpj = $db->escape($_POST['cnpj']);
    $cep = $db->escape($_POST['cep']);


    if(!isset($_POST['update'])) {
        $sql = "INSERT INTO fabricante VALUES('".$nome."', '".$cnpj."', '".$cep."');";
    } else {
        $saferg = isset($_POST['update']);
        $sql = "UPDATE fabricante SET NOME = '".$nome."', CEP = '".$cep."' WHERE CNPJ = '".$cnpj."';";
    }

    if(mysqli_query($connect, $sql)){
        echo " Cadastro feito com sucesso! ";
        header("Location: ../gerenciador/gerenciar_vacinas.php"); 
    } else {
        echo " Erro ao realizar cadastro! ";
        die();
    }

} else if(isset($_POST['atualizar'])){
    $cnes = $db->escape($_POST['atualizar']);

    $sql = "SELECT * FROM fabricante WHERE CNPJ = '".$cnes."';";
    
    $result = mysqli_query($connect, $sql); 

    if($result){
        $dados = mysqli_fetch_array($result);
        $nome = $dados['NOME'];
        $cnpj = $dados['CNPJ'];
        $cep = $dados['CEP'];
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

        <h2>Cadastrar Fabricante</h2>

        <form method="POST" action="#">
            <label for="nome">Nome:</label><br>
            <input class="item" type="text" id="nome" name="nome" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$nome.'"' : ''; ?>><br>

            <label for="cnpj">CNPJ:</label><br>
            <input class="item" type="text" id="cnpj" name="cnpj" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$cnpj.'"' : ''; ?>><br>

            <label for="cep">CEP:</label><br>
            <input class="item" type="text" id="cep" name="cep" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$cep.'"' : ''; ?>><br>

            <div id="containerentrar">
                <input type="submit" value="Enviar" <?php echo (isset($_POST['atualizar'])) ? 'name="update"' : ''; ?>>
            </div>
        </form>

        <div>
            <button onclick="window.location.href='../gerenciador/gerenciar_vacinas.php'">Voltar</button>
        </div>
    </body>
</html>