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

			$produto_id = $produto_array['id'];
			$nome = $produto_array['nome'];
			$preco = $produto_array['preco'];
			$descricao = $produto_array['descricao'];
			$usado = $produto_array['usado'];
			$tipoProduto = $produto_array['tipoProduto'];

			if($tipoProduto == "Livro") {

				$produto = new Livro($nome, $preco, $descricao, $categoria, $usado);
				$produto->setIsbn($produto_array['isbn']);
			} else {

				$produto = new Produto($nome, $preco, $descricao, $categoria, $usado);
			}
			
			
			$produto->setId($produto_id);

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

		$produto_id = $produto_array['id'];
		$nome = $produto_array['nome'];
		$preco = $produto_array['preco'];
		$descricao = $produto_array['descricao'];
		$usado = $produto_array['usado'];
		$tipoProduto = $produto_array['tipoProduto'];

		if($tipoProduto == "Livro") {

			$produto = new Livro($nome, $preco, $descricao, $categoria, $usado);
			$produto->setIsbn($produto_array['isbn']);
		} else {

			$produto = new Produto($nome, $preco, $descricao, $categoria, $usado);
		}

		$produto->setId($produto_id);

		return $produto;
	}

	function alteraProduto(Produto $produto) {

		$isbn = $produto->temIsbn() ? $produto->getIsbn() : '';

		$tipoProduto = get_class($produto);

		$nome = $this->con->real_escape_string($produto->getNome());
		$preco = $this->con->real_escape_string($produto->getPreco());
		$descricao = $this->con->real_escape_string($produto->getDescricao());
		$isbn = $this->con->real_escape_string($isbn);

		$query = "UPDATE produtos SET nome = '{$nome}', preco = {$preco}, descricao = '{$descricao}', categoria_id = '{$produto->getCategoria()->getId()}', usado = {$produto->getUsado()}, isbn = '{$isbn}', tipoProduto = '{$tipoProduto}' WHERE id = '{$produto->getId()}'";
		return $this->con->query($query);
	}

	function insereProduto(Produto $produto) {

		$isbn = $produto->temIsbn() ? $produto->getIsbn() : '';

		$tipoProduto = get_class($produto);
		
		$nome = $this->con->real_escape_string($produto->getNome());
		$preco = $this->con->real_escape_string($produto->getPreco());
		$descricao = $this->con->real_escape_string($produto->descricao);
		$isbn = $this->con->real_escape_string($isbn);

		$query = "INSERT INTO produtos (nome, preco, descricao, categoria_id, usado, isbn, tipoProduto) VALUES ('{$nome}', {$preco}, '{$descricao}', {$produto->getCategoria()->getId()}, {$produto->getUsado()}, '{$isbn}', '{$tipoProduto}')";
		return $this->con->query($query);
	}

	function removeProduto($id) {
		$query = "DELETE FROM produtos WHERE id = {$id}";
		$this->con->query($query);
	}


}



?>