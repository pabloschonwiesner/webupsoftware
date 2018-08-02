<!DOCTYPE html>
<html lang="es" prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="UTF-8">
	<title>Editar artículo de Blog | Up Software</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/adminBlog.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/blog.css">
	<?php include_once './views/admin/headerArticles.php'; ?>
	<meta property="og:type" content="Image" />
	<meta property="og:title" content="<?php echo $articulo[0]['titulo'];  ?>" />
	<meta property="og:description" content="<?php echo $articulo[0]['resumen']; ?>" />
	<meta property="og:url" content="<?php echo BASE_URL . $articulo[0]['id']; ?>" />
	<meta property="og:image" content="<?php echo BASE_LOCAL_IMAGES_WEB . $articulo[0]['id'] . '/principal/' . $articulo[0]['rutaImagen']; ?>" />
	
</head>
<body>
	<div>
	<?php 

			if(isset($articulo) && $articulo) {
				foreach($articulo as $art) {
					echo '<div class="containerArticle">';
					echo 	'<div class="headerBlog">';
					echo 		'<div class="row imagePpal" style="background-image: url('. BASE_LOCAL_IMAGES_WEB . $art['id'] . '/principal/' . $art['fotoPrincipal'] .')">';				
					echo 		'</div>';
					echo 		'<div class="cover"></div>';
					echo 		'<div class="data">';
					echo 			'<a href="http://www.upsoftware.com.ar" class>Inicio</a> > <a href="'. BASE_URL . 'p/1">Blog</a> > <span>Post</span>';
					echo 			'<h1>'. $art['titulo'] .'</h1>';
					echo            '<div class="avatarContent">';
					echo 				'<figure class="avatar"><img class="avatarImg" src="' . BASE_LOCAL_IMAGES_WEB . 'usuarios/' . $art['rutaImagen'] . '" alt="Avatar" /></figure>';
					echo 				'<span class="avatarNombre">' . $art['nombreParaMostrar'] . '</span>';
					echo            	'<span class="fecha icon-clock"> hace ' . $art['dias'] . ' dias</span>';
					echo        	'</div>';
					echo 		'</div>';
					echo 	'</div>';					
					echo '<div class="textBlog">';
					echo '<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: es_ES</script>';
					echo '<script type="IN/Share"></script>';
					echo '<div id="fb-root"></div>';
  					echo '<script>(function(d, s, id) {
						    var js, fjs = d.getElementsByTagName(s)[0];
						    if (d.getElementById(id)) return;
						    js = d.createElement(s); js.id = id;
						    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
						    fjs.parentNode.insertBefore(js, fjs);
						  }(document, "script", "facebook-jssdk"));</script>';

					echo '
						  <div class="fb-share-button" 
						    data-href="' . BASE_URL . $articulo[0]['id'] . '" 
						    data-layout="button_count">
						  </div>';

					echo htmlspecialchars_decode($art['textoArticulo']);
					echo '</div>';
					echo '</div>';
				}			
			} else {
				echo '<div>No hay Articulo</div>';
			}

	 ?>
	</div>
	<script src="<?php echo BASE_URL; ?>views/admin/js/menu.js"></script>
	 <footer class="footer">
	 </footer>
</body>
</html>
