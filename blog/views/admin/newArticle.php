<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo artículo de Blog | Up Software</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/normalize.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/demo.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/medium-editor.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/default.css">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" sizes="16x16" href="./../media/images/favicon.ico">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/medium-editor-insert-plugin.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/adminBlog.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/admin/css/newArticle.css">
	<?php include_once 'views/admin/headerArticles.php'; ?>
</head>
<body>
    <?php 
        if(!isset($_SESSION['usuario']) || $_SESSION['usuario'] === '') {
            header('Location: ' . './login');
        }
     ?>
	<div class="container">
		<div class="row">
			<h1 class="mx-auto">Nuevo Artículo</h1>            
		</div>
        <div class="row">
            <p class="observacion">Imagen principal: // Imagenes en articulos: 10Mb max, 1920x1080 px max</p>
        </div>
		<div class="row">
			<div class="col-md-12">

				<a class="btn btn-primary space" href="<?php echo BASE_URL; ?>admin/p/1">Volver</a>
				<?php 
                    if(isset($result) && $result) {
						echo '<div class="alert alert-success role="alert">Articulo agregado!</div>';
                        header("refresh:3; url=./../admin/p/1");
					}
				?>
				<form method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="title">Titulo</label>
						<input type="text" name="title" id="title" class="form-control">
					</div>
					<div class="form-group">
						<label for="summary">Resumen</label>
						<input type="text" name="summary" id="summary" class="form-control">
					</div>
					<div class="form-group">
						<label for="file">Foto principal</label>
						<input type="file" name="file" id="file" class="form-control">
					</div>
					<input class="btn btn-primary" type="submit" value="Guardar" id="btnSave">
				</form>
		</div>
	</div>
	<script src="<?php echo BASE_URL; ?>../views/admin/js/jquery.min.js"></script>
    <script src="<?php echo BASE_URL; ?>../views/admin/js/jquery.ui.widget.js"></script>
    <script src="<?php echo BASE_URL; ?>../views/admin/js/jquery.iframe-transport.js"></script>
    <script src="<?php echo BASE_URL; ?>../views/admin/js/jquery.fileupload.js"></script>
    <script src="<?php echo BASE_URL; ?>../views/admin/js/medium-editor.js"></script>
    <script src="<?php echo BASE_URL; ?>../views/admin/js/handlebars.runtime.min.js"></script>
    <script src="<?php echo BASE_URL; ?>../views/admin/js/jquery-sortable-min.js"></script>
    <script src="<?php echo BASE_URL; ?>../views/admin/js/medium-editor-insert-plugin.min.js"></script>
    
    <script src="<?php echo BASE_URL; ?>../views/admin/js/templates.js"></script>
    <script src="<?php echo BASE_URL; ?>../views/admin/js/core.js"></script>
    <script src="<?php echo BASE_URL; ?>../views/admin/js/embeds.js"></script>
    <script src="<?php echo BASE_URL; ?>../views/admin/js/images.js"></script>
    <!-- <script src="<?php echo BASE_URL; ?>../views/admin/js/newArticle.js"></script> -->

    <script>
        var editor = new MediumEditor('.editable', {
            toolbar: {
                    buttons: ['bold', 'italic', 'underline', 'strikethrough', 'anchor',
                    'quote', 'orderedlist', 'unorderedlist', 'indent', 'outdent', 'justifyLeft',
                    'justifyCenter', 'justifyRight', 'justifyFull', 'h2', 'h3', 'h4', 'image']
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
                            url: './../media/upload.php',
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
    <script src="<?php echo BASE_URL; ?>../views/admin/js/menu.js"></script>
</body>
</html>
