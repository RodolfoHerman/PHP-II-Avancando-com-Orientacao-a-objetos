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
			
			$categoria = new Categoria();

			$categoria->setId($produto_array['categoria_id']);
			$categoria->setNome($produto_array['categoria_nome']);

			$nome = $produto_array['nome'];
			$preco = $produto_array['preco'];
			$descricao = $produto_array['descricao'];
			$usado = $produto_array['usado'];

			$produto = new Produto($nome, $preco, $descricao, $categoria, $usado);
			
			$produto->setId($produto_array['id']);

			array_push($produtos, $produto);
		}

		return $produtos;
	}

	function buscaProduto($id) {
		$query = "SELECT * FROM produtos WHERE id = {$id}";
		$resultado = $this->con->query($query);

		$produto_array = mysqli_fetch_assoc($resultado);

		$categoria = new Categoria();

		$categoria->setId($produto_array['categoria_id']);

		$nome = $produto_array['nome'];
		$preco = $produto_array['preco'];
		$descricao = $produto_array['descricao'];
		$usado = $produto_array['usado'];

		$produto = new Produto($nome, $preco, $descricao, $categoria, $usado);
		
		$produto->setId($produto_array['id']);

		return $produto;
	}

	function alteraProduto(Produto $produto) {

		$nome = $this->con->real_escape_string($produto->getNome());
		$preco = $this->con->real_escape_string($produto->getPreco());
		$descricao = $this->con->real_escape_string($produto->getDescricao());

		$query = "UPDATE produtos SET nome = '{$nome}', preco = {$preco}, descricao = '{$descricao}', categoria_id = '{$produto->getCategoria()->getId()}', usado = {$produto->getUsado()} WHERE id = '{$produto->getId()}'";
		return $this->con->query($query);
	}

	function insereProduto(Produto $produto) {
		
		$nome = $this->con->real_escape_string($produto->getNome());
		$preco = $this->con->real_escape_string($produto->getPreco());
		$descricao = $this->con->real_escape_string($produto->descricao);

		$query = "INSERT INTO produtos (nome, preco, descricao, categoria_id, usado) VALUES ('{$nome}', {$preco}, '{$descricao}', {$produto->getCategoria()->getId()}, {$produto->getUsado()})";
		return $this->con->query($query);
	}

	function removeProduto($id) {
		$query = "DELETE FROM produtos WHERE id = {$id}";
		$this->con->query($query);
	}


}



?>