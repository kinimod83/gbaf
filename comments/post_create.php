<?php
session_start();

include_once('./../mysql.php');

include_once('./../variables.php');
include_once('./../functions.php');

$postData = $_POST;

if (
    (!isset($postData['comment'])) ||
    (!isset($postData['id_acteur']))
    )
{
	echo('Le vote est invalide.');
    return;
}

if (!isset($_SESSION['username'])) {
    echo('Vous devez être authentifié pour soumettre un commentaire');
    return;
}else{
    $loggedUser = get_user($_SESSION['username']);

}


$comment = $postData['comment'];
$id_acteur = $postData['id_acteur'];


if(true){
    $insertComment = $mysqlClient->prepare('INSERT INTO posts(id_user, id_acteur, post) VALUES (:id_user, :id_acteur, :post)');
    $insertComment->execute([
        'id_user' => $loggedUser['id_user'],    
        'id_acteur' => $id_acteur,
        /* la date est positionnee automatiquement a la date du jour */
        'post' => strip_tags($comment)
    ]);

}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GBAF - Execution creation de commentaires</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo($rootUrl . 'styles.css'); ?>"rel="stylesheet">  
</head>
<body>
    <?php include_once('../header.php'); ?>

    <h2>Commentaire ajouté avec succès !</h2>
    
    <div class="comment-card">        
        <div class="comment-card-body">
            <p class="comment-card-text"><b>Votre commentaire</b> : <br><?php echo nl2br(strip_tags($comment)); ?></p>
        </div>
    </div>    
    <?php include_once('../footer.php'); ?>
</body>
</html>
