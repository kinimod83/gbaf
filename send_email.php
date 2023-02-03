<?php
  if(isset($_POST['email'])) {
    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $email_address = $_POST['email'];
    $message = $_POST['message'];
    
    $to = 'contact@dominique-ferre.fr';
    $email_subject = "Formulaire de contact: $name $firstname";
    $email_body = $message;
    $headers = "From: noreply@dominique-ferre.fr\n";
    $headers .= "Reply-To: $email_address";   
    mail($to,$email_subject,$email_body,$headers);
  }
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">    
    <title>GBAF - Execution formulaire de contact</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link href="styles.css" rel="stylesheet">    
</head>
<body>
<?php
include_once('mysql.php');
include_once('variables.php');
include_once('functions.php');
?>


<h2> Message envoyé </h2>
<br>

<a href="home.php" class="contact-home bouton ">Accueil</a>

</body>