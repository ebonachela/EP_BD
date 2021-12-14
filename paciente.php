<?php 

$host = "localhost";
$user = "root";
$password = "";
$db = "vacinacao";

$connect = mysqli_connect($host, $user, $password, $db);

session_start();

if(isset($_SESSION["RG"])){
    echo $_SESSION["RG"];
};

?>

<html>
    <p>Perfil Paciente</p>
    

</html>