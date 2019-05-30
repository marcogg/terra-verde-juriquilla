<?php



//----------------------------------------RECAPTCHA VALIDATION----------------------------------
$email;$comment;$captcha;
if(isset($_POST['email'])){
$email=$_POST['email'];
}
if(isset($_POST['g-recaptcha-response'])){
$captcha=$_POST['g-recaptcha-response'];
}
if(!$captcha){
echo '<script>alert("Captcha no validado, intenta nuevamente"); window.location.href="index.html";</script>';
exit;
}
$secretKey = "6LeAmYwUAAAAADEcqmGuMoVuZNZY4jTQc3AecAsn";
$ip = $_SERVER['REMOTE_ADDR'];
// post request to server
$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
$response = file_get_contents($url);
$responseKeys = json_decode($response,true);
// should return JSON with success as true
if($responseKeys["success"]) {
    //INICIO DE ENVIO MAIL--------------------------------------------------
      if(isset($_POST['email'])) {

      // EDIT THE 2 LINES BELOW AS REQUIRED
      $email_to = "mgarcia@grupohodaya.com";
      $email_subject = "Nueva entrada desde Descarga Brochure";



      // validation expected data exists
      if(!isset($_POST['first_name']) ||
      !isset($_POST['last_name']) ||
      !isset($_POST['email']) ||
      !isset($_POST['telephone']) //||
      //!isset($_POST['comments'])
      )
      {
      died('Ha ocurrido un error, intente más tarde.');
      }



      $first_name = $_POST['first_name']; // required
      $last_name = $_POST['last_name']; // required
      $email_from = $_POST['email']; // required
      $telephone = $_POST['telephone']; // not required
      //$comments = $_POST['comments']; // required
      //$estado = $_POST['estado']; //not required
      $selected_val=$_POST['estado'];

      $email_message = "Datos ingresados en el formulario.\n\n";


      function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
      }


      $email_message .= "Nombre: ".clean_string($first_name)."\n";
      $email_message .= "Apellido: ".clean_string($last_name)."\n";
      $email_message .= "Email: ".clean_string($email_from)."\n";
      $email_message .= "Tel: ".clean_string($telephone)."\n";
      $email_message .= "Estado: ".clean_string($selected_val)."\n";

      // create email headers
      $headers = 'From: '.$email_from."\r\n".
      'Reply-To: '.$email_from."\r\n".
      'X-Mailer: PHP/' . phpversion();
      $headers .= 'MIME-Version: 1.0' . "\r\n";
      $headers .='Content-type: text/html; charset=UTF-8' . "\r\n";
      
      @mail($email_to, $email_subject, $email_message, $headers);
      ?>
      <?php
}
      //FIN DE ENVIO MAIL-----------------------------------------------------------

 }else {
echo '<script>alert("Captcha no verificado, intenta nuevamente"); window.location.href="index.html";)</script>';
}

?>

<!-- include your own success html here -->
<script type="text/javascript">
alert("¡Gracias! Puede descargar el folleto completo después de cerrar este mensaje");
window.location.href="https://drive.google.com/file/d/1umYNwYkYj9YbHfIOY1X_A5z2QsHd5-jz/view?usp=sharing";
</script>



