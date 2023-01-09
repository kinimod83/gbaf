<!-- ne pas oublier le session_start() -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">    
    <title>GBAF - Page Acteur</title>
    <link href="styles.css" rel="stylesheet">    
</head>
<body>

    <!-- Recuperation de l'index de l'acteur dans le tableau acteursTable[] -->
    <?php $acteurIndex = $_GET['acteur_index'];?>

    <!-- le user ID est dans la variable $loggedUser['id_user'] -->


    <!-- Header -->
    <?php include_once('header.php'); ?>      

    <?php init_acteurs_table(); ?>

    <?php /*get_one_user_data(1 ); */?> 

    <?php $ligneActeur = $acteursTable[$acteurIndex]; ?> 

    <?php init_comment_table($ligneActeur['id_acteur']); ?>

    <?php $idUser = $loggedUser['id_user']; ?>

  


    <!-- Section Acteur-->
    <section class="act-section-acteur">
        <?php $imagePath = $rootPath.'images/'.$ligneActeur['logo'];  ?>
        <img src="<?php echo $imagePath; ?>" alt="Logo Acteur" class="act-logo-acteur">
        <h2><a href="https://openclassrooms.com/" class="act-visiter-le-site-web">Visiter le site WEB</a></h2>
        <h2 class=act-description> <?php echo $ligneActeur['description'];?> </h2>
    </section>

    <?php
        $idActeur = $ligneActeur['id_acteur'];
        $nomActeur = $ligneActeur['acteur'];
        $chaineParam = "?id_acteur=$idActeur";
        $chaineParam .= "&nom_acteur=$nomActeur";    
    ?>            

    <!-- Section Commentaires -->
    <section class="act-section-commentaires">
        <div class="act-ligne-commentaires">
            <h2><?php echo $nbCommentaires; ?> commentaire<?php if($nbCommentaires>1){echo "s";};?></h2>

            <!-- Bouton Nouveau commentaire -->
            <div class="act-nouveau-commentaire">
                <a href="comments/create.php<?php echo($chaineParam) ?>" class="act-nouveau-commentaire-texte">Nouveau commentaire</a>
            </div>

            
            <?php
                $boolUpdate = has_already_voted($idUser, $idActeur);
                if($boolUpdate){
                    $ligneVote = get_vote($idUser, $idActeur);
                    //echo "actor ici";
                    //var_dump($ligneVote);
                }else
                {
                    $ligneVote['id_vote'] = 0; // id fictif
                    $ligneVote['id_user'] =  $idUser;
                    $ligneVote['id_acteur'] =  $idActeur;   
                    $ligneVote['vote'] =  0; 
                }
                $vote =  $ligneVote['vote'];
                $idVote = $ligneVote['id_vote'];
                

                $nbLikes = get_total_votes($idActeur, 1);
                $nbDislikes = get_total_votes($idActeur, 2);

                //echo " likes $nbLikes dislikes $nbDislikes"

            ?>


            <!-- Zone des pouces levés et baissés -->
            <div class="act-thumbs" id="id_thumbs">
                <form method="post" action="vote_update_or_create.php" class="class-thumbs">
                <?php if($vote == 0 || $vote == 2): ?>
                    <button type="submit" name="like" class="btn-like"> <img src='images/inactive-thumb-up.png' alt="InactiveThumbUp"> </button>     
                <?php endif; ?>
                <?php if($vote == 1): ?>
                    <button type="submit" name="like" class="btn-like"> <img src='images/active-thumb-up.png' alt="ActiveThumb"> </button>     
                <?php endif; ?>  
                <label for="like"><?php echo "$nbLikes";?></label>  
                <?php if($vote == 0 || $vote == 1): ?>
                    <button type="submit" name="dislike" class="btn-dislike"> <img src='images/inactive-thumb-down.png' alt="InactiveThumbDown"> </button>     
                <?php endif; ?>
                <?php if($vote == 2 ): ?>
                    <button type="submit" name="dislike" class="btn-dislike"> <img src='images/active-thumb-down.png' alt="ActiveThumbDown"> </button>     
                <?php endif; ?>  
                <label for="dislike"><?php echo "$nbDislikes";?></label>                       

                <input type="hidden" name="bool_update" value=<?php echo("$boolUpdate");?>>
                <input type="hidden" name="vote" value=<?php echo("$vote");?>>
                <input type="hidden" name="id_vote" value=<?php echo("$idVote");?>>               
                <input type="hidden" name="id_acteur" value=<?php echo("$idActeur");?>>
                <input type="hidden" name="id_user" value=<?php echo("$idUser");?>>
                <input type="hidden" name="index_acteur" value=<?php echo("$acteurIndex");?>>
                </form>                
            </div>






    </div>  

        <?php for ($i = 0; $i < $nbCommentaires; $i++):?>

            <!-- Dans un cadre, en vertical, Prenom Date Texte -->
            <div class=act-un-commentaire>            
                <?php $ligneCommentaire = $commentairesTable[$i]; ?> 
                <p><?php echo $ligneCommentaire['prenom']; ?></p>
                <p><?php echo $ligneCommentaire['date_add']; ?></p>
                <p><?php echo $ligneCommentaire['post']; ?></p>
            </div>

        <?php endfor; ?>

    </section>    

    <!-- Footer -->
    <?php include_once('footer.php'); ?>
</body>
</html>