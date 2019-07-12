<?php 
class Utilities{

	public function getPaging($page, $total_rows, $records_per_page, $page_url){
		$paging_arr = array();

		// primer pagina
		$paging_arr['first'] = $page>1 ? "{$page_url}page=1" : "";

		// cuento el total de articulo en la bd para calcular la cantidad de paginas
		$total_pages = ceil($total_rows / $records_per_page);
		$range = 2;

		$initial_num = $page - $range;
		$condition_limit_num = ($page + $range) + 1;

		$paging_arr['pages'] = array();
		$page_count = 0;

		for($x=$initial_num; $x<$condition_limit_num; $x++){
			// pregunto si $x es mayor que 0 y menor que el total de paginas
			if(($x > 0) && ($x <= $total_pages)){
				$paging_arr['pages'][$page_count]["page"] = $x;
				$paging_arr['pages'][$page_count]["url"] = "{$page_url}page={$x}";
				$paging_arr['pages'][$page_count]["current_page"] = $x == $page ? "yes" : "no"; 

				$page_count++;
			}
		}

		// ultima pagina
		$paging_arr['last'] = $page < $total_pages ? "{$page_url}page={$total_pages}" : "";

		// retorno en json
		return $paging_arr;
	}
}

?>