<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Editar artículo de Blog | Up Software</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/normalize.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/demo.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/medium-editor.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/default.css">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/medium-editor-insert-plugin.min.css">
    <link rel="icon" type="image/x-icon" sizes="16x16" href="./../media/images/favicon.ico">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/adminBlog.css">
	<link rel="stylesheet" href="./../../views/admin/css/editArticle.css">
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

			<h1 class="mx-auto">Editar Artículo</h1>
		</div>
		<div class="row">
			<div class="col-md-12">
				<a class="btn btn-primary" href="<?php echo BASE_URL; ?>admin/p/1">Volver</a>
				<?php  
					if(isset($result) && $result) {
						echo '<div class="alert alert-success role="alert">Articulo modificado!</div>';
						header("refresh:3; url=./../../admin/p/1");
					} else {
						echo '<form method="post" id="formBlog" >';
						foreach($articulo as $art) {		
                            if($art['mejorArticulo'] == 1) {
                                $mejorArticulo = true;
                            } else {
                                $mejorArticulo = false;
                            }

							echo '<div class="form-group" enctype="multipart/form-data">';
							echo	'<label for="title">Titulo</label>';
							echo	'<input type="text" name="title" id="title" class="form-control" value="' . $art['titulo'] . '">';
							echo '</div>';
							echo '<div class="form-group">';
							echo	'<label for="summary">Resumen</label>';
							echo	'<input type="text" name="summary" id="summary" class="form-control" value="' . $art['resumen'] . '">';
							echo '</div>';
							echo '<div class="form-group">';
							echo	'<label for="file">Foto principal</label>';
                            echo    '<p class="fotoSeleccionada"> Foto seleccionada: ' . $art['fotoPrincipal'] . '</p>';
							echo	'<input type="file" name="file" id="file" class="form-control" formenctype="multipart/form-data">';
                            echo '</div>';
                            echo '<div class="form-group">';
                            if($mejorArticulo) {
                                echo    '<label for="artPrincipal"><input type="checkbox" name="artPrincipal" id="desmarcaArtPpal" checked  />Articulo Principal</label>';
                            } else {
                                echo    '<label for="artPrincipal" ><input type="checkbox" name="artPrincipal" id="marcaArtPpal" />Articulo Principal</label>';
                            }
                            echo '</div>';
							echo '<textarea name="textoBlog" id="textoBlog" cols="30" rows="10" class="editable">' . $art['textoArticulo'] . '</textarea>';
						}					
						echo '<br>';
						echo '<input class="btn btn-primary" type="submit" value="Guardar" id="btnSave">';
						echo '</form>';
					}
				?>
		</div>
	</div>
	<!-- <script src="<?php echo BASE_URL; ?>../views/admin/js/jquery.min.js"></script> -->
    <script src="<?php echo BASE_URL; ?>./js/jquery.min.js"></script>
    <script src="<?php echo BASE_URL; ?>./js/jquery.ui.widget.js"></script>
    <script src="<?php echo BASE_URL; ?>./js/jquery.iframe-transport.js"></script>
    <script src="<?php echo BASE_URL; ?>./js/jquery.fileupload.js"></script>
    <script src="<?php echo BASE_URL; ?>./js/medium-editor.js"></script>
    <script src="<?php echo BASE_URL; ?>./js/handlebars.runtime.min.js"></script>
    <script src="<?php echo BASE_URL; ?>./js/jquery-sortable-min.js"></script>
    <script src="<?php echo BASE_URL; ?>./js/medium-editor-insert-plugin.min.js"></script>
    
    <script src="<?php echo BASE_URL; ?>./js/templates.js"></script>
    <script src="<?php echo BASE_URL; ?>./js/core.js"></script>
    <script src="<?php echo BASE_URL; ?>./js/embeds.js"></script>
    <script src="<?php echo BASE_URL; ?>./js/images.js"></script>
    <script src="<?php echo BASE_URL; ?>./js/htmlspecialchars.js"></script>
    <script src="<?php echo BASE_URL; ?>./js/editArticle.js"></script>

    <script>
        var editor = new MediumEditor('.editable', {
            toolbar: {
                    buttons: ['bold', 'italic', 'underline', 'strikethrough', 'anchor',
                    'quote', 'orderedlist', 'unorderedlist', 'indent', 'outdent', 'justifyLeft',
                    'justifyCenter', 'justifyRight', 'justifyFull', 'h2', 'h3', 'h4']
                },
            placeholder: {
                text: 'Comenzar a escribir el blog acá...'
            }
        });

        $(function () {
            $('.editable').mediumInsert({
                editor: editor,                
                addons: {
                    images: {
                        fileUploadOptions: {
                            url: './../../media/upload.php',
                            acceptFileTypes: /(.|\/)(gif|jpeg|png|jpg)$/i,
                            loadImageMaxFileSize: 50000000,
                            imageForceResize: true,
                            disableImageResize: false
                        }
                    }
                }
            });
        });
    </script>
    <script src="<?php echo BASE_URL; ?>./js/menu.js"></script>
</body>
</html>
