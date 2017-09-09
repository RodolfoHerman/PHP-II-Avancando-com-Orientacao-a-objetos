<?php
	require_once("cabecalho.php");

	$categoria_id = $_POST['categoria_id'];
	$produto_id = $_POST['id'];
	$tipoProduto = $_POST['tipoProduto'];
	$usado = array_key_exists('usado', $_POST) ? 'true' : 'false';

	$factory = new ProdutoFactory();

	$produto = $factory->criaPor($tipoProduto, $_POST);
	$produto->atualizaBaseadoEm($_POST);
	$produto->getCategoria()->setId($categoria_id);
	$produto->setId($produto_id);
	$produto->setUsado($usado);

	$produtoDao = new ProdutoDao($con);
?>

<?php if($produtoDao->alteraProduto($produto)): ?>
	<p class="text-success">
		Produto <?php echo $produto->getNome(); ?> com o valor de R$<?php echo $produto->getPreco(); ?> alterado com sucesso !!
	</p>	
<?php else: ?>
	<p class="text-danger">
		Produto <?php echo $produto->getNome(); ?> com o valor de R$<?php echo $produto->getPreco(); ?> não foi alterado. Erro: <?php echo $con->error; ?>
	</p>
<?php endif; ?>


<?php $con->close(); ?>
<?php require_once("rodape.php"); ?>