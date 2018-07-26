<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>ABM Usuarios Blog | Up Software</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>../views/admin/css/adminBlog.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>../views/admin/css/users.css">
	<?php include_once './../views/admin/headerArticles.php'; ?>
</head>
<body>
	<div class="container">
		<?php 
        if($_SESSION['usuario'] === '') {
            header('Location: ' . './login');
        }
     ?>
		<div class="containerUsers">
		<div class="row">
			<h1 class="titulo">ABM Usuarios</h1>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php 
				 	echo '<a class="btn btn-primary" href="' . BASE_URL . 'admin/p/1">Volver</a>';
					echo '<a class="btn btn-success" href="' . BASE_URL . 'admin/newUser">Nuevo Usuario</a>';
					echo '<table class="table">';
					echo	'<tr>';
					echo		'<th>ID</th>';
					echo		'<th>Usuario</th>';
					echo 		'<th>Imagen</th>';
					echo		'<th>Editar</th>';
					echo		'<th>Activar/Desactivar</th>';
					echo	'</tr>';
						
					foreach($usuarios as $usuario) {
						echo '<tr>';
						echo 	'<td>' . $usuario['id'] . '</td>';
						echo 	'<td>' . $usuario['nombre'] . '</td>';
						echo 	'<td><figure class="avatar"><img class="avatarImg" src="' . BASE_URL . 'media/images/usuarios/' . $usuario['id'] . '.jpg" alt="Avatar" /></figure></td>';
						echo '<td><a class="btn btn-primary" href="' . BASE_URL . 'admin/editUser/' . $usuario['id'] . '">Editar</a></td>';
						if($usuario['activo']) { 
							echo '<td><a class="btn btn-danger" href="' . BASE_URL . 'admin/usersActivate/' . $usuario['id'] . '">Desactivar</a></td>';
						} else { 
							echo '<td><a class="btn btn-success" href="' . BASE_URL . 'admin/usersActivate/' . $usuario['id'] . '">Activar</a></td>'; 
						};
						
						echo '</tr>';
					}
				 ?>
				
				
			</div>
		</div>
	</div>   
	<script src="<?php echo BASE_URL; ?>../views/admin/js/menu.js"></script>
</body>
</html>
