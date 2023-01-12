<?php

if(!isset($_POST['username']) || !isset($_POST['question'])
        || !isset($_POST['question'])
){
    echo('Erreur quesiton_check.php parametre absent');
    exit();
}

$postData = $_POST;

//echo(" question_check 1 ");

include_once('../mysql.php');
include_once('../variables.php');
include_once('../functions.php');

$questionCheck=false;

if(!user_already_recorded($postData['username'])){
    echo("Ce pseudo n'existe pas :(");

}else{
    $userLigne=get_user($postData['username']);
    if($userLigne['question'] == $postData['question']
        && $userLigne['reponse'] == $postData['reponse']
    ){
        $questionCheck=true;
    }
    else{
        echo("Question / reponse incohérentes :(");
    }
}

if($questionCheck == true){
    /* question et reponse sont OK, on connecte l'utilisateur et on ouvre la page du formulaire des parametres en mode update */
    $_SESSION['username'] = $postData['username'];   
    $chaine = "location: user_form.php?username=" .$postData['username']; 
    header($chaine);
}
?>

<br><br>
<a href="../home.php" >Retour à la page d'accueil</a>





