<?php
 
if(isset($_POST['mail'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "digital@grupohodaya.com, mgarcia@grupohodaya.com";
    $email_subject = "Terra Verde Juriquilla: Nueva entrada desde Descarga de Brochure";
 
    function died($error) {
        // your error code can go here
        echo '<script type="text/javascript">alert("Lo sentimos, hemos detectado un error en el formulario enviado");
        window.location.href = "index.php";</script>';
        echo '<script type="text/javascript">alert("Ha ocurrido un error.");
        window.location.href = "index.php";</script>';
        echo $error."<br /><br />";
        echo '<script type="text/javascript">alert("Por favor revise los datos del formulario");
        window.location.href = "index.php";</script>';
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        //!isset($_POST['last_name']) ||
        !isset($_POST['mail']) ||
        !isset($_POST['telephone']) //||
        //!isset($_POST['comments'])
      )
         {
        died('Ha ocurrido un error, intente más tarde.');       
    }
 
     
 
    $first_name = $_POST['first_name']; // required
    //$last_name = $_POST['last_name']; // required
    $email_from = $_POST['mail']; // required
    $telephone = $_POST['telephone']; // not required
    //$comments = $_POST['comments']; // required
    //$estado = $_POST['estado']; //not required
    //$selected_val=$_POST['estado'];
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= '<script type="text/javascript">alert("El email ingresado parece ser no válido");
    window.location.href = "index.php";</script>';
  }
 
    $string_exp = "/^[A-Za-z .'-áéíóúñüÁÉÍÓÚÑÜ]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= '<script type="text/javascript">alert("El nombre ingresado no tiene un formato válido<br />");
    window.location.href = "index.php";</script>';
  }
 
  /*if(!preg_match($string_exp,$last_name)) {
    $error_message .= '<script type="text/javascript">alert("El apellido ingresado no tiene un formato válido<br />");
    window.location.href = "index.php";</script>';
  }*/
 
  /*if(strlen($comments) < 2) {
    $error_message .= '<script type="text/javascript">alert("El mensaje no tien un formato válido<br />");
    window.location.href = "index.html";</script>';
  }*/
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Datos ingresados en el formulario.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
    $email_message .= "Nombre: ".clean_string($first_name)."\n"; 
    //$email_message .= "Apellido: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Tel: ".clean_string($telephone)."\n";
    //$email_message .= "Estado: ".clean_string($selected_val)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n".
'X-Mailer: PHP/' . phpversion();
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .='Content-type: text/html; charset=UTF-8' . "\r\n";
@mail($email_to, $email_subject, $email_message, $headers);  

/* send to 2nd recipient */
$to_2 = $email_form;
$from = "no-responder@terraverdejuriquilla.com";
$subject_2 = " Terra Verde Juriquilla: Gracias por descargar nuestro brochure";
$message_2 = 'mail-gracias.html';

$headers_2 = 'De: ' . $from . "\r\n";
$headers_2 .= "MIME-Version: 1.0" . "\r\n";
$headers_2 .= "Content-type:text/html;charset=utf-8" . "\r\n";

@mail($to_2, $subject_2, $message_2, $headers_2);

?>
 
<!-- include your own success html here -->

<script type="text/javascript">
  window.location.href = "gracias_folleto.php";
</script>



<?php
 
}
?>