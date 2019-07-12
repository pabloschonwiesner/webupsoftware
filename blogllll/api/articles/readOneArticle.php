<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Method: GET");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: access");

include_once './../config/database.php';
include_once './../objects/articles.php';

$database = new Database();
$bd = $database->getConnection();
$article = new Article($bd);

$article->id = isset($_GET['id']) ? $_GET['id'] : die();
$article->readOne();

$article_arr = array(
	"id" => $article->id,
	"fechaHora" => $article->fechaHora,
	"titulo" => $article->titulo,
	"resumen" => $article->resumen,
	"idUsuario" => $article->idUsuario,
	"textoArticulo" => $article->textoArticulo,
	"fotoPrincipal" => $article->fotoPrincipal,
	"activo" => $article->activo,
	"publicado" => $article->publicado,
	"fechaHoraModificacion" => $article->fechaHoraModificacion,
	"fechaHoraPublicacion" => $article->fechaHoraPublicacion,
	"idUsuarioModificacion" => $article->idUsuarioModificacion,
	"mejorArticulo" => $article->mejorArticulo
);

print_r(json_encode($article_arr));

?>