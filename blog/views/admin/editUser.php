<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>ABM Usuarios Blog | Up Software</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/adminBlog.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/editUser.css">
	<?php include_once './views/admin/headerArticles.php'; ?>
</head>
<body>
	<div class="containerUsers">
		<?php 
        if(!isset($_SESSION['usuario']) || $_SESSION['usuario'] === '') {
            header('Location: ' . './login');
        }
     ?>
		<div class="row">
			<h1 class="mx-auto">Editar Usuario</h1>
		</div>
		<div class="row">
			<div class="col-md-12">
				<a class="btn btn-primary" href="<?php echo BASE_URL; ?>admin/users">Volver</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 user">
				<?php 
					if(isset($result) && $result) {
						echo '<div class="alert alert-success msj" role="alert">Usuario Modificado!</div>';
						header("refresh:2; url=./../admin/users");
					} else {
						foreach($usuario as $us) {
							echo '<figure class="avatar">';
							echo 	'<img class="avatarImagen" src="' . BASE_LOCAL_IMAGES_WEB . 'usuarios/' . $us['rutaImagen'] . '" alt="' . $us['nombre'] . '" />';
							echo '</figure>';
							echo '<form method="post" enctype="multipart/form-data" action="' . BASE_URL . 'admin/editUser">';
							echo 	'<div class="form-group">';
							echo 		'<label for="codUsuario">ID:</label>';
							echo 		'<input type="text" name="codUsuario" value="' . $us['id'] . '" disabled />';
							echo 		'<input type="hidden" name="id" value="' . $us['id'] . '" />';
							echo 	'</div>';
							echo 	'<div class="form-group">';
							echo 		'<label for="nombre">NOMBRE:</label>';
							echo 		'<input type="text" name="nombre" id="nombre" value="' . $us['nombre'] .'" />';
							echo 	'</div>';
							echo 	'<div class="form-group">';
							echo 		'<label for="nombreParaMostrar">NOMBRE PARA MOSTRAR:</label>';
							echo 		'<input type="text" name="nombreParaMostrar" id="nombreParaMostrar" value="' . $us['nombreParaMostrar'] .'" />';
							echo 	'</div>';
							echo 	'<div class="form-group">';
							echo 		'<label for="nombre">PASS:</label>';
							echo 		'<input type="password" name="pass" id="pass" value="' . $us['pass'] .'" />';
							echo 	'</div>';
							echo 	'<div class="form-group">';
							echo 		'<label for="rutaImagen">FOTO:</label>';
							echo 		'<input type="file" name="rutaImagen" id="rutaImage" />';
							echo 	'</div>';
							echo 	'<input class="btn btn-primary" type="submit" value="Guardar" />';
							echo '</form>';
						}
					}
					
				?>
			</div>
		</div>
	</div>   
	<script src="<?php echo BASE_URL; ?>views/admin/js/menu.js"></script>
</body>
</html>
