<?php 

$host = "localhost";
$user = "root";
$password = "";
$db = "vacinacao";

$connect = mysqli_connect($host, $user, $password, $db);

session_start();

if(isset($_SESSION["TIPO"])){
    if($_SESSION["TIPO"] == 'PACIENTE'){
        header("Location: paciente.php"); 
    } else {
        header("Location: funcionario.php"); 
    }

    exit();
};

if(isset($_POST['rg'])){
    
    $uname = $_POST['rg'];
    $password = $_POST['senha'];
    $conta = $_POST['conta'];
    $tipo = null;

    if($conta == 'Paciente'){
        $tipo = 'PACIENTE';
    } else {
        $tipo = 'FUNCIONARIO';
    }
    
    $sql = "select * from ".$tipo." where RG = '".$uname."' AND senha = '".$password."' limit 1";
    
    $result = mysqli_query($connect, $sql);
    
    if(mysqli_num_rows($result)==1){
        $_SESSION["RG"] = $uname;
        $_SESSION["TIPO"] = $tipo;

        echo " Logado com sucesso! ";

        if($conta == 'Paciente'){
            header("Location: paciente.php"); 
        } else {
            header("Location: funcionario.php"); 
        }
        
        exit();
    }
    else{
        echo " Você digitou a senha incorreta. ";
    }
        
}

?>

<html>
    <p>Página de Login</p>
    <form method="POST" action="#">
        <label for="rg">RG:</label><br>
        <input type="text" id="rg" name="rg"><br>
        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha"><br><br>

        <label for="conta">Conta:</label>
        <select name="conta" id="conta" style="width: 122px">
            <option value="Paciente">Paciente</option>
            <option value="Funcionario">Funcionário</option>
        </select><br><br>

        <input type="submit" value="Entrar">
    </form>

    <button onclick="window.location.href='cadastrar.php'">Cadastrar</button>
</html>