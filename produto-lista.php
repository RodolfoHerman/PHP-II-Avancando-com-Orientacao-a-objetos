<?php 
	require_once("cabecalho.php");

	$produtoDao = new ProdutoDao($con);
?>

<table class="table table-striped table-hover table-bordered">
	<?php foreach($produtoDao->listaProdutos() as $produto): ?>
		<tr>
			<td><?php echo $produto->getNome(); ?></td>
			<td><?php echo $produto->getPreco(); ?></td>
			<td><?php echo $produto->calculaImposto(); ?></td>
			<td><?php echo substr($produto->getDescricao(), 0, 40); ?></td>
			<td><?php echo $produto->getUsado() ? 'usado' : 'novo' ?></td>
			<td><?php echo $produto->getCategoria()->getNome(); ?></td>
			<td><?php echo $produto->temIsbn() ? "(ISBN) : " . $produto->getIsbn() : ''; ?></td>
			<td><a class="btn btn-primary" href="produto-altera-formulario.php?id=<?php echo $produto->getId(); ?>">Alterar</a></td>
			<td>
				<form action="remove-produto.php" method="POST">
					<input type="hidden" name="id" value="<?php echo $produto->getId(); ?>">
					<button type="submit" class="btn btn-danger">Remover</button>
				</form>
			</td>
		</tr>
	<?php endforeach; ?>
</table>


<?php require_once("rodape.php"); ?>