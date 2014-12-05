<?php
require_once dirname(__FILE__).'/../config/conx.php';
require 'validacion.php';

session_start();
if (isset($_GET['id'])) {
	if ($_SESSION["tipo"] == "Cliente") {
		if (puedeRentar($_GET['id'])) {
			$conx = conDB();
			$query = "INSERT INTO `comix`.`pedidos` (`IdUsuario`, `IdProducto`, `fecha_renta`, `entregado`) VALUES ('".$_SESSION['id']."', '".$_GET['id']."', NOW(), '0')";
			$conx->query($query);
			header("Location: ../requisition.php?id=".$_SESSION[id]);
		}else{
			header("Location: ../list.php?message=No se cuenta con existencia, intente mas tarde.");
		}
	}
	echo "Error, no se puede solicitar un libro si no es cliente";
}

function puedeRentar($id){
	$conx = conDB();
	$query = "SELECT (productos.disponibilidad > (SELECT COUNT(*) AS Rentados FROM `pedidos` WHERE pedidos.entregado = 1 AND IdProducto = $id)) AS Rentar FROM `productos` WHERE IdProducto = $id";
	$result = $conx->query($query);
	$row = $result->fetch_assoc();
	return $row['Rentar'];
}

?>
