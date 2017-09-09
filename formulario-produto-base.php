<table class="table">
	<tr>
		<th>Nome: </th>
		<td><input class="form-control" type="text" name="nome" value="<?php echo $produto->getNome(); ?>" /></td>
	</tr>
	<tr>
		<th>Preço: </th>
		<td><input class="form-control" type="number" name="preco" value="<?php echo $produto->getPreco(); ?>" /></td>
	</tr>
	<tr>
		<th>Descrição: </th>
		<td><textarea class="form-control" name="descricao"><?php echo $produto->getDescricao(); ?></textarea></td>
	</tr>
	<tr>
		<th></th>
		<td style="text-align: left;"><input type="checkbox" name="usado" <?php echo $produto->getUsado() ? 'checked' : ''; ?> /> Usado</td>
	</tr>
	<tr>
		<th>Categoria: </th>
		<td>
			<select class="form-control" name="categoria_id">
				<?php foreach($categoriaDao->listaCategorias() as $categoria): ?>
					<?php $selecao = $categoria->getId() == $produto->getCategoria()->getId() ? 'selected' : ''; ?>
					<option value="<?php echo $categoria->getId(); ?>" <?php echo $selecao; ?>><?php echo $categoria->getNome(); ?></option>
				<?php endforeach; ?>
			</select>
		</td>
	</tr>
	<tr>
		<th>Tipo produto: </th>
		<td>
			<select class="form-control" name="tipoProduto">
				<?php $tipoProdutos = ["Produto", "Livro Fisico", "Ebook"];?>
				<?php foreach($tipoProdutos as $tipo): ?>
					<?php 
						$tipoSemEspaco = str_replace(" ", "", $tipo);
						$selecao = $tipoSemEspaco == get_class($produto) ? 'selected' : ''; 
					?>
					<?php if($tipo == "Livro Fisico"): ?>
						<optgroup label="Livros">
					<?php endif; ?>

					<option value="<?php echo $tipoSemEspaco; ?>" <?php echo $selecao; ?>><?php echo $tipo; ?></option>

					<?php if($tipo == "Ebook"): ?>
						</optgroup>
					<?php endif; ?>

				<?php endforeach; ?>
			</select>
		</td>	
	</tr>
	<tr>
		<th>ISBN (caso seja um Livro): </th>
		<td><input type="text" name="isbn" class="form-control" value="<?php echo $produto->temIsbn() ? $produto->getIsbn() : ''; ?>"></td>
	</tr>
	<tr>
		<th>Taxa de Impressão (caso seja um Livro Fisico): </th>
		<td><input type="text" name="taxaImpressao" class="form-control" value="<?php echo $produto->temTaxaImpressao() ? $produto->getTaxaImpressao() : ''; ?>"></td>
	</tr>
	<tr>
		<th>WaterMark (caso seja um Ebook): </th>
		<td><input type="text" name="waterMark" class="form-control" value="<?php echo $produto->temWaterMark() ? $produto->getWaterMark() : ''; ?>"></td>
	</tr>
