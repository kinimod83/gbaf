
<?php 
//session_start();
//$_SESSION['username'] = 'username1';

include_once('mysql.php');
include_once('variables.php');
include_once('functions.php');





?>


<?php if(isset($_SESSION['username'])): ?>
    <header class="en-tete">    
    <!-- PHP -->
    <?php
    $username = $_SESSION['username'];
    $imagePath = $rootUrl.'images/logo_gbaf.png';
    $identityPath =  $rootUrl.'images/identity.png';
    ?>

    <!-- HTML -->
    <img src="<?php echo $imagePath; ?>" alt="Logo de GBAF" class="logo-gbaf">

    
    <div class="identite">

        <!-- Si une session est ouverte tous les champs des la table accounts sont correctements renseignes en BDD -->
        <?php if(isset($_SESSION['username'])): ?>
            <?php $chaine = $rootUrl.'users/user_form.php'.'?username='.$username ?>
            <a href="<?=$chaine?>" class="header-identity"><img src=<?=$identityPath?> alt="Paramètres utilisateur" ></a>
            <div>
                <?php
                    $userLigne = get_user($username);
                    $chaine = $userLigne['nom'] . ' ' .$userLigne['prenom'];
                    echo("$chaine"); 
                ?>
            </div>                 
            <?php $chaine = $rootUrl.'logout.php' ?>
            <div>
                <a href="<?=$chaine?>" class="header-logout bouton petite-police">Se déconnecter</a>
            </div>
                       
        <?php endif; ?>
        <?php $chaine = $rootUrl.'home.php' ?>
        <a href="<?=$chaine?>" class="header-home bouton">Accueil</a>
    </div>

    </header>


<?php else:?>
    <?php include_once('login_form.php');   ?>
<?php endif;?>    


