
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">    
    <title>GBAF - Formulaire de contact</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">    
</head>
<body>
<?php
include_once('mysql.php');
include_once('variables.php');
include_once('functions.php');
?>



<?php
$imagePath = $rootUrl.'images/logo_gbaf.png';
?>

<img src="<?php echo $imagePath; ?>" alt="Logo de GBAF" class="logo-gbaf">

<h1> Formulaire de contact <h1>

<form action="send_email.php" method="post" class="formulaire">
  <label for="name">Prénom:</label>
  <input type="text" id="name" name="name"><br>
  
  <label for="firstname">Nom:</label>
  <input type="text" id="firstname" name="firstname"><br>
  
  <label for="email">Email:</label>
  <input type="email" id="email" name="email"><br>

  <label for="message">Entrez votre message:</label>
  <textarea id="contact-message" name="message" class="contact-textarea"></textarea><br>  
  
  <input type="submit" value="Envoyer" class="bouton">
</form>

<br>
<a href="home.php" class="contact-home bouton">Accueil</a>

