
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">    
    <title>GBAF - Formulaire Paramètres utilisateur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../styles.css" rel="stylesheet">    
</head>
<body>
<?php
include_once('../mysql.php');
include_once('../variables.php');
include_once('../functions.php');
?>



<?php
$imagePath = $rootUrl.'images/logo_gbaf.png';
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
    $boolUpdate = 0;
}else{
    /* s'il y a un parametre, on est en mode modification */

    if(!user_already_recorded($_GET['username'])){
        echo(" Erreur dans user_form.php utilisateur absent en BDD ! ");
        //exit();
    }else{
        $boolUpdate = 1;    
        $userLigne = get_user($_GET['username']);
    }
}
?>    

<form method="post" action="user_update_or_create.php" class="class-user-form formulaire">
 
<div class="element-formulaire"> 
<label for="nom" class="label-formulaire">Nom: </label>
<input type="text" required id="nom" name="nom" class="input-formulaire" value=<?=add_quotes($userLigne['nom']);?> >
</div>
<div class="element-formulaire"> 
<label for="prenom" class="label-formulaire">Prénom: </label> 
<input type="text" required id="prenom" name="prenom" class="input-formulaire" value=<?=add_quotes($userLigne['prenom']);?> >
</div>


<?php if($boolUpdate == false): ?>
    <div class="element-formulaire">     
    <label for="username" class="label-formulaire">Pseudo: </label>      
    <input type="text" required id="username" name="username" class="input-formulaire" value=<?=add_quotes($userLigne['username']);?> >
    </div>
<?php else: ?>    
    <input type="hidden" name="username" value=<?=add_quotes($userLigne['username']);?>>
<?php endif; ?>    
<div class="element-formulaire"> 
<label for="password" class="label-formulaire">Mot de passe: </label> 
<input type="password" required id="password" name="password" class="input-formulaire" value=<?=add_quotes($userLigne['password']);?> >
</div>

<div class="element-formulaire"> 
<label for="question" class="label-formulaire">Question secrète: </label> 
<input type="text" required size="40" id="question" name="question" class="input-formulaire" value=<?=add_quotes($userLigne['question']);?> >
</div>
<div class="element-formulaire"> 
<label for="reponse" class="label-formulaire">Réponse: </label> 
<input type="text" required size="40" id="reponse" name="reponse" class="input-formulaire" value=<?=add_quotes($userLigne['reponse']);?> >
</div>


<?php $tmpUpdate = (int)$boolUpdate;?> 
<input type="hidden"  name="update" value=<?=add_quotes($tmpUpdate);?>>



<input type="submit" class="user-bouton-enregister bouton" value="Enregister">
</form>     

<br><br>
<a href="../home.php" class="bouton">Retour à la page d'accueil</a>

</body>

</html>