<?php 
	require_once("cabecalho.php"); 

	$id = $_GET['id'];

	$produtoDao = new ProdutoDao($con);
	$categoriaDao = new CategoriaDao($con);

	$produto = $produtoDao->buscaProduto($id);
?>

<h1>Alterar Produto</h1>

<form action="altera-produto.php" method="POST">

	<input type="hidden" name="id" value="<?php echo $id; ?>">

		<?php include("formulario-produto-base.php"); ?>

		<tr>
			<td><input type="submit" class="btn btn-primary" value="Alterar" /></td>
		</tr>
	</table>
</form>


<?php require_once("rodape.php"); ?>