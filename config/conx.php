<?php
function conDB(){
	$conn = new mysqli('127.0.0.1','root', 'daimonoz', 'comix');
	if(mysqli_connect_errno()){
		echo "Error al establecer la conexion a la base de datos: ".mysqli_connect_error();
		exit();
	}
	return $conn;
}
?>
