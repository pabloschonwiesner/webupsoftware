<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Panel de administración del Blog de UpSoftware</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/adminBlog.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/paginacion.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
	<?php include_once './views/admin/headerArticles.php'; ?>
</head>
<body>
	<div class="container">
		<?php 
        if(!isset($_SESSION['usuario']) || $_SESSION['usuario'] === '') {
            header('Location: ' . './../login');
        };
        ?>
		<div class="row">
			<h1 class="mx-auto">Panel de administración del Blog</h1>
		</div>
		<?php 
			if($paginaActual>$totalPaginas) {
				echo '<div class="row">';
				echo 	'<div class="alert alert-warning role="alert">No hay artículos para esa página!</div>';
                		header("refresh:3; url=./../p/1");
				echo '</div>';
			} else {
				echo '<div class="row">';
				echo 	'<div class="col-md-1"></div>';
				echo 	'<div class="col-md-11">';
				echo 		'<a class="btn btn-primary" href="' . BASE_BLOG_WEB . 'p/1' . '">Volver a Blog</a>';
				echo 		'<a class="btn btn-primary" href="' . BASE_URL . 'admin/create">Nuevo Artículo</a>';
				echo 		'<a class="btn btn-success" href="' . BASE_URL . 'admin/users">ABM Usuarios</a>';
				echo 	'<table class="table">';
				echo		'<tr>';
				echo			'<th>Titulo</th>';
				echo			'<th>Usuario</th>';
				echo			'<th>Editar</th>';					
				echo			'<th>Publicar</th>';
				echo		'</tr>';
						
							foreach($articulos as $articulo) {
								echo '<tr>';
								echo '<td>' . $articulo['titulo'] . '</td>';
								echo '<td>' . $articulo['nombre'] . '</td>';
								echo '<td><a class="btn btn-primary" href="' . BASE_URL . 'admin/edit/' . $articulo['id'] . '">Editar</a></td>';
								if($articulo['publicado']) {
									echo '<td><a class="btn btn-danger" href="' . BASE_URL . 'admin/articlePublished/' . $articulo['id'] . '">Quitar publicación</a></td>';
								} else {
									echo '<td><a class="btn btn-success" href="' . BASE_URL . 'admin/articlePublished/' . $articulo['id'] . '">PUBLICAR</a></td>';
								};						
								echo '</tr>';
							}
						
				echo	'</table>';
				echo    '</div>';
			include_once('./views/paginacionAdmin.php');
			}

		 ?>
		
		</div>
	</div>
	<script src="<?php echo BASE_URL; ?>views/admin/js/menu.js"></script>
</body>
</html>