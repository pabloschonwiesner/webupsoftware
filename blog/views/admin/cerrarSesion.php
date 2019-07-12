<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Login de Blog | Up Software</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" sizes="16x16" href="./../media/images/favicon.ico">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>../views/admin/css/adminBlog.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>../views/admin/css/login.css">
	<?php include_once '../views/admin/headerArticles.php'; ?>
</head>
<body>
	<div class="container">
		<?php 
        if($_SESSION['usuario'] === '') {
            header('Location: ' . './login');
        }
     ?>
		<div class="row">
			<h1 class="mx-auto">Login</h1>            
		</div>
        <div class="row">
        	<?php 
				echo '<div class="alert alert-success msj" role="alert">Sesión cerrada!</div>';
				header("refresh:2; url=./../p/1");
			?>
        </div>
	</div>
</body>
</html>
