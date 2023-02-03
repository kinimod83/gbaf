<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">    
    <title>GBAF - Page Acteur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">    
</head>
<body>

    <!-- Recuperation de l'index de l'acteur dans le tableau acteursTable[] -->
    <?php $acteurIndex = $_GET['acteur_index'];?>

    


    <!-- Header -->
    <?php include_once('header.php'); ?>      


    <?php init_acteurs_table(); ?>


    <?php $ligneActeur = $acteursTable[$acteurIndex]; ?> 

    <?php init_comment_table($ligneActeur['id_acteur']); ?>

    <?php   
    if (!isset($_SESSION['username'])) {
        echo(' Erreur dans actor.php, pb connexion ');
        exit();
    }else{
        $loggedUser = get_user($_SESSION['username']);
    }    
    ?>

    <?php $idUser = $loggedUser['id_user']; ?>

  


    <!-- Section Acteur-->
    <section class="act-section-acteur">
        <?php $imagePath = $rootUrl.'images/'.$ligneActeur['logo'];  ?>
        <img src="<?php echo $imagePath; ?>" alt="Logo Acteur" class="act-logo-acteur logo">
        <a href="https://openclassrooms.com/" class="act-visiter-le-site-web bouton bloc-centre">Visiter le site WEB</a>
        <h2 class=act-description> <?php echo(nl2br($ligneActeur['description']));?> </h2>
    </section>

    <?php
        $idActeur = $ligneActeur['id_acteur'];
        $nomActeur= urlencode($ligneActeur['acteur']);
        $chaineParam = "?id_acteur=$idActeur";
        $chaineParam .= "&nom_acteur=$nomActeur";            
    ?>            
    <br><br>
    <!-- Section Commentaires -->
    <section class="act-section-commentaires">
        <div class="act-ligne-commentaires">
            <h2><?php echo $nbCommentaires; ?> commentaire<?php if($nbCommentaires>1){echo "s";};?></h2>

            <!-- Bouton Nouveau commentaire -->
            <div class="act-nouveau-commentaire bouton">
                <?php if(has_already_commmented($idActeur,$idUser)): ?>
                    <a href="comments/post_delete.php<?php echo($chaineParam) ?>" >Supprimer votre commentaire</a> 
                <?php else:  ?>                      
                    <a href="comments/create.php<?php echo($chaineParam) ?>" >Nouveau commentaire</a>   
                <?php endif;?>         
            </div>

            
            <?php
                $boolUpdate = has_already_voted($idUser, $idActeur);
                if($boolUpdate){
                    $ligneVote = get_vote($idUser, $idActeur);
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
                    <input type="submit" id="like" name="like" class="btn-thumb btn-like-inactive" value="">  
                <?php endif; ?>
                <?php if($vote == 1): ?>
                    <input type="submit" id="like" name="like" class="btn-thumb btn-like-active" value="">
                <?php endif; ?>  
                <label for="like"><?php echo "$nbLikes";?></label>  
                <?php if($vote == 0 || $vote == 1): ?>
                    <input type="submit" id="dislike" name="dislike" class="btn-thumb btn-dislike-inactive " value=""> 
                <?php endif; ?>
                <?php if($vote == 2 ): ?>
                    <input type="submit" id="dislike" name="dislike" class="btn-thumb btn-dislike-active" value="">   
                <?php endif; ?>  
                <label for="dislike"><?php echo "$nbDislikes";?></label>                       

                <?php $tmpUpdate=(int) $boolUpdate?>
                <input type="hidden" name="bool_update" value=<?=add_quotes($tmpUpdate);?> >
                <input type="hidden" name="vote" value=<?=add_quotes($vote);?> >
                <input type="hidden" name="id_vote" value=<?=add_quotes($idVote);?> >               
                <input type="hidden" name="id_acteur" value=<?=add_quotes($idActeur);?> >
                <input type="hidden" name="id_user" value=<?=add_quotes($idUser);?> >
                <input type="hidden" name="index_acteur" value=<?=add_quotes($acteurIndex);?> >
                </form>                
            </div>






    </div>  

        <br>
        <?php for ($i = 0; $i < $nbCommentaires; $i++):?>            
            <?php $ligneCommentaire = $commentairesTable[$i]; ?> 

            <?php if($idUser == $ligneCommentaire['id_user']): ?>
            <!-- on commence par le commentaire de l'utilisateur connecté (s'il existe) -->
            
                <div class=act-un-commentaire>                                
                <p><strong><?php echo $ligneCommentaire['prenom']; ?></strong></p>                    
                    <p><?php echo $ligneCommentaire['comment_date']; ?></p>
                    <p><?php echo(nl2br($ligneCommentaire['post'])); ?></p>
                    <br>
                </div>
            <?php endif; ?>

        <?php endfor; ?>    

        <?php for ($i = 0; $i < $nbCommentaires; $i++):?>
            <?php $ligneCommentaire = $commentairesTable[$i]; ?> 
            <?php if($idUser != $ligneCommentaire['id_user']): ?>
                <!-- Dans un cadre, en vertical, Prenom Date Texte -->
                <div class=act-un-commentaire>            
                    <p><strong><?php echo $ligneCommentaire['prenom']; ?></strong></p>                    
                    <p><?php echo $ligneCommentaire['comment_date']; ?></p>
                    <br>
                    <p><?php echo(nl2br($ligneCommentaire['post'])); ?></p>
                </div>
            <?php endif; ?>                

        <?php endfor; ?>

    </section>    

    <!-- Footer -->
    <?php include_once('footer.php'); ?>
</body>
</html>