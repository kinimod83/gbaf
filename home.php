<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">    
    <title>GBAF - Page d'accueil</title>
    <link href="styles.css" rel="stylesheet">    
</head>
<body>

    

    <!-- Header -->
    <?php include_once('header.php'); ?>

    <?php if(isset($_SESSION['username'])): ?>

    <?php init_acteurs_table(); ?>

    <!-- Section Presentation -->
    <section class="section-presentation">
        <h1> Présentation du GBAF </h1>
        <p>Le Groupement Banque Assurance Français​ (GBAF) est une fédération représentant les 6 grands groupes français : 
        <ul>
            <li> BNP Paribas </li>
            <li> BPCE </li>
            <li> Crédit Agricole </li>
            <li> Crédit Mutuel-CIC </li>
            <li> Société Générale  </li>
            <li> La Banque Postale. </li>          
        </ul>                                                  
        Même s’il existe une forte concurrence entre ces entités, elles vont toutes travailler de la même façon pour gérer près de 80 millions de comptes sur le territoire national.<br>
        Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. Sa mission est de promouvoir l'activité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des pouvoirs publics.
        </p>
        <br>
        <img src='images/buildings_logos.jpg' alt='Logos Banques' class="logos-banques">        
    </section>

    <!-- ligne horizontale -->
    <hr>

    <!-- Section Acteur -->
    <section class="section-acteurs">
        <h2> Voici les acteurs que vous pouvez évaluer par un commentaire et/ou un like/dislike</h2>

        <?php for ($i = 0; $i < $nbActeurs; $i++):?>

            <div class=un-acteur>
            
                <?php $ligneActeur = $acteursTable[$i]; ?> 

                <?php $imagePath = $rootPath.'images/'.$ligneActeur['logo'];  ?>

                <img src="<?php echo $imagePath; ?>" alt="Logo Acteur" class="logo-acteur">

                <h3 class=texte-tronque> <?php echo $ligneActeur['description'];?> </h3>

                <div class="lire-la-suite">
                    <a href="actor.php?acteur_index=<?php echo($i);?>" class="texte-lire-la-suite">Lire la suite</a>
                </div>
            </div>

        <?php endfor; ?>

    </section>    

    <!-- Footer -->
    <?php include_once('footer.php'); ?>    

    <?php endif; ?>


</body>
</html>