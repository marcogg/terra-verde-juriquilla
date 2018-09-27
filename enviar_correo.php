<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<?php
 
if(isset($_POST['email'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "mgarcia@grupohodaya.com";
 
    $email_subject = "Mail-Contacto";
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
 
       
		echo "<script>alert('Lo sentimos, pero no se pudo enviar el correo correctamente, intentalo de nuevo');</script>";


 
        echo $error."<br /><br />";
 
        echo "Intentalo de nuevo por favor.<br /><br />";
 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['first_name']) ||
  
        !isset($_POST['email']) ||
 
        !isset($_POST['tel']) ||
 
        !isset($_POST['comments'])) {
 
      echo "<script>alert('Lo sentimos, el correo no se pudo enviar'); </script>";

 
    }
 
     
 
    $first_name = $_POST['first_name']; // required
  
    $email_from = $_POST['email']; // required
 
    $email_subject = $_POST['tel']; // not required
 
    $comments = $_POST['comments']; // required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= "<script>alert('El correo es invalido');</script>";
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
 
    $error_message .= "<script>alert('El nombre no es valido'); </script>";;
 
  }
 
  
 
  if(strlen($comments) < 2) {
 
    $error_message .=  "<script>alert('El mensaje es demasiado corto, porfavor escribe algo más'); </script>";
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "Form details below.\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "Nombre: ".clean_string($first_name)."\n";
  
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Teléfono: ".clean_string($email_subject)."\n";
 
    $email_message .= "Mensaje: ".clean_string($comments)."\n";
 
     
 
     
 
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);  
 
?>
 
 
 
<!-- include your own success html here -->
 
 
 
echo "<script>alert('Correo enviado'); location.href='http://terraverdejuriquilla.com/#contacto';</script>";
 
 
 
<?php
 
}
 
?>
</body>
</html>