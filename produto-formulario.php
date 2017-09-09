<?php 
	require_once("logica-usuario.php");
	require_once("cabecalho.php"); 

	verificaUsuario();

	$categoria_nova = new Categoria();
	$categoria_nova->setId(1);

	$categoriaDao = new CategoriaDao($con);

	$produto = new LivroFisico("", "", "", $categoria_nova, "");

?>

<h1>Formulário de cadastro</h1>

<form action="adiciona-produto.php" method="POST">
	
		<?php include("formulario-produto-base.php"); ?>

		<tr>
			<td><input type="submit" class="btn btn-primary" value="Cadastrar" /></td>
		</tr>
	</table>
</form>


<?php require_once("rodape.php"); ?>