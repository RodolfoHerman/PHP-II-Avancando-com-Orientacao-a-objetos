<?php
	require_once("logica-usuario.php");
	require_once("cabecalho.php");

	verificaUsuario();	

	$tipoProduto = $_POST['tipoProduto'];
	$categoria_id = $_POST['categoria_id'];
	$usado = array_key_exists('usado', $_POST) ? 'true' : 'false';	

	$factory = new ProdutoFactory();
	
	$produto = $factory->criaPor($tipoProduto, $_POST);
	$produto->atualizaBaseadoEm($_POST);
	$produto->getCategoria()->setId($categoria_id);
	$produto->setUsado($usado);

	$produtoDao = new ProdutoDao($con);
?>

<?php if($produtoDao->insereProduto($produto)): ?>
	<p class="text-success">
		Produto <?php echo $produto->getNome(); ?> com o valor de R$<?php echo $produto->getPreco(); ?> adicionado com sucesso !!
	</p>	
<?php else: ?>
	<p class="text-danger">
		Produto <?php echo $produto->getNome(); ?> com o valor de R$<?php echo $produto->getPreco(); ?> não foi adicionado. Erro: <?php echo $con->error; ?>
	</p>
<?php endif; ?>


<?php $con->close(); ?>
<?php require_once("rodape.php"); ?>