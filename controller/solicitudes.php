<?php
require_once dirname(__FILE__).'/../config/conx.php';
require 'validacion.php';

function getListRequisition($value){
  $conx = conDB();
  $sql = "SELECT * FROM comix.pedidos INNER JOIN comix.productos ON (pedidos.IdProducto = productos.IdProducto) WHERE pedidos.IdUsuario = '$value' AND pedidos.entregado = '0'";
  return $conx->query($sql);
}

function getAllRequisition()
{
  $conx = conDB();
  $sql = "SELECT usuarios.IdUsuario, usuarios.Nick,(SELECT count(pedidos.IdPedido) as Solicitudes FROM comix.pedidos WHERE pedidos.IdUsuario = usuarios.IdUsuario AND pedidos.entregado = 0) as Solicitudes From comix.usuarios "."WHERE (SELECT count(pedidos.IdPedido) as Solicitudes FROM comix.pedidos WHERE pedidos.IdUsuario = usuarios.IdUsuario AND pedidos.entregado = '0') > 0";
  return $conx->query($sql);
}

function getListRentados($value){
  $conx = conDB();
  $sql = "SELECT *, datediff(NOW(), pedidos.fecha_renta) as diasr FROM comix.pedidos INNER JOIN comix.productos ON (pedidos.IdProducto = productos.IdProducto) WHERE pedidos.IdUsuario = '$value' AND pedidos.entregado = '1'";
  return $conx->query($sql);
}

function getAllRentados()
{
  $conx = conDB();
  $sql = "SELECT usuarios.IdUsuario, usuarios.Nick,(SELECT count(pedidos.IdPedido) as Solicitudes FROM comix.pedidos WHERE pedidos.IdUsuario = usuarios.IdUsuario AND pedidos.entregado = '1') as Solicitudes From comix.usuarios WHERE (SELECT count(pedidos.IdPedido) as Solicitudes FROM comix.pedidos WHERE pedidos.IdUsuario = usuarios.IdUsuario AND pedidos.entregado = '1') > 0";
  return $conx->query($sql);
}

function TopTenMonth(){
  $conx = conDB();
  $sql = 'SELECT productos.Titulo,(Select COUNT(*) as Cantidad From comix.pedidos WHERE pedidos.entregado=1 AND pedidos.IdProducto=productos.IdProducto AND pedidos.fecha_renta BETWEEN (NOW() - INTERVAL 30 DAY) AND NOW()) as Cantidades From comix.productos ORDER BY Cantidades DESC LIMIT 10';
  return $conx->query($sql);
}

function TopTenYear(){
  $conx = conDB();
  $sql = 'SELECT productos.Titulo,(Select COUNT(*) as Cantidad From comix.pedidos WHERE pedidos.entregado=1 AND pedidos.IdProducto=productos.IdProducto AND pedidos.fecha_renta BETWEEN (NOW() - INTERVAL 365 DAY) AND NOW()) as Cantidades From comix.productos ORDER BY Cantidades DESC LIMIT 10';
  return $conx->query($sql);
}

function FeitosMonth(){
  $conx = conDB();
  $sql = 'SELECT productos.Titulo,(Select COUNT(*) as Cantidad From comix.pedidos WHERE pedidos.entregado=1 AND pedidos.IdProducto=productos.IdProducto AND pedidos.fecha_renta BETWEEN (NOW() - INTERVAL 30 DAY) AND NOW()) as Cantidades From comix.productos ORDER BY Cantidades ASC LIMIT 10';
  return $conx->query($sql);
}

function FeitosYear(){
  $conx = conDB();
  $sql = 'SELECT productos.Titulo,(Select COUNT(*) as Cantidad From comix.pedidos WHERE pedidos.entregado=1 AND pedidos.IdProducto=productos.IdProducto AND pedidos.fecha_renta BETWEEN (NOW() - INTERVAL 365 DAY) AND NOW()) as Cantidades From comix.productos ORDER BY Cantidades ASC LIMIT 10';
  return $conx->query($sql);
}

function MegaQuery()
{
  $conx = conDB();
  $sql = 'SELECT usuarios.IdUsuario,
  CONCAT(clientes.nombre, " ", clientes.paterno, " ", clientes.matero) as full_name,clientes.telefono, clientes.direccion, clientes.correo,
  (SELECT MAX(fecha_renta) FROM comix.pedidos WHERE pedidos.IdUsuario = usuarios.IdUsuario) as UltimaRenta,
  (SELECT count(pedidos.IdPedido) as Solicitudes FROM comix.pedidos WHERE pedidos.IdUsuario = usuarios.IdUsuario AND pedidos.entregado = 1) as Entregados,
  (SELECT count(pedidos.IdPedido) as Solicitudes FROM comix.pedidos WHERE pedidos.IdUsuario = usuarios.IdUsuario AND pedidos.entregado = 2) as Cancelados,
  (SELECT count(pedidos.IdPedido) as Solicitudes FROM comix.pedidos WHERE pedidos.IdUsuario = usuarios.IdUsuario AND pedidos.entregado = 3) as Regresados FROM
  comix.usuarios INNER JOIN comix.clientes ON (usuarios.IdUsuario = clientes.IdUsuario)';
  return $conx->query($sql);
}


?>
