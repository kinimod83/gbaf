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

if(!user_already_recorded($postData['username'])){
    echo("Ce pseudo n'existe pas :(");

}else{
    $userLigne=get_user($postData['username']);
    if($userLigne['password'] == $postData['password']){
        /* username et password OK, on connecte l'utilisateur */
        $_SESSION['username'] = $postData['username'];
        $loginCheck=true;
    }
    else{
        echo("Mauvais mot de passe :(");
    }
}

if($loginCheck == true){
    /* on revient a la home page silencieusement */
    header("location: ../home.php");
}
?>

<br><br>
<a href="../home.php" >Retour à la page d'accueil</a>





