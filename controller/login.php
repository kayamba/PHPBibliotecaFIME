<?php
require_once dirname(__FILE__).'/../config/conx.php';
require_once 'validacion.php';

session_start();

$_SESSION = is_user($_POST['nick'], $_POST['password']);
echo $_SESSION;
if ($_SESSION) {
	header("Location: ../");
}else{
	echo "<a href='".$_SERVER['HTTP_REFERER']."'>Password Incorrecto</a>";
}
?>
