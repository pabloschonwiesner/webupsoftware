<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once './../config/core.php';
include_once './../shared/utilities.php';
include_once './../config/database.php';
include_once './../objects/articles.php';

// utilidades
$utilities = new Utilities();

// instancia de bd y articulo
$database = new Database();
$db = $database->getConnection();
$article = new Article($db);

// pido articulos por pagina
$stmt = $article->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();

if($num > 0){
	$article_arr = array();
	$article_arr["records"] = array();
	$article_arr["paging"] = array();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$article_item = array(
			"id" => $id,
			"titulo" => $titulo,
			"resumen" => $resumen,
			"fotoPrincipal" => $fotoPrincipal,
			"mejorArticulo" => $mejorArticulo
		);
		array_push($article_arr["records"], $article_item);
	}

	$total_rows = $article->count();
	$page_url = "{$home_url}articles/readPaging.php?";
	$paging = $utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
	$article_arr["paging"] = $paging;
	echo json_encode($article_arr);
} else {
	echo json_encode(array("message" => "No hay articulos."));
}

?>