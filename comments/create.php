<?php
    session_start();
    include_once('./../mysql.php');
    include_once('./../variables.php');
?>

<?php
$getData = $_GET;

if (!isset($getData['id_acteur']) )
{
	echo('Le commentaire est invalide, il manque ID acteur.');
    return;
}

if (!isset($getData['nom_acteur']) )
{
	echo("Le commentaire est invalide, il manque le nom de l'acteur.");
    return;
}


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">    
    <title>GBAF - Création d'un commentaire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo($rootUrl . 'styles.css'); ?>" rel="stylesheet">    
</head>
<body>

    <!-- Header -->
    <?php include_once('../header.php'); ?>


    <form action="<?php echo($rootUrl . 'comments/post_create.php'); ?>" method="POST" class="comment-formulaire-comment">
        <div class="comment-label">
            <label for="comment" >Postez un commentaire pour <strong><?php echo($getData['nom_acteur']);?></strong></label>        
        </div>
            <textarea required placeholder="Soyez objectifs et factuels" id="comment" name="comment" class="comment-textarea" cols='20' rows='5'></textarea>
            <input type="hidden" id="id_acteur" name="id_acteur" value=<?= add_quotes($getData['id_acteur']); ?> >
            <input type="submit" class="comment-bouton-envoyer bouton" value="Envoyer">

    </form>




    <!-- Footer -->
    <?php include_once('../footer.php'); ?>

</body>
