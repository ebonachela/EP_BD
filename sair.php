<?php 

session_start();
unset($_SESSION["RG"]);
session_destroy();

header("Location: index.php"); 

?>