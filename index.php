<?php 

$host = "localhost";
$user = "root";
$password = "";
$db = "vacinacao";

$connect = mysqli_connect($host, $user, $password, $db);

session_start();

if(isset($_SESSION["RG"])){
    header("Location: paciente.php"); 
    exit();
};

if(isset($_POST['rg'])){
    
    $uname = $_POST['rg'];
    $password = $_POST['senha'];
    
    $sql = "select * from PACIENTE where RG = '".$uname."' AND senha = '".$password."' limit 1";
    
    $result = mysqli_query($connect, $sql);
    
    if(mysqli_num_rows($result)==1){
        $_SESSION["RG"] = $uname;

        echo " Logado com sucesso! ";
        header("Location: paciente.php"); 
        exit();
    }
    else{
        echo " Você digitou a senha incorreta. ";
        exit();
    }
        
}

?>

<html>
    <p>Paciente</p>
    <form method="POST" action="#">
        <label for="rg">RG:</label><br>
        <input type="text" id="rg" name="rg"><br>
        <label for="senha">Senha:</label><br>
        <input type="text" id="senha" name="senha"><br>
        <input type="submit" value="Entrar">
    </form>

    <button onclick="window.location.href='cadastrar.php'">Cadastrar</button>
</html>