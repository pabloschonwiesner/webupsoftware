<?php 

// mostrar errores
ini_set('display_errors', 1);
error_reporting(E_ALL);

// url inicial desarrollo
$home_url = "http://localhost:81/blog/api/";

// url inicial produccion
// $home_url = "http://www.upsoftware.com.ar/blog/api/";

// pagina devuelta por el parametro que llega en la URL, si no llega es 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// cantidad de articulos por pagina
$records_per_page = 15;

// calcular el desde de la sentencia LIMIT en el select
$from_record_num = ($records_per_page * $page) - $records_per_page;

?>