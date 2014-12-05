<?php
require_once dirname(__FILE__).'/../config/conx.php';
require 'validacion.php';
$conx = conDB();

$photo_name = saveImage($_FILES['image']);
$query = "";

if (noNegativo($_POST['cantidad'])) {
	if ($photo_name == "") {
		$query = "UPDATE `comix`.`productos` SET `Titulo`='".$_POST['titulo']."', `Tipo`='".$_POST['tipo']."', `Editorial`='".$_POST['editorial']."', `Autor`='".$_POST['autor']."', `Disponibilidad`='".$_POST['cantidad']."', `Descripcion`='".$_POST['descripcion']."' WHERE `IdProducto`='".$_POST['IdProducto']."'";
	}else{
		$query = "UPDATE `comix`.`productos` SET `Titulo`='".$_POST['titulo']."', `Tipo`='".$_POST['tipo']."', `Editorial`='".$_POST['editorial']."', `Autor`='".$_POST['autor']."', `Disponibilidad`='".$_POST['cantidad']."', `Descripcion`='".$_POST['descripcion']."' `URL`='".$photo_name."' WHERE `IdProducto`='".$_POST['IdProducto']."'";
	}
	$conx->query($query);
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
echo "Error :c".$photo_name;

?>
