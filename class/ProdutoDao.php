<?php

class ProdutoDao {

	private $con;

	function __construct($con) {
		$this->con = $con;
	}

	function listaProdutos() {

		$query = "SELECT p.*, c.nome as categoria_nome FROM produtos p JOIN categorias c ON p.categoria_id = c.id";

		$resultado = $this->con->query($query);
		
		$produtos = array();

		while($produto_array = mysqli_fetch_assoc($resultado)) {

			$produto_id = $produto_array['id'];
		
			$tipoProduto = $produto_array['tipoProduto'];

			$factory = new ProdutoFactory();
			
			$produto = $factory->criaPor($tipoProduto, $produto_array);	
			$produto->setId($produto_id);
			$produto->atualizaBaseadoEm($produto_array);
			$produto->getCategoria()->setId($produto_array['categoria_id']);
			$produto->getCategoria()->setNome($produto_array['categoria_nome']);

			array_push($produtos, $produto);
		}

		return $produtos;
	}

	function buscaProduto($id) {
		$query = "SELECT * FROM produtos WHERE id = {$id}";
		$resultado = $this->con->query($query);

		$produto_array = mysqli_fetch_assoc($resultado);

		$categoria_id = $produto_array['categoria_id'];
		$produto_id = $produto_array['id'];
		$tipoProduto = $produto_array['tipoProduto'];

		$factory = new ProdutoFactory();
		$produto = $factory->criaPor($tipoProduto, $produto_array);
		$produto->atualizaBaseadoEm($produto_array);

		$produto->getCategoria()->setId($categoria_id);
		$produto->setId($produto_id);

		return $produto;
	}

	function alteraProduto(Produto $produto) {

		$isbn = $produto->temIsbn() ? $produto->getIsbn() : '';
		$taxaImpressao = $produto->temTaxaImpressao() ? $produto->getTaxaImpressao() : '';
		$waterMark = $produto->temWaterMark() ? $produto->getWaterMark() : '';

		$tipoProduto = get_class($produto);

		$nome = $this->con->real_escape_string($produto->getNome());
		$preco = $this->con->real_escape_string($produto->getPreco());
		$descricao = $this->con->real_escape_string($produto->descricao);
		$isbn = $this->con->real_escape_string($isbn);
		$taxaImpressao = $this->con->real_escape_string($taxaImpressao);
		$waterMark = $this->con->real_escape_string($waterMark);

		$query = "UPDATE produtos SET nome = '{$nome}', preco = {$preco}, descricao = '{$descricao}', categoria_id = '{$produto->getCategoria()->getId()}', usado = {$produto->getUsado()}, isbn = '{$isbn}', tipoProduto = '{$tipoProduto}', taxaImpressao = '{$taxaImpressao}', waterMark = '{$waterMark}' WHERE id = '{$produto->getId()}'";
		return $this->con->query($query);
	}

	function insereProduto(Produto $produto) {

		$isbn = $produto->temIsbn() ? $produto->getIsbn() : '';
		$taxaImpressao = $produto->temTaxaImpressao() ? $produto->getTaxaImpressao() : '';
		$waterMark = $produto->temWaterMark() ? $produto->getWaterMark() : '';

		$tipoProduto = get_class($produto);
		
		$nome = $this->con->real_escape_string($produto->getNome());
		$preco = $this->con->real_escape_string($produto->getPreco());
		$descricao = $this->con->real_escape_string($produto->descricao);
		$isbn = $this->con->real_escape_string($isbn);
		$taxaImpressao = $this->con->real_escape_string($taxaImpressao);
		$waterMark = $this->con->real_escape_string($waterMark);

		$query = "INSERT INTO produtos (nome, preco, descricao, categoria_id, usado, isbn, tipoProduto, taxaImpressao, waterMark) VALUES ('{$nome}', {$preco}, '{$descricao}', {$produto->getCategoria()->getId()}, {$produto->getUsado()}, '{$isbn}', '{$tipoProduto}', '{$taxaImpressao}', '{$waterMark}')";
		return $this->con->query($query);
	}

	function removeProduto($id) {
		$query = "DELETE FROM produtos WHERE id = {$id}";
		$this->con->query($query);
	}


}



?>