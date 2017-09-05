<?php
    error_reporting(E_ALL ^ E_NOTICE); 
    require_once("mostra-alerta.php");
    require_once("conecta.php");

    spl_autoload_register(function($nomeDaClasse) {
        require_once("class/{$nomeDaClasse}.php");
    });

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/minha_loja.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<meta charset="UTF-8">
	<title>Loja</title>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="index.php" class="navbar-brand">Minha Loja</a>
            </div>

               <div>
                <ul class="nav navbar-nav">
                    <li><a href="produto-formulario.php">Adiciona Produto</a></li>
                    <li><a href="produto-lista.php">Produtos</a></li>
                    <li><a href="contato.php">Contato</a></li>
                    <li><a href="sobre.php">Sobre</a></li>
                </ul>
            </div>
        </div><!-- container acaba aqui -->
    </nav>
    <div class="container">
    	<div class="principal">
    	
            <?php 
                mostraAlerta("success");
                mostraAlerta("danger");
            ?>