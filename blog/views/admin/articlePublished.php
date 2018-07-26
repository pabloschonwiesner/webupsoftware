<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>ABM Articulos Blog | Up Software</title>
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
            header('Location: ' . './../login');
        }
     ?>
		<div class="containerUsers">
		<div class="row">
			<?php 
				if($articles !== '') {
					echo '<div class="alert alert-success msj" role="alert">Articulo modificado!</div>';
					header("refresh:2; url=./../../admin/p/1");					
				} else {
					echo '<div class="alert alert-warning msj" role="alert">No se puede quitar publicacion ya que el articulo es el principal. Ir a otro artículo y seleccionarlo como principal</div>';
					header("refresh:6; url=./../../admin/p/1");	
				}
			?>
		</div>
	</div>   

</body>
</html>
