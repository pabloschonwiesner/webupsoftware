<section class="paginacion">
	<ul>
		<?php 
			$paginaActual = (int)$paginaActual;
			if($paginaActual === 1) {
				echo '<li><span class="paginas disabled">&laquo;</span></li>';
			} else {
				echo '<li><a class="paginas" href="' . BASE_URL . 'admin/p/' . ($paginaActual-1) . '">&laquo;</a></li>';
			};
			
			for ($i=1; $i <= $totalPaginas; $i++) { 
				if($paginaActual == $i) {
					echo '<li><a class="paginas active" href="' . BASE_URL . 'admin/p/' . $i . '" >' . $i . '</a></li>';	
				} else {
					echo '<li><a class="paginas" href="' . BASE_URL . 'admin/p/' . $i . '" >' . $i .  '</a></li>';			
				}
			} 

			if($paginaActual === (int)$totalPaginas) {
				echo '<li><span class="paginas disabled">&raquo;</span></li>';
			} else {
				echo '<li><a class="paginas" href="' . BASE_URL . 'admin/p/' . ($paginaActual+1) . '">&raquo;</a></li>';
			}

		?>
	</ul>
</section>