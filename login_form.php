

<main>

<?php
$imagePath = $rootUrl.'images/logo_gbaf.png';
?>

<img src="<?php echo $imagePath; ?>" alt="Logo de GBAF" class="logo-gbaf">

<h1> Connexion / Inscription </h1>
<p> Si vous êtes nouveau, cliquez sur "S'inscrire" <p>
<p> Si vous êtes déjà inscrit, veuillez remplir les champs "Pseudo" et "Mot de passe" puis validez</p>
<p> Si vous déjà inscrit, mais que vous avez oublié votre mot de passe, vous pourrez renseigner un nouveau mot de passe en cliquant sur 
    "Mot de passe oublié"  <p>
<p> Si vous êtes nouveau, cliquez sur "S'inscrire" <p>

 

<h2>Connexion</h2>

<form method="post" action="users/login_check.php" class="class-user-form formulaire">

<div class="element-formulaire">
    <label for="username" class="label-formulaire">Pseudo</label>         
    <input type="text" required id="username" name="username" class="input-formulaire">
</div>

<div class="element-formulaire">
    <label for="password" class="label-formulaire">Mot de passe</label> 
    <input type="password" required id="password" name="password" class="input-formulaire">
</div>        


<input type="submit" class="login-valider bouton" value="Valider">

<a href="users/forgot_pass_form.php" class="login-forgotten bouton petite-police">Mot de passe oublié</a>    
</form>     



<br><br>
<h2>Inscription</h2>
<a href="users/user_form.php" class="login-form bouton">S'inscrire</a>


</main>

