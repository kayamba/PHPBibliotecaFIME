<?php
require_once dirname(__FILE__).'/../config/conx.php';

function noNegativo($valor){
	if (is_numeric($valor)) {
		if ($valor > 0) {
			return true;
		}
	}
	return false;
}

function password($pass1, $pass2){
	if (strlen($pass1) > 6) {
		if ($pass1 == $pass2) {
			return md5($pass1);
		}else{
			return false;
		}
	}else{
		return false;
	}
}


function is_user($user, $pass){
	$conx = conDB();
	$array = false;
	$query = "SELECT * FROM comix.usuarios WHERE Nick = '".$user."' LIMIT 1";
	$result  = $conx->query($query);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			if ($row['Pass'] == md5($pass)) {
				$array = array('nick' => $row['Nick'], 'id' => $row['IdUsuario'], 'tipo' => $row['Tipo'] );
			}else{
				return false;
			}
		}
	}
	return $array;
}

function profile_complete($iduser)
{
	$conx = conDB();
	$array = false;
	$query = "SELECT COUNT(*) as Conteo FROM comix.usuarios INNER JOIN comix.clientes ON(usuarios.IdUsuario = clientes.IdUsuario) WHERE usuarios.IdUsuario  = '".$iduser."'";
	$result  = $conx->query($query);
	while ($row = $result->fetch_assoc()) {
		return ($row['Conteo'] > 0);
	}
}

function acl($id, $tipo, $acl){
	if (!profile_complete($id)) {
		header("Location: /Biblioteca/new_cliente.php");
	}elseif (!(($tipo == $acl) OR ($tipo == "Admin"))){
		header("Location: /Biblioteca");
	}
}

function saveImage($file){

	$subir = "true";
	$tam = $file['size'];
	$msg = "";
/*
	if ($file['size'] > 600000){
		$msg = $msg."El archivo es mayor que 200KB, debes reduzcirlo antes de subirlo<BR>";
		$subir = "false";
	}

	if (!($file['type'] =="image/jpeg" OR $file['type'] =="image/gif")){
		$msg = $msg." Tu archivo tiene que ser JPG o GIF. Otros archivos no son permitidos<BR>";
		$subir = "false";
	}*/

	$name=$file['name'];
	$add = "uploads/$name";

	if($subir == "true"){
		if(move_uploaded_file ($file['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/Biblioteca/".$add)){
			return $add;
		}else{
			// echo "Error al subir el archivo";
			return "";
		}
	}else{
		// echo $msg;
		return "";
	}

}
?>
