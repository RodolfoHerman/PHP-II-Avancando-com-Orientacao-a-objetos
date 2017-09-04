<?php
require_once("conecta.php");

function buscaUsuario($con, $email, $senha) {

	$senhaMD5 = md5($senha);

	$email = $con->real_escape_string($email);

	$query = "SELECT * FROM usuarios WHERE email = '{$email}' AND senha = '{$senhaMD5}'";

	$resultado = $con->query($query);

	return mysqli_fetch_assoc($resultado);
}