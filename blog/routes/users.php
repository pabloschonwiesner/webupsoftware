<?php 


$router->get('/admin/users', function() use($pdo) {
	$sql = "SELECT * from Usuarios";
	$prepared = $pdo->prepare($sql);
	$prepared->execute();
	$usuarios = $prepared->fetchAll(PDO::FETCH_ASSOC);

	return render('./views/admin/users.php', ['usuarios' => $usuarios]);
});

$router->get('/admin/usersActivate/{id}', function($id) use($pdo) {
	$sql1 = "SELECT Activo FROM Usuarios WHERE id = :id";
	$prepared1 = $pdo->prepare($sql1);
	$prepared1->execute([
		'id' => $id
	]);
	$rta = $prepared1->fetchAll(PDO::FETCH_ASSOC);

	$sql2 = "UPDATE Usuarios SET Activo = :activo WHERE id = :id";
	$prepared2 = $pdo->prepare($sql2);
	$usuarios = $prepared2->execute([
		'activo' => !$rta[0]['Activo'],
		'id' => $id
	]);

	return render('./views/admin/userActivated.php', ['usuarios' => $usuarios]);
});

$router->get('/admin/newUser', function() use($pdo) {
	return render('./views/admin/newUser.php');
});

$router->post('/admin/newUser', function() use($pdo) {
	if(isset($_FILES)) {
		$tmp_name = isset($_FILES['file']['tmp_name']) ? $_FILES['file']['tmp_name'] : '';		
	}
	
	$sql1 = "SELECT max(id) + 1 as id from Usuarios LIMIT 1";
	$prepared1 = $pdo->prepare($sql1);
	$prepared1->execute();
	$id = $prepared1->fetchAll(PDO::FETCH_ASSOC);

	if(empty($file)) {
		$file = '1.jpg';
		$sql = "INSERT INTO Usuarios (nombre, tipoUsuario, activo, pass, rutaImagen) 
		values (:nombre, 1, 1, :pass, :rutaImagen)";
		$prepared = $pdo->prepare($sql);
		$result = $prepared->execute([
			'nombre' => $_POST['name'],
			'pass' => $_POST['pass'],
			'rutaImagen' => $file
		]);
	} else {
		$file = $id[0]['id'] . '.jpg';
		$sql = "INSERT INTO Usuarios (nombre, tipoUsuario, activo, pass, rutaImagen) 
		values (:nombre, 1, 1, :pass, :rutaImagen)";
		$prepared = $pdo->prepare($sql);
		$result = $prepared->execute([
			'nombre' => $_POST['name'],
			'pass' => $_POST['pass'],
			'rutaImagen' => $file
		]);
	}

	if(!empty($tmp_name)) {
			$carpeta = BASE_LOCAL_IMAGE . 'usuarios';
			$dir = opendir($carpeta);
			move_uploaded_file($tmp_name, $carpeta . '\\' . $file);
		}

	return render('./views/admin/newUser.php', [ 'result' => $result ]);
});

$router->get('/admin/editUser/{id}', function($id) use($pdo) {
	$sql = "SELECT * FROM Usuarios WHERE id = :id LIMIT 1";
	$prepared = $pdo->prepare($sql);
	$prepared->execute([
		'id' => $id
	]);
	$usuario = $prepared->fetchAll(PDO::FETCH_ASSOC);

	return render('./views/admin/editUser.php', ['usuario' => $usuario]);
});

$router->post('/admin/editUser', function() use($pdo) {
	if(isset($_FILES)) {
		$file = $_POST['id'] . '.jpg';
		$tmp_name = isset($_FILES['rutaImagen']['tmp_name']) ? $_FILES['rutaImagen']['tmp_name'] : '';		
	}

	if(empty($file)) {
		$sql = "UPDATE Usuarios	SET nombre = :nombre, nombreParaMostrar = :nombreParaMostrar, pass = :pass WHERE id = :id";
		$prepared = $pdo->prepare($sql);
		$result = $prepared->execute([
			'nombre' => $_POST['nombre'],
			'nombreParaMostrar' => $_POST['nombreParaMostrar'],
			'pass' => $_POST['pass'],
			'id' => $_POST['id']
		]);
	} else {
		$sql = "UPDATE Usuarios	SET nombre = :nombre, nombreParaMostrar = :nombreParaMostrar, pass = :pass, rutaImagen = :rutaImagen WHERE id = :id";
		$prepared = $pdo->prepare($sql);
		$result = $prepared->execute([
			'nombre' => $_POST['nombre'],
			'nombreParaMostrar' => $_POST['nombreParaMostrar'],
			'pass' => $_POST['pass'],
			'rutaImagen' => $file,
			'id' => $_POST['id']
		]);
	}

	if(!empty($file) && !empty($tmp_name)) {
			$carpeta = BASE_LOCAL_IMAGE . 'usuarios';
			$dir = opendir($carpeta);
			while(false !== ($current = readdir($dir))) {
				if($current == $_POST['id']) {
					unlink($carpeta . '\\' . $current);
				}
			}
			move_uploaded_file($tmp_name, $carpeta . '\\' . $file);
		}

	return render('./views/admin/editUser.php', [ 'result' => $result ]);
});

?>