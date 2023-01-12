
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">    
    <title>GBAF - Formulaire de login</title>
    <link href="styles.css" rel="stylesheet">    
</head>
<body>
<?php
include_once('mysql.php');
include_once('variables.php');
include_once('functions.php');
?>



<?php
$imagePath = $rootPath.'images/logo_gbaf.png';
?>

<img src="<?php echo $imagePath; ?>" alt="Logo de GBAF" class="logo-gbaf">

<h1> Connexion / Inscription </h1>
<p> Si vous êtes nouveau, cliquez sur "S'inscrire" <p>
<p> Si vous êtes déjà inscrit, veuillez remplir les champs "Pseudo" et "Mot de passe" puis validez</p>
<p> Si vous déjà inscrit, mais que vous avez oublié votre mot de passe, vous pourrez renseigner un nouveau mot de passe en cliquant sur 
    "Mot de passe oublié"  <p>
<p> Si vous êtes nouveau, cliquez sur "S'inscrire" <p>

 

    <h2>Connexion</h2>

    <form method="post" action="users/login_check.php" class="class-user-form">

    <label for="username">Pseudo</label>         
    <input type="text" required name="username">
  
    <label for="password">Mot de passe</label> 
    <input type="password" required name="password">

    
    <button type="submit" class="login-valider">Valider</button>
    </form>     

    <a href="users/forgot_pass_form.php" class="login-forgotten">Mot de passe oublié</a>


    <h2>Inscription</h2>
    <a href="users/user_form.php" class="login-form">S'inscrire</a>


</body>

</html>