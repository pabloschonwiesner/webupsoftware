<?php 

class Database{

	//credenciales local
	private $host = 'localhost';
	private $db_name = 'blogupsoftware';
	private $username = "root";
	private $password = "";
	public $conn;


	// //credenciales produccion
	// private $host = 'localhost';
	// private $db_name = 'zaphalo_blogupsoftware';
	// private $username = "zaphalo_upsoft";
	// private $password = "31122018";
	// public $conn;

	// conectar a la bd
	public function getConnection(){
		try{
			$string = "mysql:host=$this->host;dbname=$this->db_name";
			$this->conn = new PDO($string, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->conn->exec("set names utf8");
		}catch(PDOException $exception){
			$this->conn = null;
			echo "Connection error: " . $exception->getMessage();
		}
		return $this->conn;
	}
}

?>

