<?php 


$dbHost = 'localhost';
$dbName = 'blogupsoftware';
$dbUser = 'root';
$dbPass = '';

try {
	$pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
	echo $e->getMessage();
};


function numero_paginas($pdo) {
	// $total_posts = $pdo->prepare("SELECT FOUND_ROWS() as total");
	// $total_posts = $total_posts->execute();
	// $total_posts = $total_posts->fetchAll(PDO::FETCH_ASSOC);

	// $numero_paginas = ceil($total_posts / POSTSPORPAGINA);
	$numero_paginas = 2;
	return $numero_paginas;
}

function limpiarDatos($datos) {
	$datos = trim($datos); //se quitan los espacios en blanco
	$datos = stripslashes($datos); //se quitan las barras
	$datos = htmlspecialchars($datos, ENT_QUOTES); //se quitan los caracteres utiles en html previene injection
	return $datos;
}

function pagina_actual() {
	return isset($_GET['p']) ? (int)$_GET['p'] :1;
}

function obtener_post($pdo) {
	$postPorPagina = POSTSPORPAGINA;
	$inicio = (pagina_actual() > 1) ? pagina_actual() * POSTSPORPAGINA - POSTSPORPAGINA : 0;
	$sentencia = $pdo->prepare("SELECT SQL_CALC_FOUND_ROWS A.*, U.nombreParaMostrar, U.rutaImagen, DATEDIFF(now(), A.fechaHoraPublicacion) as dias FROM Articulos as A INNER JOIN Usuarios as U on U.id = A.idUsuario   ORDER BY fechaHoraPublicacion DESC LIMIT $inicio, $postPorPagina");
	$sentencia->execute();
	return $sentencia->fetchAll(PDO::FETCH_ASSOC);
}

function id_articulo($id) {
	return (int)limpiarDatos($id);
}

function obtener_post_por_id($conexion, $id) {
	$resultado = $conexion->query("SELECT * FROM articulos WHERE id = $id LIMIT 1");
	$resultado = $resultado->fetchAll();
	return ($resultado) ? $resultado : false;
}

function fecha($fecha) {
	$timestamp = strtotime($fecha);
	$meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
	$dia = date('d', $timestamp);
	$mes = date('m', $timestamp);
	$year = date('Y', $timestamp);

	$fecha = "$dia de " . $meses[$mes - 1] . " del ". $year;
	return $fecha;
}


?>