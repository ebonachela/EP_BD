<?php

require_once('../api/db.php');

$db = new dbClass();
$connect = $db->conectar();

if(isset($_POST['rg']) && !isset($_POST['atualizar'])){
    $rg = $db->escape($_POST['rg']);
    $nome = $db->escape($_POST['nome']);
    $data = $db->escape($_POST['data']);
    $hora = $db->escape($_POST['hora']);
    $salario = $db->escape($_POST['salario']);
    $cep = $db->escape($_POST['cep']);
    $cnes = $db->escape($_POST['cnes']);
    $dependente = $db->escape($_POST['dependente']);
    $rg_dependente = $db->escape($_POST['rg_dependente']);
    $parentesco = $db->escape($_POST['parentesco']);
    $senha = $db->escape($_POST['senha']);

    if(!isset($_POST['update'])) {
        $sql = "INSERT INTO funcionario VALUES('".$rg."', '".$nome."', '".$data."', '".$hora."', '".$salario."', '".$cep."', '".$cnes."', '".$senha."');";
        $sql2 = "INSERT INTO dependente VALUES('".$rg_dependente."', '".$dependente."', '".$parentesco."');";
    } else {
        $saferg = isset($_POST['update']);
        $sql = "UPDATE funcionario SET NOME = '".$nome."', DATA_NASC = '".$data."', HORA_INICIO = '".$hora."', SALARIO = '".$salario."', CEP = '".$cep."', CNES_ESTABELEC = '".$cnes."', SENHA = '".$senha."' WHERE RG = '".$rg."';";
        $sql2 = "UPDATE dependente SET RG = '".$rg_dependente."', NOME = '".$dependente."', PARENTESCO = '".$parentesco."' WHERE RG_FUNCIONARIO = '".$rg."';";
    }

    if(mysqli_query($connect, $sql) && mysqli_query($connect, $sql2)){
        echo " Cadastro feito com sucesso! ";
        header("Location: ../gerenciador/gerenciar_funcionarios.php"); 
    } else {
        echo " Erro ao realizar cadastro! ";
        die();
    }

} else if(isset($_POST['atualizar'])){
    $rg = $db->escape($_POST['atualizar']);

    $sql = "SELECT funcionario.RG, funcionario.NOME, funcionario.DATA_NASC, funcionario.HORA_INICIO, funcionario.SALARIO, funcionario.CEP, funcionario.CNES_ESTABELEC, funcionario.SENHA, dependente.RG as RG_DEPENDENTE, dependente.NOME as NOME_DEPENDENTE, dependente.PARENTESCO FROM funcionario INNER JOIN dependente ON dependente.RG_FUNCIONARIO = funcionario.rg WHERE funcionario.RG = '".$rg."'";
    
    $result = mysqli_query($connect, $sql); 

    if($result){
        $dados = mysqli_fetch_array($result);
        $nome = $dados['NOME'];
        $data = $dados['DATA_NASC'];
        $hora = $dados['HORA_INICIO'];
        $salario = $dados['SALARIO'];
        $cep = $dados['CEP'];
        $cnes = $dados['CNES_ESTABELEC'];

        $dependente = $dados['NOME_DEPENDENTE'];
        $rg_dependente = $dados['RG_DEPENDENTE'];
        $parentesco = $dados['PARENTESCO'];

        $senha = $dados['SENHA'];
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

        <h2>Cadastrar Funcionário</h2>

        <form method="POST" action="#">
            <label for="rg">RG:</label><br>
            <input class="item" type="text" id="rg" name="rg" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$rg.'"' : ''; ?>><br>

            <label for="nome">Nome Completo:</label><br>
            <input class="item" type="text" id="nome" name="nome" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$nome.'"' : ''; ?>><br>

            <label for="data">Data de Nascimento:</label><br>
            <input class="item" type="text" id="data" name="data" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$data.'"' : ''; ?>><br>

            <label for="hora">Hora de Início:</label><br>
            <input class="item" type="text" id="hora" name="hora" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$hora.'"' : ''; ?>><br>

            <label for="salario">Salário:</label><br>
            <input class="item" type="text" id="salario" name="salario" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$salario.'"' : ''; ?>><br>

            <label for="cep">CEP:</label><br>
            <input class="item" type="text" id="cep" name="cep" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$cep.'"' : ''; ?>><br>

            <label for="cnes">CNES de onde trabalha:</label><br>
            <input class="item" type="text" id="cnes" name="cnes" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$cnes.'"' : ''; ?>><br>

            <label for="dependente">Nome Dependente:</label><br>
            <input class="item" type="text" id="dependente" name="dependente" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$dependente.'"' : ''; ?>><br>

            <label for="rg_dependente">RG do Dependente:</label><br>
            <input class="item" type="text" id="rg_dependente" name="rg_dependente" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$rg_dependente.'"' : ''; ?>><br>

            <label for="parentesco">Parentesco do Dependente:</label><br>
            <input class="item" type="text" id="parentesco" name="parentesco" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$parentesco.'"' : ''; ?>><br>

            <label for="senha">Senha:</label><br>
            <input class="item" type="password" id="senha" name="senha" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$senha.'"' : ''; ?>><br>

            <div id="containerentrar">
                <input type="submit" value="Enviar" <?php echo (isset($_POST['atualizar'])) ? 'name="update"' : ''; ?>>
            </div>
        </form>
        
        <div>
            <button onclick="window.location.href='../gerenciador/gerenciar_funcionarios.php'">Voltar</button>
        </div>
    </body>
</html>