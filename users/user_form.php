
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">    
    <title>GBAF - Formulaire Paramètres</title>
    <link href="../styles.css" rel="stylesheet">    
</head>
<body>
<?php
include_once('../mysql.php');
include_once('../variables.php');
include_once('../functions.php');
?>



<?php
$imagePath = $rootPath.'images/logo_gbaf.png';
?>

<img src="<?php echo $imagePath; ?>" alt="Logo de GBAF" class="logo-gbaf">

<h1> Formulaire de Paramètres du compte utilisateur </h1>
<p> Tous les champs sont obligatoires </p>

<?php

if(!isset($_GET['username'])){
    /* si appel sans parametres on est en mode creation d'un nouvel utilisateur */
    $userLigne['nom'] = '';
    $userLigne['prenom'] = '';
    $userLigne['username'] = '';
    $userLigne['question'] = '';
    $userLigne['reponse'] = '';
    $userLigne['password'] = '';
    $boolUpdate = false;
}else{
    /* s'il y a un parametre, on est en mode modification */

    if(!user_already_recorded($_GET['username'])){
        echo(" Erreur dans user_form.php utilisateur absent en BDD ! ");
        //exit();
    }else{
        $boolUpdate = true;    
        $userLigne = get_user($_GET['username']);
    }
}
?>    

<form method="post" action="user_update_or_create.php" class="class-user-form">
<label for="nom">Nom</label> 
<input type="text" required name="nom" value=<?=$userLigne['nom'];?>>
<label for="prenom">Prénom</label> 
<input type="text" required name="prenom" value=<?=$userLigne['prenom'];?>>
<?php if($boolUpdate == false): ?>
    <label for="username">Pseudo</label>         
    <input type="text" required name="username" value=<?=$userLigne['username'];?>>
<?php else: ?>    
    <input type="hidden" name="username" value=<?=$userLigne['username'];?>>
<?php endif; ?>    
<label for="password">Mot de passe</label> 
<input type="password" required name="password" value=<?=$userLigne['password'];?>>
<label for="question">Question secrète</label> 
<input type="text" required name="question" value=<?=$userLigne['question'];?>>
<label for="reponse">Réponse</label> 
<input type="text" required name="reponse" value=<?=$userLigne['reponse'];?>>
<input type="hidden"  name="update" value=<?=$boolUpdate;?>>

<button type="submit" class="user-bouton-enregister">Enregistrer</button>
</form>     

<br><br>
<a href="../home.php" >Retour à la page d'accueil</a>

</body>

</html>