<?php 
	require_once("logica-usuario.php");
	require_once("cabecalho.php");

	$id = $_POST['id'];

	$produtoDao = new ProdutoDao($con);

	$produtoDao->removeProduto($id);

	$_SESSION["success"] = "Produto {$id} removido !";
	header("Location: produto-lista.php");
	die();
?>

<?php require_once("rodape.php"); ?>