<?php
require_once dirname(__FILE__).'/../config/conx.php';
require 'validacion.php';

session_start();
if (isset($_GET['id'])) {
  if (isset($_SESSION["tipo"])) {
    $conx = conDB();
    $query = "UPDATE `comix`.`pedidos` SET `fecha_renta`=NOW(), `entregado`='2' WHERE `IdPedido`='".$_GET["id"]."'";
    $conx->query($query);
    echo $query;
    header("Location: ".$_SERVER["HTTP_REFERER"]);
  }
  echo "Error, no se puede solicitar un libro si no es cliente";
}

?>
