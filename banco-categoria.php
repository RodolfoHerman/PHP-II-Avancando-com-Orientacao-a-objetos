<?php
require_once("conecta.php");
require_once("class/Categoria.php");

function listaCategorias($con) {
	$query = "SELECT * from categorias";
	$resultado = $con->query($query);

	$categorias = array();

	while($categoria_array = mysqli_fetch_assoc($resultado)) {

		$categoria = new Categoria();
		$categoria->setId($categoria_array['id']);
		$categoria->setNome($categoria_array['nome']);

		array_push($categorias, $categoria);
	}

	return $categorias;
}