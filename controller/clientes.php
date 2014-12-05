<?php
require dirname(__FILE__).'/../config/conx.php';
require 'validacion.php';
/**
* Clase para validar y almacenar en base de datos los datos de los clientes... CRUD(Create, Update,Delete) tabla Clientes
*/
class Cliente{

	private $data;
	private $nombre, $paterno, $materno, $direccion, $cp, $tel, $correo, $id, $iduser;
	private $status = false;

	function __construct($tipo, $data){
		$this->setNombre($data["nombre"]);
		$this->setPaterno($data["paterno"]);
		$this->setMaterno($data["materno"]);
		$this->setDireccion($data["direccion"]);
		$this->setCP($data["cp"]);
		$this->setTelefono($data["telefono"]);
		$this->setCorreo($data["correo"]);
		$this->setIdUsuario($data["iduser"]);
		if ($tipo == "Guardar") {
			$this->guardar();
			header("Location: /Biblioteca/");
		}
	}

	public function guardar()
	{
		$conx = conDB();
		$sql = "INSERT INTO `comix`.`clientes` (`id`, `nombre`, `paterno`, `matero`, `direccion`, `telefono`, `cp`, `correo`, `IdUsuario`) VALUES (NULL, '".$this->getNombre()."', '".$this->getPaterno()."', '".$this->getMaterno()."', '".$this->getDireccion()."', '".$this->tel."', '".$this->getCP()."', '".$this->getCorreo()."', '".$this->getIdUsuario."')";
		// $sql = "INSERT INTO `comix`.`clientes` (`id`, `nombre`, `paterno`, `matero`, `direccion`, `telefono`, `cp`, `correo`, `IdUsuario`) VALUES (NULL, '".$this->getNombre()."', '".$this->getPaterno()."', '".$this->getMaterno()."', '".$this->getDireccion()."', '".$this->getTelefono()."', '".$this->getCP()."', '".$this->getCorreo()."', '".$this->getIdUsuario()."')";
		$conx->query($sql);
	}

	public function setID($value=0)
	{
		$this->id = $value;
	}

	public function setNombre($value='')
	{
		$this->nombre = $value;
	}

	public function setPaterno($value='')
	{
		$this->paterno = $value;
	}

	public function setMaterno($value='')
	{
		$this->materno = $value;
	}

	public function setDireccion($value='')
	{
		$this->direccion = $value;
	}

	public function setCP($value='')
	{
		$this->cp = $value;
	}

	public function setTelefono($value='')
	{
		$this->telefono = $value;
	}

	public function setcorreo($value='')
	{
		$this->correo = $value;

	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function getPaterno()
	{
		return $this->paterno;
	}

	public function getMaterno()
	{
		return $this->materno;
	}

	public function getDireccion()
	{
		return $this->direccion;
	}

	public function getCP()
	{
		return $this->cp;
	}

	public function getTelefono()
	{
		return $this->tel;
	}

	public function getCorreo()
	{
		return $this->correo;
	}

	public function getID($value='')
	{
		return $this->id;
	}

	public function getIdUsuario()
	{
		return $this->iduser;
	}

	public function setIdUsuario($value)
	{
		$this->iduser = $value;
	}

}

new Cliente($_POST['submit'], $_POST);
?>
