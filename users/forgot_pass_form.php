
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">    
    <title>GBAF - Formulaire question secrète</title>
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

<h2> Mot de passe oublié </h2>
<p> Veuillez renseigner les champs "Pseudo", "Question secrète" et "Réponse" que vous aviez remplis lors de votre inscription</p>
<p> Après avoir validé, vous pourrer modifier tous vos paramètres, dont votre mot de passe</p>

 

    <form method="post" action="question_check.php" class="class-question-form">

    <label for="username">Pseudo</label> 
    <input type="username" required name="username">    

    <label for="question">Question secrète</label>         
    <input type="text" required name="question">
  
    <label for="reponse">Réponse</label> 
    <input type="reponse" required name="reponse">    
    <button type="submit" class="question-valider">Valider</button>
    </form>     

    <a href="../home.php" class="question-home">Retour à l'accueil</a>


</body>

</html>