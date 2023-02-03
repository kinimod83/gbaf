<?php
session_start();

include_once('./../mysql.php');

include_once('./../variables.php');
include_once('./../functions.php');



if (!isset($_SESSION['username'])) {
    echo('Vous devez être authentifié pour soumettre un commentaire');
    return;
}else{
    $loggedUser = get_user($_SESSION['username']);

}



if(true){
    $insertComment = $mysqlClient->prepare('DELETE FROM posts WHERE id_user = :id_user');
    $insertComment->execute([
        'id_user' => $loggedUser['id_user'],    
    ]);

}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GBAF - Execution suppression de commentaires</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link href="<?php echo($rootUrl . 'styles.css'); ?>"rel="stylesheet">  
</head>
<body>
    <?php include_once('../header.php'); ?>

    <h2>Commentaire supprimé avec succès !</h2>

    
    <br><br>
    <a href="../home.php" class="bouton">Retour à la page d'accueil</a>    

</body>
</html>
