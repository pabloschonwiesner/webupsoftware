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
if($article->delete()) {
	echo '{';
	echo '"message": "Articulo borrado."';
	echo '}';
} else {
	echo '{';
	echo '"message": "No se pudo borrar el articulo."';
	echo '}';
}


?>