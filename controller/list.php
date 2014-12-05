<?php
require_once dirname(__FILE__).'/../config/conx.php';

function getList($tipo="All"){
	$conx = conDB();
	$query = "SELECT * FROM comix.productos";

	if ($tipo == "All") {
		$query = "SELECT * FROM comix.productos";
	}elseif ($tipo == "Existencia") {
		$query = "SELECT * FROM comix.productos WHERE productos.Disponibilidad > 0";
	}else{
		$query = "SELECT * FROM comix.productos WHERE productos.Titulo LIKE '%".$tipo."%';";
	}
	return $conx->query($query);
}

function getSingle($id=0){
	if ($id > 0) {
		$conx = conDB();
		$query = "SELECT * FROM comix.productos WHERE IdProducto = ".$id;
		$result = $conx->query($query);
		while ($row  = $result->fetch_assoc()) {
			return $row;
		}
	}
	return false;
}

?>
