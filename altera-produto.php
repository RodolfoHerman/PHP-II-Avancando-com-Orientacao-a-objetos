<?php
	require_once("cabecalho.php");

	$categoria = new Categoria();

	$categoria->setId($_POST['categoria_id']);

	$nome = $_POST['nome'];
	$preco = $_POST['preco'];
	$descricao = $_POST['descricao'];
	$usado = array_key_exists('usado', $_POST) ? 'true' : 'false';
	$isbn = $_POST['isbn'];
	$tipoProduto = $_POST['tipoProduto'];

	if($tipoProduto == "Livro") {

		$produto = new Livro($nome, $preco, $descricao, $categoria, $usado);
		$produto->setIsbn($isbn);
	} else {

		$produto = new Produto($nome, $preco, $descricao, $categoria, $usado);
	}
	
	$produto->setId($_POST['id']);

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