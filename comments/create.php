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
<html>
<head>
    <meta charset="UTF-8">    
    <title>GBAF - Page Acteur</title>
    <link href="<?php echo($rootUrl . 'styles.css'); ?>"rel="stylesheet">    
</head>
<body>

    <!-- Header -->
    <?php include_once('../header.php'); ?>


    <form action="<?php echo($rootUrl . 'comments/post_create.php'); ?>" method="POST" class="comment-formulaire-comment">
        <div class="comment-label">
            <label for="comment" >Postez un commentaire pour <strong><?php echo($getData['nom_acteur']);?></strong></label>        
        </div>
            <textarea placeholder="Soyez objectifs et factuels" id="comment" name="comment" class="comment-textarea"></textarea>
            <input type="hidden" id="id_acteur" name="id_acteur" value=<?php echo($getData['id_acteur']); ?>>
            <button type="submit" class="comment-bouton-envoyer">Envoyer</button>
    </form>




    <!-- Footer -->
    <?php include_once('../footer.php'); ?>

</body>
