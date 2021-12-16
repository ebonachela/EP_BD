<?php 

require_once('./api/db.php');

$db = new dbClass();
$connect = $db->conectar();

session_start();

if(isset($_SESSION["TIPO"])){
    if($_SESSION["TIPO"] == 'PACIENTE'){
        header("Location: ./paginas/paciente.php"); 
    } else {
        header("Location: ./paginas/funcionario.php"); 
    }

    exit();
};

if(isset($_POST['rg'])){
    
    $uname = $db->escape($_POST['rg']);
    $password = $db->escape($_POST['senha']);
    $conta = $db->escape($_POST['conta']);
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
            header("Location: ./paginas/paciente.php"); 
        } else {
            header("Location: ./paginas/funcionario.php"); 
        }
        
        exit();
    }
    else{
        echo " Você digitou a senha incorreta. ";
    }
        
}

?>

<html>
    <style>
        body { 
            text-align: center; 
        }

        .container {
            margin-top: 30px;
        }

        h3 {
            text-align: center;
        }

        #entrarinput {
            text-align: center;
            width: 80px;
        }

        #containerentrar{
            text-align: center;
        }

        button {
            width: 80px;
        }

        form {
            display: inline-block;
            margin-left: auto;
            margin-right: auto;
            text-align: left;
        }

    </style>
    <body>
        <div class="container">
            <h1>Posto de Vacinação</h1>
            <h3>Página de Login</h3>
            <div>
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

                    <div id="containerentrar">
                        <input id="entrarinput" type="submit" value="Entrar">
                    </div>
                </form>
            </div>

            <button onclick="window.location.href='./cadastro/cadastrar.php'">Cadastrar</button>

            <div style="text-align: center;">
                <h3>Grupo:</h3>
                <p>Bruno Henrique de Souza Jeannine Rocha - NUSP: 11207971</p>
                <p>Eduardo Bonachela da Silva - NUSP: 11857278</p>
                <p>Matheus Gireli Conde - NUSP: 10816749</p>
                <p>Vítor Costa Pinheiro - NUSP: 11819132</p>
            </div>
        </div>
    </body>
</html>