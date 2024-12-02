<?php

    $servidor = "localhost"; 
	$usuario = "root";
	$senha = "";
	$banco = "BD_LojaEcomerce";
	
	$cn = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

?>

