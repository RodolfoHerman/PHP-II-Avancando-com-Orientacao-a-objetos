<?php

class CategoriaDao {


	private $con;


	function __construct($con) {
		$this->con = $con;
	}
	

	function listaCategorias() {
		$query = "SELECT * from categorias";
		$resultado = $this->con->query($query);

		$categorias = array();

		while($categoria_array = mysqli_fetch_assoc($resultado)) {

			$categoria = new Categoria();
			$categoria->setId($categoria_array['id']);
			$categoria->setNome($categoria_array['nome']);

			array_push($categorias, $categoria);
		}

		return $categorias;
	}


}

?>