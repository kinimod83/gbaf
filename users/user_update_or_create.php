<?php

session_start();

if(!isset($_POST)){

    exit();
}

$postData = $_POST;


include_once('../mysql.php');
include_once('../variables.php');
include_once('../functions.php');


// comme les parametres viennent d'un formulaire avec tous les champs obligatoires, on ne check pas l'existence des parametres

$userLigne = [];

$userLigne['nom'] = $postData['nom'];
$userLigne['prenom'] = $postData['prenom'];
$userLigne['username'] = $postData['username'];
$userLigne['password'] = $postData['password'];
$userLigne['question'] = $postData['question'];
$userLigne['reponse'] = $postData['reponse'];

$boolUpdate = $postData['update'];

$usernameOK = true;

if(user_already_recorded($userLigne['username'])  && !$boolUpdate)
{
    echo('Ce pseudo existe déjà :('); 
    $usernameOK = false;
}else{
    /* on connecte l'utilisateur */
    $_SESSION['username'] = $postData['username']; 
    create_or_update_user($userLigne, $boolUpdate);
    header("location: ../home.php");
}

//var_dump($userLigne);
//var_dump($boolUpdate)

?>

<br><br>
<a href="../home.php" >Retour à la page d'accueil</a>







