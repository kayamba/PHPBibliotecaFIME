<?php
require_once dirname(__FILE__).'/../config/conx.php';
require_once 'validacion.php';

$pass = password($_POST['password'], $_POST['re-password']);
if (isset($_POST["tipo"])) {
	$tipo = ($_POST["tipo"] == "Admin")? "Admin":"Cliente";
}else{
	$tipo = "Cliente";
}
if ($pass) {
	$conx = conDB();
	$query = "SELECT * FROM comix.usuarios WHERE Nick = '".$_POST['nick']."'";
	$result = $conx->query($query);
	if($result->num_rows < 1){
		$sql = "INSERT INTO `comix`.`usuarios` (`Nick`, `Pass`, `Tipo`) VALUES ('".$_POST['nick']."', '$pass', '$tipo')";
		// $query = "INSERT INTO `comix`.`usuarios` (`Nick`, `Pass`) VALUES ('".$_POST['nick']."', '$pass')";

		$conx->query($sql);
		echo "<a href='../index.php'>Usuario registrado correctamente</a>";
	}else{echo "<a href='".$_SERVER['HTTP_REFERER']."'>Usuario registrado anteriormente, intenta otro nick name</a>";}
}else{
	echo "<a href='".$_SERVER['HTTP_REFERER']."'>Password Incorrecto</a>";
}


?>
