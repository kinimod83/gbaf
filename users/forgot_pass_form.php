
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">    
    <title>GBAF - Formulaire question secrète</title>
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

<h2> Mot de passe oublié </h2>
<p> Veuillez renseigner les champs "Pseudo", "Question secrète" et "Réponse" que vous aviez remplis lors de votre inscription.</p>
<p> Après avoir validé, vous pourrez modifier tous vos paramètres, dont votre mot de passe.</p>

 

    <form method="post" action="question_check.php" class="class-question-form formulaire">

    <div class="element-formulaire">
        <label for="username" class="label-formulaire">Pseudo</label> 
        <input type="text" required id="username" name="username" class="input-formulaire">    
    </div>

    <div class="element-formulaire">
        <label for="question" class="label-formulaire">Question secrète</label>         
        <input type="text" required id="question" name="question" class="input-formulaire" size="40">
    </div>
  
    <div class="element-formulaire">
        <label for="reponse" class="label-formulaire">Réponse</label> 
        <input type="text" required id="reponse" name="reponse" class="input-formulaire" size="40">   
    </div>        

    <input type="submit" class="question-valider bouton" value="Valider">
    </form>     

    <br><br>
    <a href="../home.php" class="question-home bouton">Retour à l'accueil</a>


</body>

</html>