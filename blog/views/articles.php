<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Editar artículo de Blog | Up Software</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>../views/admin/css/adminBlog.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>../views/admin/css/blog.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>../views/admin/css/paginacion.css">
	<?php include_once './../views/admin/headerArticles.php'; ?>
</head>
<body>
	<?php 
		if(isset($mejorArticulo) && $mejorArticulo) {
			foreach ($mejorArticulo	 as $ma) {
				echo '<div class="containerArticle">';
				echo 	'<div class="headerBlog">';
				echo 		'<div class="row imagePpal" style="background-image: url('. BASE_LOCAL_IMAGES_WEB . $ma['id'] . '/principal/' . $ma['fotoPrincipal'] .')">';				
				echo 		'</div>';
				echo 		'<div class="cover"></div>';
				echo 		'<div class="data">';
				echo 			'<a href="http://www.upsoftware.com.ar">Inicio</a> > <a href="'. BASE_URL .'/p/1">Blog</a> > <span>Post</span>';
				echo 			'<a href="' . BASE_URL . $ma['id'] . ' "><h1 class="tituloMejorArticulo">'. $ma['titulo'] .'</h1></a>';
				echo        	'<div class="avatarContent">';
				echo 				'<figure class="avatar"><img class="avatarImg" src="' . BASE_LOCAL_IMAGES_WEB .'usuarios/' . $ma['rutaImagen'] . '" alt="Avatar" /></figure>';
				echo 				'<span class="avatarNombre">' . $ma['nombreParaMostrar'] . '</span>';
				echo            	'<span class="fecha icon-clock"> hace ' . $ma['dias'] . ' dias</span>';
				echo        	'</div>';
				echo 		'</div>';
				echo 	'</div>';
				echo '</div>';
			}
		}

		
		if(isset($articulos) && $articulos) {
			echo '<div class="container">';
			echo '<h1 class="tituloPosts">Posts</h1>';
			foreach($articulos as $articulo) {
				echo '<a href="' . BASE_URL . $articulo['id'] . '">';
				echo 	'<article class="articleBlog">';
				echo 		'<h4 class="tituloArticulo">' . $articulo['titulo'] .'</h4>';
				echo 		'<p class="resumenArticulo">' . $articulo['resumen'] . '</p>';
				echo        '<div class="avatarContent">';
				echo 			'<figure class="avatar"><img class="avatarImg" src="' . BASE_LOCAL_IMAGES_WEB . 'usuarios/' . $articulo['rutaImagen'] . '" alt="Avatar" /></figure>';
				echo 			'<span class="avatarNombre">' . $articulo['nombreParaMostrar'] . '</span>';
				echo            '<span class="fecha icon-clock"> hace ' . $articulo['dias'] . ' dias</span>';
				echo        '</div>';
				echo 	'</article>';
				echo '</a>';
				
			}			
		} else {
			echo '<div>No hay Articulo</div>';
		}
		echo '</div>';
		include_once('./../views/paginacion.php');
	 ?>
	 <footer>
		<a id="admin" href="http://localhost:81/upsoftware/web/blog/public/admin/p/1">Admin</a>
	</footer>
	<script src="<?php echo BASE_URL; ?>../views/admin/js/menu.js"></script>
</body>
</html>
