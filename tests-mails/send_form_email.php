<?php
//Inicio de validacion CAPTCHA
  /*if ($_SERVER["REQUEST_METHOD"]==="POST")
  {
    $recaptcha_secret = "6LeAmYwUAAAAADEcqmGuMoVuZNZY4jTQc3AecAsn"; //aqui va la clave secreta
    $recaptcha = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);

    $response = json_decode($response, true);
    if ($response["success"]===true) {
      echo "Verificación aprobada";
    }

    else{
      echo "Verificación no válida";
    }
  }*/
//Fin de validacion CAPTCHA

if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "mgarcia@grupohodaya.com";
    $email_subject = "Terra Verde Juriquilla - Nueva entrada en formulario desde Sitio Web";
 
    function died($error) {
        // your error code can go here
        echo '<script type=test/javascript>alert("Lo sentimos, hemos encontrado errores en el formulario, intenta nuevamente");</script>';
        echo '<script type=test/javascript>alert("Han ocurrido los siguientes errores.<br /><br />");</script>';
        echo $error."<br /><br />";
        echo '<script type=test/javascript>alert("Por favor, regrese al formulario y corrija los siguientes errores: <br /><br />");</script>';
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    $comments = $_POST['comments']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= echo'<script>alert("El e-mail ingresado no es válido"); window.location="index.html"</script>';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= echo'<script>alert("El nombre ingresado no es válido"); window.location="index.html"</script>';
  }

  if(!preg_match($string_exp,$last_name)) {
  $error_message .= echo'<script>alert("El apellido ingresado no es válido"); window.location="index.html"</script>';
  }
 
  if(!preg_match($string_exp,$telephone)) {
    $error_message .= echo'<script>alert("El teléfono ingresado no es válido"); window.location="index.html"</script>';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= echo'<script>alert("El mensaje ingresado no es válido"); window.location="index.html"</script>';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Datos de contacto:\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Nombre Completo: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Tel: ".clean_string($telephone)."\n";
    $email_message .= "Mensaje: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>
<script type="text/javascript">
  alert("Su mensaje ha sido enviado, en breve un ejecutivo lo contactará");
  window.location="index.html";
</script>
</body>
</html>



<?php
 
}
?>