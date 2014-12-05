<?php
require_once dirname(__FILE__).'/../config/conx.php';
require_once 'validacion.php';

session_start();
$_SESSION = array();
session_destroy();
header("Location: ../");
?>
