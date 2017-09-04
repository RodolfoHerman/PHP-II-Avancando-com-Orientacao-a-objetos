<?php
require_once("banco-usuario.php");
require_once("logica-usuario.php");

$usuario = buscaUsuario($con, $_POST['email'], $_POST['senha']);

if($usuario == NULL) {
	$_SESSION["danger"] = "Usuário e/ou senha inválido(s)";
	header("Location: index.php");
} else {
	logaUsuario($usuario['email']);
	$_SESSION["success"] = "Logado com sucesso !!";
	header("Location: index.php");
}

die();