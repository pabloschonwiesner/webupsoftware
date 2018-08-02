<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Login de Blog | Up Software</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/adminBlog.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/login.css">
	<?php include_once 'views/admin/headerArticles.php'; ?>
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="mx-auto">Login</h1>            
		</div>
        <div class="row">
        	<?php
        		if(empty($usuario) || !$usuario) {
        			echo '<form method="post" >';
        			echo 	'<div class="form-group">';
        			echo 		'<label for="user">Usuario:</label>';
        			echo 		'<input type="text" name="user" id="user" />';
        			echo 	'</div>';
        			echo 	'<div class="form-group">';
        			echo 		'<label for="pass">Contraseña:</label>';
        			echo 		'<input type="password" name="pass" id="pass" />';
        			echo 	'</div>';
					echo 	'<div class="form-group">';
					echo 		'<input class="btn btn-primary" type="submit" value="Acceder">';
					echo 	'</div>';
					echo '</form>';        			
        		} else {
        			header("Location:" . './../admin/p/1');
        		}


        	?>
        </div>
	</div>
</body>
</html>
