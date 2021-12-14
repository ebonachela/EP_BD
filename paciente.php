<?php 

$host = "localhost";
$user = "root";
$password = "";
$db = "vacinacao";

$connect = mysqli_connect($host, $user, $password, $db);

session_start();

?>

<html>
    <p>Perfil Paciente</p>
    
    <?php 
        $sql = "select * from PACIENTE where RG = '".$_SESSION['RG']."'";
    
        $result = mysqli_query($connect, $sql);

        if($result){
            $dados = mysqli_fetch_array($result);
            echo $dados['NOME'] . '<br>';
            echo $dados['RG'] . '<br>';
            echo $dados['DATA_NASC'] . '<br>';
            echo $dados['ETNIA'] . '<br>';
            echo $dados['GENERO'] . '<br>';
            echo $dados['NACIONALIDADE'] . '<br>';
            echo $dados['CEP'] . '<br>';
        }
    ?>

    <button onclick="window.location.href='sair.php'">Sair</button>

</html>