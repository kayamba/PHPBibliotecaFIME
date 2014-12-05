<?php
require_once dirname(__FILE__).'/../config/conx.php';

$conx = conDB();
$query = "DELETE FROM `comix`.`productos` WHERE `IdProducto`='".$_GET['id']."'";
$conx->query($query);

header("Location: ".$_SERVER['HTTP_REFERER']);

?>
