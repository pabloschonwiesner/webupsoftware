<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once './../config/database.php';
include_once './../objects/articles.php';
 

// conexion bd y articulo
$database = new Database();
$bd = $database->getConnection();

$article = new Article($bd);
$stmt = $article->read();
$num = $stmt->rowCount();

if($num > 0){
	$article_arr = array();
	$article_arr["records"] = array();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$article_item = array(
			"id" => $id,
			"fechaHora" => $fechaHora,
			"titulo" => $titulo,
			"resumen" => $resumen,
			"idUsuario" => $idUsuario,
			"textoArticulo" => $textoArticulo,
			"fotoPrincipal" => $fotoPrincipal,
			"activo" => $activo,
			"publicado" => $publicado,
			"fechaHoraModificacion" => $fechaHoraModificacion,
			"fechaHoraPublicacion" => $fechaHoraPublicacion,
			"idUsuarioModificacion" => $idUsuarioModificacion,
			"mejorArticulo" => $mejorArticulo,
		);
		array_push($article_arr["records"], $article_item);
	}
	echo json_encode($article_arr);
} else {
	echo json_encode(array("message" => "No se encontraron articulos"));
}
?>