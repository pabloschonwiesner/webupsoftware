<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// conexion a db y articulo
include_once '../config/database.php';
include_once '../objects/articles.php';
 
$database = new Database();
$bd = $database->getConnection();
$article = new Article($bd);

ini_set("allow_url_fopen", true);
ini_set("allow_url_include", true);

$data = json_decode(file_get_contents('php://input'));
var_dump($data);

$article->fechaHora = date("Y-m-d H:i:s");
$article->titulo = $data->titulo;
$article->resumen = $data->resumen;
$article->idUsuario = 1;
$article->textoArticulo = $data->textoArticulo;
$article->fotoPrincipal = $data->fotoPrincipal;
$article->activo = true;
$article->publicado = false;
$article->fechaHoraModificacion = date("Y-m-d H:i:s");
$article->fechaHoraPublicacion = date("Y-m-d H:i:s");
$article->idUsuarioModificacion = 2;
$article->mejorArticulo = false;

if($article->create()) {
	echo '{';
	echo '"message": "Articulo creado."';
	echo '}';
} else {
	echo '{';
	echo '"message": "No se pudo crear el articulo."';
	echo '}';
}

?>