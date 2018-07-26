<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once './../vendor/autoload.php';
require_once('./../views/admin/config.php');
define('POSTSPORPAGINA', $blog_config['post_por_pagina']);
require_once('./../views/admin/funciones.php');

$baseUrl = '';
$baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
$baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . $baseDir;
define('BASE_URL', $baseUrl);
define('BASE_LOCAL_IMAGE', 'c:\xampp\htdocs\upsoftware\web\blog\public\media\images\\');
define('BASE_LOCAL_IMAGES_UPLOAD', 'C:\xampp\htdocs\Upsoftware\web\blog\public\media\uploads\\');
define('BASE_LOCAL_IMAGES_THUMBNAIL', 'C:\xampp\htdocs\Upsoftware\web\blog\public\media\uploads\thumbnail\\');
define('BASE_LOCAL_IMAGES_WEB', 'http://localhost:81/upsoftware/web/blog/public/media/images/');
define('BASE_LOCAL_WEB', 'http://localhost:81/upsoftware/web/');
define('BASE_BLOG_WEB', 'http://localhost:81/upsoftware/web/blog/public/');

$route = $_GET['route'] ?? '/';

function render($fileName, $params = []) {
	ob_start();
	extract($params);
	include $fileName;
	return ob_get_clean();
}

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

$router = new RouteCollector();

require_once('./../routes/users.php');
require_once('./../routes/articles.php');

$router->get('/media/images/{nroArticulo}/{nombreArchivo}', function($nroArticulo, $nombreArchivo) {
	$dir = opendir(BASE_LOCAL_IMAGE . $nroArticulo);
	while($current = readdir($dir)) {
		if($current == $nombreArchivo) {
			return $dir.$current;
		}
	}
});

$router->post('/media/upload.php', function() {
	return './media/upload.php';
});

$router->get('/admin/login', function() use($pdo){
	return render('./../views/admin/login.php');
});

$router->post('/admin/login', function() use($pdo){
	$usuario = limpiarDatos($_POST['user']);
	$password = limpiarDatos($_POST['pass']);

	$sql = "SELECT * FROM Usuarios WHERE nombre = :usuario LIMIT 1";
	$prepare = $pdo->prepare($sql);
	$prepare->execute([
		'usuario' => $usuario
	]);
	$rta = $prepare->fetchAll(PDO::FETCH_ASSOC)[0];

	if(!empty($rta) && $rta['pass'] === $password) {
		$acceso = true;
		$_SESSION['id'] = $rta['id'];
		$_SESSION['usuario'] = $rta['nombre'];
		$_SESSION['password'] = $rta['pass'];
		$_SESSION['rutaImagen'] = $rta['rutaImagen'];
	} else {
		$acceso = false;
	};


	return render('./../views/admin/login.php', ['usuario' => $rta]);
});

$router->get('/admin/cerrarSesion', function(){
	$_SESSION['usuario'] = '';
	$_SESSION['password'] = '';
	$_SESSION['rutaImagen'] = '';
	header('Location:' . BASE_BLOG_WEB . 'p/1');
});

$dispatcher = new Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $route);
echo $response;

?>