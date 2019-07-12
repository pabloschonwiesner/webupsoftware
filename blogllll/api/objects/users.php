<?php 

class Users{

	// conexion a bd y nombre tabla
	private $conn;
	private $table_name = "usuarios";

	// atributos
	public $id;
	public $nombre;
	public $tipoUsuario;
	public $activo;
	public $pass;
	public $rutaImagen;
	public $nombreParaMostrar;
	// constructor

	public function __constructor($bd){
		$this->conn = $bd;
	}
}

?>