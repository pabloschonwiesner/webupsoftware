<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Method: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once './../config/database.php';
include_once './../objects/articles.php';

$database = new Database();
$bd = $database->getConnection();

$article = new Article($bd);

$data = json_decode(file_get_contents("php://input"));
$article->id = $data->id;

$article->titulo = $data->titulo;
$article->resumen = $data->resumen;
$article->textoArticulo = $data->textoArticulo;
$article->fechaHoraModificacion = $data->fechaHoraModificacion;
$article->idUsuarioModificacion = $data->idUsuarioModificacion;

if($article->update()){
	echo '{';
	echo '"message": "Articulo actualizado."';
	echo '}';
} else {
	echo '{';
	echo '"message": "No se pudo actualizar el articulo."';
	echo '}';
}

?>