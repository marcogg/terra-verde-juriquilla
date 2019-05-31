<?php
 
if(isset($_POST['email'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "mgarcia@grupohodaya.com";
 
    $email_subject = "Mail-Contacto";
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
 
       
		echo "<script>alert('Lo sentimos, pero no se pudo enviar el correo correctamente, intentalo de nuevo'); location.href='http://terraverdejuriquilla.com/#contacto'</script>";


 
        echo $error."<br /><br />";
 
        echo "Intentalo de nuevo por favor.<br /><br />";
 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['first_name']) ||
  
        !isset($_POST['email']) ||

        !isset($_POST['last_name']) ||
 
        !isset($_POST['tel']) ||
 
        !isset($_POST['comments'])) {
 
      echo "<script>alert('Mensaje enviado, en breve un ejecutivo se pondrá en contacto con usted'); location.href='http://terraverdejuriquilla.com/#contacto' </script>";

 
    }
 
     
 
    $first_name = $_POST['first_name']; // required

    $last_name = $_POST['last_name']; // required
  
    $email_from = $_POST['email']; // required
 
    $email_telephone = $_POST['telephone']; // not required
 
    $comments = $_POST['comments']; // required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= "<script>alert('El correo es invalido'); location.href='http://terraverdejuriquilla.com/#contacto'</script>";
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
 
    $error_message .= "<script>alert('El nombre no es valido'); location.href='http://terraverdejuriquilla.com/#contacto' </script>";;
 
  }

  $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$last_name)) {
 
    $error_message .= "<script>alert('El apellido no es valido'); location.href='http://terraverdejuriquilla.com/#contacto' </script>";;
 
  }

    $string_exp = 
    $email_exp = '/^[0-9]/';
 
  if(!preg_match($string_exp,$email_telephone)) {
 
    $error_message .= "<script>alert('El teléfono no es valido'); location.href='http://terraverdejuriquilla.com/#contacto' </script>";;
 
  }

 
  if(strlen($comments) < 2) {
 
    $error_message .=  "<script>alert('El mensaje es demasiado corto, porfavor escribe algo más'); location.href='http://terraverdejuriquilla.com/#contacto' </script>";
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "Detalles de contacto.\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "Nombre: ".clean_string($first_name)."\n";

    $email_message .= "Apellido: ".clean_string($last_name)."\n";
  
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Tel: ".clean_string($email_telephone)."\n";
 
    $email_message .= "Mensaje: ".clean_string($comments)."\n";
 
     
 
     
 
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);  
 
?>
 
 
 
<!-- include your own success html here -->
 
 
 
<script>alert('Correo enviado'); location.href='http://terraverdejuriquilla.com/#contacto';</script>
 
 
 
<?php
 
}
 
?>
</body>
</html>