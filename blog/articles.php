<?php 


$router->get('/admin/edit/{id}', function($id) use($pdo) {
	$sql = "SELECT * FROM articulos WHERE id = :id";
	$prepared = $pdo->prepare($sql);
	$prepared->execute(array('id'=>$id));
	$articulo = $prepared->fetchAll(PDO::FETCH_ASSOC);

	return render('./views/admin/editArticle.php', [ 'articulo' => $articulo ]);
});

$router->post('/admin/edit/{id}', function($id) use($pdo) {
	print_r($_POST[]);
	print_r($_FILES[]);
	$file = isset($_FILES['file']['name']) ? $_FILES['file']['name'] : '';
	$tmp_name = isset($_FILES['file']['tmp_name']) ? $_FILES['file']['tmp_name'] : '';

	if(empty($file)) {
		$sql = "UPDATE articulos set titulo = :titulo, resumen = :resumen, textoArticulo = :textoArticulo, fechaHoraModificacion = :fechaHoraModificacion, idUsuarioModificacion = :idUsuarioModificacion   WHERE id = :id";
		$prepared = $pdo->prepare($sql);
		$result = $prepared->execute([
			'titulo' => limpiarDatos($_POST['title']),
			'resumen' => limpiarDatos($_POST['summary']),
			'textoArticulo' => limpiarDatos($_POST['textoBlog']),
			'fechaHoraModificacion' => Date('Y-m-d H:i:s') ,
			'idUsuarioModificacion' => $_SESSION['id'],
			'id' => $id
		]);
	} else {
		$sql = "UPDATE articulos set titulo = :titulo, resumen = :resumen, textoArticulo = :textoArticulo, fotoPrincipal = :fotoPrincipal, fechaHoraModificacion = :fechaHoraModificacion, idUsuarioModificacion = :idUsuarioModificacion   WHERE id = :id";
		$prepared = $pdo->prepare($sql);
		$result = $prepared->execute([
			'titulo' => limpiarDatos($_POST['title']),
			'resumen' => limpiarDatos($_POST['summary']),
			'textoArticulo' => limpiarDatos($_POST['textoBlog']),
			'fotoPrincipal' => $file,
			'fechaHoraModificacion' => Date('Y-m-d H:i:s') ,
			'idUsuarioModificacion' => $_SESSION['id'],
			'id' => $id
		]);
		
		if(!empty($file) && !empty($tmp_name)) {
			$carpeta = BASE_LOCAL_IMAGE . $id . '/principal';
			$dir = opendir($carpeta);
			while(false !== ($current = readdir($dir))) {
				if($current != "." && $current != ".." && $current != "thumbnail") {
					unlink($carpeta . '/' . $current);
				}
			}
			move_uploaded_file($tmp_name, $carpeta . '/' . $file);
		}
	}
	
	$dir = opendir(BASE_LOCAL_IMAGES_UPLOAD);
	$files = array();
	while($current  = readdir($dir)) {
		if($current != "." && $current != ".." && $current != "thumbnail") {
			$files[] = $current;
		}
	}

	$carpeta = BASE_LOCAL_IMAGE . $id;
	for($i=0; $i<count($files); $i++) {
		rename(BASE_LOCAL_IMAGES_UPLOAD.'/'.$files[$i], $carpeta .'/'.$files[$i]);
	}

	$dirThumbnail = opendir(BASE_LOCAL_IMAGES_THUMBNAIL);
	$filesThumbnail = array();
	while($currentThumbnail = readdir($dirThumbnail)) {
		if($currentThumbnail != "." && $currentThumbnail != "..") {
			$filesThumbnail[] = $currentThumbnail;
		}
	}

	for($a=0; $a<count($filesThumbnail); $a++) {
		unlink(BASE_LOCAL_IMAGES_THUMBNAIL.'/'.$filesThumbnail[$a]);
	}


	//cambiar el articulo principal
	if(isset($_POST['artPrincipal'])) {
		$sql3 = "UPDATE articulos SET mejorArticulo = 0 WHERE mejorArticulo = 1";
		$prepared3 = $pdo->prepare($sql3);
		$prepared3->execute();


		$sql4 = "UPDATE articulos SET mejorArticulo = 1 WHERE id = :id";
		$prepared4 = $pdo->prepare($sql4);
		$prepared4->execute([
			'id' => $id
		]);
	}

	return render('./views/admin/editArticle.php', [ 'result' => $result ]);
});

$router->get('/admin/create', function() use($pdo) {
	return render('./views/admin/newArticle.php');
});

$router->post('/admin/create', function() use($pdo) {
	$file = isset($_FILES['file']['name']) ? $_FILES['file']['name'] : '';
	$tmp_name = isset($_FILES['file']['tmp_name']) ? $_FILES['file']['tmp_name'] : '';
	$sql = "INSERT INTO articulos (fechaHora, titulo, resumen, idUsuario, textoArticulo, fotoPrincipal, activo, publicado, fechaHoraModificacion, fechaHoraPublicacion, idUsuarioModificacion) VALUES (:fechaHora, :titulo, :resumen, :idUsuario, :textoArticulo, :fotoPrincipal, :activo, :publicado, :fechaHoraModificacion, :fechaHoraPublicacion, :idUsuarioModificacion)";
	$prepared = $pdo->prepare($sql);
	$result = $prepared->execute([
		'fechaHora' => date("Y-m-d H:i:s"),
		'titulo' => limpiarDatos($_POST['title']),
		'resumen' => limpiarDatos($_POST['summary']),
		'idUsuario' => 1,
		'textoArticulo' => '',
		'fotoPrincipal' => $file,
		'activo' => true,
		'publicado' => false,
		'fechaHoraModificacion' => '',
		'fechaHoraPublicacion' => '',
		'idUsuarioModificacion' => 1
	]);
	$id = $pdo->lastInsertId();
	$carpeta = BASE_LOCAL_IMAGE . $id;
	$rutaFoto = '';
	if(!file_exists($carpeta)) {
		mkdir($carpeta);
		$rutaFoto =$carpeta . '/principal';
		if(!file_exists($rutaFoto)) {
			mkdir($rutaFoto);			
		}
	}

	if(!empty($file) && !empty($tmp_name)) {
		move_uploaded_file($tmp_name, $rutaFoto . '/' . $file);
	}
	return render('./views/admin/newArticle.php', ['result' => $result]);
});


$router->get('/admin/p/{pagina}', function($pagina) use($pdo) {
	$postPorPagina = POSTSPORPAGINA;
	if(!$pagina) {
		$pagina = 1;
	};

	$inicio = $pagina > 1 ? $pagina * $postPorPagina - $postPorPagina : 0;

	$query = $pdo->prepare("SELECT SQL_CALC_FOUND_ROWS A.*, U.nombre FROM articulos as A INNER JOIN usuarios as U on A.idUsuario = U.id ORDER BY fechaHora DESC LIMIT $inicio, $postPorPagina");
	$query->execute();
	$articulos = $query->fetchAll(PDO::FETCH_ASSOC);

	$total_posts = $pdo->prepare("SELECT FOUND_ROWS() as total");
	$total_posts->execute();
	$total_posts = $total_posts->fetch()['total'];
	$numero_paginas = ceil($total_posts / POSTSPORPAGINA);

	
	return render('./views/admin/index.php', ['articulos'=> $articulos, 'totalPaginas' => $numero_paginas, 'paginaActual' => $pagina]);
});

$router->get('/admin/articlePublished/{id}', function($id) use($pdo) {	
    if($_SESSION['usuario'] === '') {
        header('Location: ' . './../login');
    } else {
    	$sql = "SELECT publicado, mejorArticulo FROM articulos WHERE id = :id";
		$prepared = $pdo->prepare($sql);
		$prepared->execute([
			'id' => $id
		]);
		$rta = $prepared->fetchAll(PDO::FETCH_ASSOC);

		if($rta[0]['mejorArticulo'] == 1) {
			$articles = '';
		} else {
			$sql1 = "UPDATE articulos set publicado = :publicado, fechaHoraPublicacion = :fechaHoraPublicacion WHERE id = :id";
			$prepared1 = $pdo->prepare($sql1);
			$articles = $prepared1->execute([
				'publicado' => !$rta[0]['publicado'],
				'fechaHoraPublicacion' => date("Y-m-d H:i:s"),
				'id' => $id
			]);			
		}

		return render('./views/admin/articlePublished.php', ['articles' => $articles]);
    }	
});

$router->get('/{id}', function($id) use($pdo) {
	$sql = "SELECT A.*, DATEDIFF(now(), fechaHoraPublicacion) as dias, U.rutaImagen, U.nombreParaMostrar FROM articulos A JOIN usuarios U on U.id = A.idUsuario WHERE A.id = :id";
	$prepared = $pdo->prepare($sql);
	$prepared->execute(array('id'=>$id));
	$articulo = $prepared->fetchAll(PDO::FETCH_ASSOC);

	return render('./views/article.php', ['articulo' => $articulo]);
});

$router->get('/p/{pagina}',function($pagina) use($pdo) {
	$postPorPagina = POSTSPORPAGINA;
	if(!$pagina) {
		$pagina = 1;
	};

	$inicio = $pagina > 1 ? $pagina * $postPorPagina - $postPorPagina : 0;

	$sql = "SELECT SQL_CALC_FOUND_ROWS A.id, A.titulo, A.resumen, A.fotoPrincipal, U.nombreParaMostrar, U.rutaImagen, DATEDIFF(now(), A.fechaHoraPublicacion) as dias, A.mejorArticulo FROM articulos A JOIN usuarios U on U.id = A.idUsuario WHERE publicado = 1 ORDER BY A.fechaHoraPublicacion DESC LIMIT $inicio, $postPorPagina";
	$prepared = $pdo->prepare($sql);
	$prepared->execute();
	$articulos = $prepared->fetchAll(PDO::FETCH_ASSOC);

	$total_posts = $pdo->prepare("SELECT FOUND_ROWS() as total");
	$total_posts->execute();
	$total_posts = $total_posts->fetch()['total'];
	$numero_paginas = ceil($total_posts / POSTSPORPAGINA);

	$sql = "SELECT A.id, A.titulo, U.nombreParaMostrar, U.rutaImagen, DATEDIFF(now(), A.fechaHoraPublicacion) as dias, A.fotoPrincipal FROM articulos A JOIN usuarios U on U.id = A.idUsuario WHERE A.activo = 1 and A.mejorArticulo = true";
	$prepared = $pdo->prepare($sql);
	$prepared->execute();
	$mejorArticulo = $prepared->fetchAll(PDO::FETCH_ASSOC);



	return render('./views/articles.php', ['articulos' => $articulos, 'mejorArticulo' => $mejorArticulo, 'totalPaginas' => $numero_paginas, 'paginaActual' => $pagina ]);
});

 ?>