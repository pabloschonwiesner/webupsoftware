<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>ABM Usuarios Blog | Up Software</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>../views/admin/css/adminBlog.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>../views/admin/css/newUser.css">
	<?php include_once './../views/admin/headerArticles.php'; ?>
</head>
<body>
	<div class="containerUsers">
		<div class="row">
			<h1 class="mx-auto">Nuevo Usuario</h1>
		</div>
		<div class="row">
			<div class="col-md-12">
				<a class="btn btn-primary" href="<?php echo BASE_URL; ?>admin/users">Volver</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 user">
				<?php 
					if($_SESSION['usuario']) {
						if(isset($result) && $result) {
							echo '<div class="alert alert-success msj" role="alert">Usuario Modificado!</div>';
							header("refresh:2; url=./../admin/users");
						} else {
							echo '<form method="POST" enctype="multipart/form-data">';
							echo 	'<div class="form-group">';
							echo 		'<label for="name">NOMBRE:</label>';
							echo 		'<input type="text" name="name" />';
							echo 	'</div>';
							echo 	'<div class="form-group">';
							echo 		'<label for="name">NOMBRE PARA MOSTRAR:</label>';
							echo 		'<input type="text" name="displayName" />';
							echo 	'</div>';
							echo 	'<div class="form-group">';
							echo 		'<label for="pass">PASS:</label>';
							echo 		'<input type="password" name="pass" />';
							echo 	'</div>';
							echo 	'<div class="form-group">';
							echo 		'<label for="name">FOTO:</label>';
							echo 		'<input type="file" name="file" id="file" />';
							echo 	'</div>';
							echo 	'<div class="form-group">';
							echo 		'<input type="submit" name="file" id="file" value="Guardar" class="btn btn-primary" />';
							echo 	'</div>';
							echo '</form>';
						}
					} else {
						header('Location: ' . './login');
					}
				 ?>
			</div>
		</div>
	</div>   
	<script src="<?php echo BASE_URL; ?>../views/admin/js/menu.js"></script>
</body>
</html>
