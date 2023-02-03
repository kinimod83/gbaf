<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">    
    <title>GBAF - Page d'accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link href="styles.css" rel="stylesheet">    
</head>
<body>

    

    <!-- Header -->
    <?php include_once('header.php'); ?>

    <?php if(isset($_SESSION['username'])): ?>

        <main>

        <?php init_acteurs_table(); ?>

        <!-- Section Presentation -->
        <section class="section-presentation">
            <h1> Présentation du GBAF </h1>
            <p>Le Groupement Banque Assurance Français (GBAF) est une fédération représentant les 6 grands groupes français : </p>
            <ul>
                <li> BNP Paribas </li>
                <li> BPCE </li>
                <li> Crédit Agricole </li>
                <li> Crédit Mutuel-CIC </li>
                <li> Société Générale  </li>
                <li> La Banque Postale. </li>          
            </ul>
            <p>Même s'il existe une forte concurrence entre ces entités, elles vont toutes travailler de la même façon pour gérer près de 80 millions de comptes sur le territoire national.<br>
            Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. Sa mission est de promouvoir l'activité bancaire à l'échelle nationale. C'est aussi un interlocuteur privilégié des pouvoirs publics.
            </p>
            <br>
            <img src='images/buildings_logos.jpg' alt='Logos Banques' class="logos-banques">   
            <div class="logos-banques-small">
                <img src='images/bnp.png' alt='Logo BNP' class="logo-une-banque">   
                <img src='images/bpce.png' alt='Logos LB Postale' class="logo-une-banque">   
                <img src='images/ca.png' alt='Logos Banques' class="logo-une-banque">    
                <img src='images/credit_mutuel.png' alt='Logos Banques' class="logo-une-banque">    
                <img src='images/lbpostale.png' alt='Logos Banques' class="logo-une-banque">   
                <img src='images/sg.png' alt='Logos Banques' class="logo-une-banque">   
            </div>     
        </section>

        <!-- ligne horizontale -->
        <hr>

        <!-- Section Acteur -->
        <section class="section-acteurs">
            <h2> Voici les acteurs que vous pouvez évaluer par un commentaire et/ou un like/dislike</h2>

            <?php for ($i = 0; $i < $nbActeurs; $i++):?>

                <div class=un-acteur>
                
                    <?php $ligneActeur = $acteursTable[$i]; ?> 

                    <?php $imagePath = $rootUrl.'images/'.$ligneActeur['logo'];  ?>

                    <img src="<?php echo $imagePath; ?>" alt="Logo Acteur" class="logo-acteur logo">

                    <h3 class=texte-tronque> <?php echo $ligneActeur['description'];?> </h3>

                    <div class="lire-la-suite">
                        <a href="actor.php?acteur_index=<?php echo($i);?>" class="texte-lire-la-suite bouton">Lire la suite</a>
                    </div>
                </div>

            <?php endfor; ?>

        </section>    

        </main>

    <?php endif; ?>



    <!-- Footer -->
    <!-- Le footer est affiche que l'utisateur soit connecte ou pas -->    
    <?php include_once('footer.php'); ?> 

</body>
</html>