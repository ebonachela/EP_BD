<?php 

session_start();
unset($_SESSION["RG"]);
unset($_SESSION["TIPO"]);
session_destroy();

header("Location: index.php"); 

?>