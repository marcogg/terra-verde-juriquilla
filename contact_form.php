<?php
if($_POST)
{
require('constant.php');
    
    $user_name      = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    //user_last    	= filter_var($_POST["lastname"], FILTER_SANITIZE_STRING);
    $user_email     = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $user_phone     = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
    $content   = filter_var($_POST["content"], FILTER_SANITIZE_STRING);
    
    if(empty($user_name)) {
		$empty[] = "<b>Nombre</b>";		
	}
	/*if(empty($user_last)) {
		$empty[] = "<b>Apellido</b>";		
	}*/
	if(empty($user_email)) {
		$empty[] = "<b>Email</b>";
	}
	if(empty($user_phone)) {
		$empty[] = "<b>Telefono</b>";
	}	
	if(empty($content)) {
		$empty[] = "<b>Mensaje</b>";
	}
	
	if(!empty($empty)) {
		$output = json_encode(array('type'=>'error', 'text' => implode(", ",$empty) . ' es campo requerido.'));
        die($output);
	}
	
	if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){ //email validation
	    $output = json_encode(array('type'=>'error', 'text' => '<b>'.$user_email.'</b> es un mail inváildo.'));
		die($output);
	}
	
	//reCAPTCHA validation
	if (isset($_POST['g-recaptcha-response'])) {
		
		require('component/recaptcha/src/autoload.php');		
		
		$recaptcha = new \ReCaptcha\ReCaptcha(SECRET_KEY, new \ReCaptcha\RequestMethod\SocketPost());

		$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

		  if (!$resp->isSuccess()) {
				$output = json_encode(array('type'=>'error', 'text' => '<b>Captcha</b> debe validarse'));
				die($output);				
		  }	
	}
	
	$toEmail = "digital@grupohodaya.com, mgarcia@grupohodaya.com, rcruz@grupohodaya.com, cherrera@grupohodaya.com, lsapien@grupohodaya.com, chernandez@grupohodaya.com";
	$mailHeaders = "De: " . $user_name . "<" . $user_email . ">\r\n";
	$mailBody = "Nombre: " . $user_name . "\n";
	//$mailBody .= "Apellido: " . $user_last . "\n";
	$mailBody .= "Email: " . $user_email . "\n";
	$mailBody .= "Tel: " . $user_phone . "\n";
	$mailBody .= "Mensaje: " . $content . "\n";




	if (mail($toEmail, "Terra Verde Juriquilla: Nueva entrada desde formulario de contacto", $mailBody, $mailHeaders)) {
	    /*$output = json_encode(array('type'=>'message', 'text' => 'Hola '.$user_name .', Gracias por escribirnos, en breve nos contactaremos'));
	    die($output);*/
	    $output = json_encode(array('type'=>'message', 'text' => '<script>window.location.href="gracias_contacto.php"</script>'));
	    die($output);
	} else {
	    $output = json_encode(array('type'=>'error', 'text' => 'Error en el envío, por favor escríbenos a: digital@grupohodaya.com'));
	    die($output);
	}
}
?>