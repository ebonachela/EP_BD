<?php

require_once('../api/db.php');

$db = new dbClass();
$connect = $db->conectar();

if(isset($_POST['rg']) && !isset($_POST['atualizar'])){
    $rg = $db->escape($_POST['rg']);
    $nome = $db->escape($_POST['nome']);
    $data = $db->escape($_POST['data']);
    $etnia = $db->escape($_POST['etnia']);
    $genero = $db->escape($_POST['genero']);
    $nacionalidade = $db->escape($_POST['nacionalidade']);
    $cep = $db->escape($_POST['cep']);
    $senha = $db->escape($_POST['senha']);

    if(!isset($_POST['update'])) {
        $sql = "INSERT INTO paciente VALUES('".$rg."', '".$nome."', '".$data."', '".$etnia."', '".$genero."', '".$nacionalidade."', '".$cep."', '".$senha."');";
    } else {
        $sql = "UPDATE paciente SET NOME = '".$nome."', DATA_NASC = '".$data."', ETNIA = '".$etnia."', GENERO = '".$genero."', NACIONALIDADE = '".$nacionalidade."', CEP = '".$cep."', senha = '".$senha."' WHERE RG = '".$rg."'";
    }

    if(mysqli_query($connect, $sql)){
        header("Location: ../gerenciador/gerenciar_pacientes.php"); 
        die();
    } else {
        echo " Erro ao realizar cadastro! ";
        die();
    }

} else if(isset($_POST['atualizar'])){
    $rg = $db->escape($_POST['atualizar']);

    $sql = "select * from paciente where RG = '".$rg."'";
    
    $result = mysqli_query($connect, $sql); 

    if($result){
        $dados = mysqli_fetch_array($result);
        $nome = $dados['NOME'];
        $data = $dados['DATA_NASC'];
        $etnia = $dados['ETNIA'];
        $genero = $dados['GENERO'];
        $nacionalidade = $dados['NACIONALIDADE'];
        $cep = $dados['CEP'];
        $senha = $dados['senha'];
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

        <h2 style="text-align: center; margin-top: 20px">Cadastrar Paciente</h2>
        
        <form method="POST" action="#">
            <label for="rg">RG:</label><br>
            <input class="item" type="text" id="rg" name="rg" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$rg.'"' : ''; ?>><br>

            <label for="nome">Nome Completo:</label><br>
            <input class="item" type="text" id="nome" name="nome" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$nome.'"' : ''; ?>><br>

            <label for="data">Data de Nascimento:</label><br>
            <input class="item" type="text" id="data" name="data" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$data.'"' : ''; ?>><br>

            <label for="etnia">Etnia:</label><br>
            <select class="item" name="etnia" id="etnia" style="width: 170px" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$etnia.'"' : ''; ?>>
                <option value="negro">Negro</option>
                <option value="indigena">Indigena</option>
                <option value="branco">Branco</option>
                <option value="pardo">Pardo</option>
                <option value="outro">Outro</option>
            </select><br>

            <label for="genero">Gênero:</label><br>
            <select class="item" name="genero" id="genero" style="width: 170px" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$genero.'"' : ''; ?>>
                <option value="mulher">Mulher</option>
                <option value="homem">Homem</option>
                <option value="outro">Outro</option>
                <option value="prefiro não dizer">Prefiro não dizer</option>
            </select><br>

            <label for="nacionalidade">Nacionalidade:</label><br>
            <select class="item" name="nacionalidade" id="nacionalidade" style="width: 170px" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$nacionalidade.'"' : ''; ?>>
                <option value="Brasileiro">Brasileiro</option>
                <option value="Estrangeiro">Estrangeiro</option>
            </select><br>

            <label for="cep">CEP:</label><br>
            <input class="item" type="text" id="cep" name="cep" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$cep.'"' : ''; ?>><br>

            <label for="senha">Senha:</label><br>
            <input class="item" type="password" id="senha" name="senha" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$senha.'"' : ''; ?>><br>

            <div id="containerentrar">
                <input id="entrarinput" type="submit" value="Enviar" <?php echo (isset($_POST['atualizar'])) ? 'name="update"' : ''; ?>>
            </div>
        </form>
        
        <div>
            <button onclick="window.location.href='../index.php'">Voltar</button>
        </div>
    </body>
</html>