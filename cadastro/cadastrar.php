<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "vacinacao";

$connect = mysqli_connect($host, $user, $password, $db);

if(isset($_POST['rg']) && !isset($_POST['atualizar'])){
    $rg = $_POST['rg'];
    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $etnia = $_POST['etnia'];
    $genero = $_POST['genero'];
    $nacionalidade = $_POST['nacionalidade'];
    $cep = $_POST['cep'];
    $senha = $_POST['senha'];

    if(!isset($_POST['update'])) {
        $sql = "INSERT INTO PACIENTE VALUES('".$rg."', '".$nome."', '".$data."', '".$etnia."', '".$genero."', '".$nacionalidade."', '".$cep."', '".$senha."');";
    } else {
        $sql = "UPDATE PACIENTE SET NOME = '".$nome."', DATA_NASC = '".$data."', ETNIA = '".$etnia."', GENERO = '".$genero."', NACIONALIDADE = '".$nacionalidade."', CEP = '".$cep."', senha = '".$senha."' WHERE RG = '".$rg."'";
    }

    if(mysqli_query($connect, $sql)){
        echo " Cadastro feito com sucesso! ";
        header("Location: ../gerenciador/gerenciar_pacientes.php"); 
        die();
    } else {
        echo " Erro ao realizar cadastro! ";
        die();
    }

} else if(isset($_POST['atualizar'])){
    $rg = $_POST['atualizar'];

    $sql = "select * from PACIENTE where RG = '".$rg."'";
    
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
    <body>

        <p>Cadastrar Paciente</p>

        <form method="POST" action="#">
            <label for="rg">RG:</label><br>
            <input type="text" id="rg" name="rg" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$rg.'"' : ''; ?>><br>

            <label for="nome">Nome Completo:</label><br>
            <input type="text" id="nome" name="nome" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$nome.'"' : ''; ?>><br>

            <label for="data">Data de Nascimento:</label><br>
            <input type="text" id="data" name="data" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$data.'"' : ''; ?>><br>

            <label for="etnia">Etnia:</label><br>
            <select name="etnia" id="etnia" style="width: 170px" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$etnia.'"' : ''; ?>>
                <option value="negro">Negro</option>
                <option value="indigena">Indigena</option>
                <option value="branco">Branco</option>
                <option value="pardo">Pardo</option>
                <option value="outro">Outro</option>
            </select><br>

            <label for="genero">Gênero:</label><br>
            <select name="genero" id="genero" style="width: 170px" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$genero.'"' : ''; ?>>
                <option value="mulher">Mulher</option>
                <option value="homem">Homem</option>
                <option value="outro">Outro</option>
                <option value="prefiro não dizer">Prefiro não dizer</option>
            </select><br>

            <label for="nacionalidade">Nacionalidade:</label><br>
            <select name="nacionalidade" id="nacionalidade" style="width: 170px" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$nacionalidade.'"' : ''; ?>>
                <option value="Brasileiro">Brasileiro</option>
                <option value="Estrangeiro">Estrangeiro</option>
            </select><br>

            <label for="cep">CEP:</label><br>
            <input type="text" id="cep" name="cep" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$cep.'"' : ''; ?>><br>

            <label for="senha">Senha:</label><br>
            <input type="password" id="senha" name="senha" <?php echo (isset($_POST['atualizar'])) ? 'value="'.$senha.'"' : ''; ?>><br>

            <input type="submit" value="Enviar" <?php echo (isset($_POST['atualizar'])) ? 'name="update"' : ''; ?>>
        </form>

        <button onclick="window.location.href='../index.php'">Voltar</button>
    </body>
</html>