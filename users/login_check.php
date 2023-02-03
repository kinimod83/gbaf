<?php
session_start();


if(!isset($_POST['username']) || !isset($_POST['password'])){
    echo('Erreur login_check.php parametre absent');
    exit();
}

$postData = $_POST;

//echo(" login_ckeck 1 ");

include_once('../mysql.php');
include_once('../variables.php');
include_once('../functions.php');

$loginCheck=false;
$error=0;

if(!user_already_recorded($postData['username'])){
    $error = 1;    
}else{
    $userLigne=get_user($postData['username']);
    if($userLigne['password'] == $postData['password']){
        /* username et password OK, on connecte l'utilisateur */
        $_SESSION['username'] = $postData['username'];
        $loginCheck=true;
    }
    else{
        $error=2;
    }
}

if($loginCheck == true){
    /* on revient a la home page silencieusement */
    header("location: ../home.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">    
    <title>GBAF - Execution login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../styles.css" rel="stylesheet">    
</head>
<body>

<br><br>

<?php
if($error == 1){
    echo("Ce pseudo n'existe pas :(");
}else if($error == 2){
    echo("Mauvais mot de passe :(");
}
?>


<br><br>
<a href="../home.php" class="bouton">Retour à la page d'accueil</a>

</body>




