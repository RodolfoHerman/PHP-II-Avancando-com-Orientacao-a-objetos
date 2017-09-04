<?php
require_once("conecta.php");

function listaProdutos($con) {

	$query = "SELECT p.*, c.nome as categoria_nome FROM produtos p JOIN categorias c ON p.categoria_id = c.id";

	$resultado = $con->query($query);
	
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

function buscaProduto($con, $id) {
	$query = "SELECT * FROM produtos WHERE id = {$id}";
	$resultado = $con->query($query);

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

function alteraProduto($con, Produto $produto) {

	$nome = $con->real_escape_string($produto->getNome());
	$preco = $con->real_escape_string($produto->getPreco());
	$descricao = $con->real_escape_string($produto->getDescricao());

	$query = "UPDATE produtos SET nome = '{$nome}', preco = {$preco}, descricao = '{$descricao}', categoria_id = '{$produto->getCategoria()->getId()}', usado = {$produto->getUsado()} WHERE id = '{$produto->getId()}'";
	return $con->query($query);
}

function insereProduto($con, Produto $produto) {
	
	$nome = $con->real_escape_string($produto->getNome());
	$preco = $con->real_escape_string($produto->getPreco());
	$descricao = $con->real_escape_string($produto->descricao);

	$query = "INSERT INTO produtos (nome, preco, descricao, categoria_id, usado) VALUES ('{$nome}', {$preco}, '{$descricao}', {$produto->getCategoria()->getId()}, {$produto->getUsado()})";
	return $con->query($query);
}

function removeProduto($con, $id) {
	$query = "DELETE FROM produtos WHERE id = {$id}";
	$con->query($query);
}