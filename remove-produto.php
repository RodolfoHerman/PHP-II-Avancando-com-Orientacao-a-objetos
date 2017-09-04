<?php 
	require_once("banco-produto.php");
	require_once("logica-usuario.php");
	require_once("cabecalho.php");

	$id = $_POST['id'];

	removeProduto($con, $id);

	$_SESSION["success"] = "Produto {$id} removido !";
	header("Location: produto-lista.php");
	die();
?>

<?php require_once("rodape.php"); ?>