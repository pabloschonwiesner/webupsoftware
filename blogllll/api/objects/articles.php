<?php 

class Article{

	// conexion bd y nombre tabla
	private $conn;
	private $table_name = "articulos";

	// atributos
	public $id;
	public $fechaHora;
	public $titulo;
	public $resumen;
	public $idUsuario;
	public $textoArticulo;
	public $fotoPrincipal;
	public $activo;
	public $publicado;
	public $fechaHoraModificacion;
	public $fechaHoraPublicacion;
	public $idUsuarioModificacion;
	public $mejorArticulo;

	// constructor
	public function __construct($db){
		$this->conn = $db;
	}

	// leer todos los articulos
	function read(){
		$query = "SELECT * from " .  $this->table_name . " ORDER BY fechaHoraPublicacion";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function readOne(){
		$query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];
		$this->fechaHora = $row['fechaHora'];
		$this->titulo = $row['titulo'];
		$this->resumen = $row['resumen'];
		$this->idUsuario = $row['idUsuario'];
		$this->textoArticulo = $row['textoArticulo'];
		$this->fotoPrincipal = $row['fotoPrincipal'];
		$this->activo = $row['activo'];
		$this->publicado = $row['publicado'];
		$this->fechaHoraModificacion = $row['fechaHoraModificacion'];
		$this->fechaHoraPublicacion = $row['fechaHoraPublicacion'];
		$this->idUsuarioModificacion = $row['idUsuarioModificacion'];
		$this->mejorArticulo = $row['mejorArticulo'];
	}

	// contar articulos en bd
	function count(){
		$query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . " WHERE publicado = 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['total_rows'];
	}

	function create(){
		$query = "INSERT INTO " . $this->table_name . "(fechaHora, titulo, resumen, idUsuario, textoArticulo, fotoPrincipal, activo, publicado, fechaHoraModificacion, fechaHoraPublicacion, idUsuarioModificacion) VALUES (:fechaHora, :titulo, :resumen, :idUsuario, :textoArticulo, :fotoPrincipal, :activo, :publicado, :fechaHoraModificacion, :fechaHoraPublicacion, :idUsuarioModificacion)";
		$stmt = $this->conn->prepare($query);

		
		$this->fechaHora = htmlspecialchars(strip_tags($this->fechaHora));
		$this->titulo = htmlspecialchars(strip_tags($this->titulo));
		$this->resumen = htmlspecialchars(strip_tags($this->resumen));
		$this->idUsuario = htmlspecialchars(strip_tags($this->idUsuario));
		$this->textoArticulo = htmlspecialchars(strip_tags($this->textoArticulo));
		$this->fotoPrincipal = htmlspecialchars(strip_tags($this->fotoPrincipal));
		$this->activo = htmlspecialchars(strip_tags($this->activo));
		$this->publicado = htmlspecialchars(strip_tags($this->publicado));
		$this->fechaHoraModificacion = htmlspecialchars(strip_tags($this->fechaHoraModificacion));
		$this->fechaHoraPublicacion = htmlspecialchars(strip_tags($this->fechaHoraPublicacion));
		$this->idUsuarioModificacion = htmlspecialchars(strip_tags($this->idUsuarioModificacion));

		$stmt->bindParam(":fechaHora", $this->fechaHora);
		$stmt->bindParam(":titulo", $this->titulo);
		$stmt->bindParam(":resumen", $this->resumen);
		$stmt->bindParam(":idUsuario", $this->idUsuario);
		$stmt->bindParam(":textoArticulo", $this->textoArticulo);
		$stmt->bindParam(":fotoPrincipal", $this->fotoPrincipal);
		$stmt->bindParam(":activo", $this->activo);
		$stmt->bindParam(":publicado", $this->publicado);
		$stmt->bindParam(":fechaHoraModificacion", $this->fechaHoraModificacion);
		$stmt->bindParam(":fechaHoraPublicacion", $this->fechaHoraPublicacion);
		$stmt->bindParam(":idUsuarioModificacion", $this->idUsuarioModificacion);

		if($stmt->execute()) {
			return true;
		}
		return false;
	}

	// leer articulos con paginacion
	function readPaging($from_record_num, $records_per_page){
		$query = "SELECT id, titulo, resumen, fotoPrincipal, mejorArticulo FROM articulos WHERE publicado = 1 ORDER BY  fechaHoraPublicacion LIMIT ?, ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
		$stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt;
	}

	function delete(){
		$query = "UPDATE " . $this->table_name . " SET activo = ? WHERE id = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->id = htmlspecialchars(strip_tags($this->id));
		$stmt->bindParam(1, true);
		$stmt->bindParam(2, $this->id);
		if($stmt->execute()){
			return true;
		}
		return false;
	}

	function update(){
		$query = "UPDATE " . $this->table_name . " SET titulo = :titulo, resumen = :resumen, textoArticulo = :textoArticulo, fechaHoraModificacion = :fechaHoraModificacion, idUsuarioModificacion = :idUsuarioModificacion WHERE id = :id";
		$stmt = $this->conn->prepare($query);
		$this->titulo = htmlspecialchars(strip_tags($this->titulo));
		$this->resumen = htmlspecialchars(strip_tags($this->resumen));
		$this->textoArticulo = htmlspecialchars(strip_tags($this->textoArticulo));
		$this->fechaHoraModificacion = htmlspecialchars(strip_tags($this->fechaHoraModificacion));
		$this->idUsuarioModificacion = htmlspecialchars(strip_tags($this->idUsuarioModificacion));

		$stmt->bindParam(':titulo', $this->titulo);
		$stmt->bindParam(':resumen', $this->resumen);
		$stmt->bindParam(':textoArticulo', $this->textoArticulo);
		$stmt->bindParam(':fechaHoraModificacion', $this->fechaHoraModificacion);
		$stmt->bindParam(':idUsuarioModificacion', $this->idUsuarioModificacion);

		if($stmt->execute()){
			return true;
		}
		return false;
	}
}

?>