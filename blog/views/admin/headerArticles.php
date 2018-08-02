<header class="headerWhite" id="header">
	<figure id="isologo">
		<a href="http://www.upsoftware.com.ar"><img src="<?php echo BASE_URL; ?>views/media/images/isologoBlack.svg" alt="Isologo UpSoftware" id="imgLogo"></a>
	</figure>
	<figure class="usuario">
		<?php 
			if(isset($_SESSION['usuario']) && $_SESSION['usuario'] !== "") {
				echo '<img src="' . BASE_LOCAL_IMAGES_WEB . 'usuarios/' . $_SESSION['rutaImagen'] . '" alt="' . BASE_LOCAL_IMAGES_WEB . 'usuarios/' . $_SESSION['rutaImagen'] .'" />';	
				echo '<span>' . $_SESSION['usuario'] . '</span>';	
				echo '<ul class="menu">';
				echo 	'<a href="' . BASE_BLOG_WEB . 'admin/cerrarSesion' . '" ><li>Cerrar Sesión</li></a>';
				echo '</ul>';
			}
		 ?>
	</figure>
</header>	
