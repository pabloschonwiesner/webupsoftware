<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>ABM Usuarios Blog | Up Software</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="icon" type="image/x-icon" sizes="16x16" href="./../../media/images/favicon.ico">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/adminBlog.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/users.css">
	<?php include_once './views/admin/headerArticles.php'; ?>
</head>
<body>
	<div class="container">
		<?php 
        if(!isset($_SESSION['usuario']) || $_SESSION['usuario'] === '') {
            header('Location: ' . './login');
        }
     ?>
		<div class="containerUsers">
		<div class="row">
			<?php 
				echo '<div class="alert alert-success msj" role="alert">Usuario Modificado!</div>';
				header("refresh:2; url=./../../admin/users");
			?>
		</div>
	</div>   

</body>
</html>
