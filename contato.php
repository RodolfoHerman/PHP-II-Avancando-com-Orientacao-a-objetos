<?php require_once("cabecalho.php"); ?>
<h2>Formulário</h2>
<form action="envia-contato.php" method="POST">
	<table class="table">
		<tbody>
			<tr>
				<th>Nome: </th>
				<td><input type="text" class="form-control" name="nome"></td>
			</tr>
			<tr>
				<th>E-mail: </th>
				<td><input type="email" class="form-control" name="email"></td>
			</tr>
			<tr>
				<th>Mensagem: </th>
				<td><textarea class="form-control" name="msg"></textarea></td>
			</tr>
		</tbody>
		<tbody>
			<tr>
				<td><button type="submit" class="btn btn-primary">Enviar</button></td>
			</tr>	
		</tbody>	
	</table>
</form>	

<?php require_once("rodape.php"); ?>