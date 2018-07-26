<?php 
	$nombre = $_POST['nombre'];
	$empresa = $_POST['empresa'];
	$mail = $_POST['mail'];
	$telefono = $_POST['telefono'];
	$mensaje = $_POST['mensaje'];

	

	error_reporting(E_ALL);
	ini_set('display_errors',true);
	if(!isset($mail)){

	}else{

		$data = "Mensaje proveniente de www.upsoftware.com.ar";
		$data .= "\n Nombre: " . $nombre ;
		$data .= "\n Mail: " . $mail;
		$data .= "\n Telefono: " . $telefono;
		$data .= "\n Mensaje: " . $mensaje;
		$destino = "pschonwiesner@upsoftware.com.ar";
		$remitente = $mail;
		$asunto = "Contacto: " . $nombre;

		$mailheaders = "MIME-Version: 1.0 \r\n";  
		$mailheaders .= "Content-type: text/html; charset=iso-8859-1 \r\n";  
	    $mailheaders .= "From: $nombre <$mail> \r\n";  
	    $mailheaders .= "Return-path: $nombre <$mail> \r\n"; 
	    $mailheaders .= "X-Priority: 1 \r\n";  
	    $mailheaders .= "X-MSMail-Priority: High \r\n";  
	    $mailheaders .= "X-Mailer: PHP/".phpversion()." \n"; 
	    $resp = mail($destino, $asunto, $data, $mailheaders);		
	    echo $resp;

	}
?>