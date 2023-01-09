<!-- ne pas oublier le session_start() -->

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

    <?php init_acteurs_table(); ?>

    <!-- Section Presentation -->
    <section class="section-presentation">
        <h1> Texte de présentation de GBAF</h1>
    </section>

    <!-- ligne horizontale -->
    <hr>

    <!-- Section Acteur -->
    <section class="section-acteurs">
        <h2> Texte de présentation de la section acteurs</h2>

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
</body>
</html>