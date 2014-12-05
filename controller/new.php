<?php
require dirname(__FILE__).'/../config/conx.php';
require 'validacion.php';
$conx = conDB();

$photo_name = saveImage($_FILES['image']);

if (noNegativo($_POST['cantidad']) AND $photo_name != "") {
	$query = "INSERT INTO `comix`.`productos` (`Titulo`, `Tipo`, `Editorial`, `Autor`, `Disponibilidad`, `Descripcion`, `URL`) VALUES ('".$_POST['titulo']."', '".$_POST['tipo']."', '".$_POST['editorial']."', '".$_POST['autor']."', '".$_POST['cantidad']."', '".$_POST['descripcion']."', '".$photo_name."')";
	$conx->query($query);
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
echo "Error :c".$photo_name;
?>
