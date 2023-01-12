
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
    $imagePath = $rootPath.'images/logo_gbaf.png';
    ?>

    <!-- HTML -->
    <img src="<?php echo $imagePath; ?>" alt="Logo de GBAF" class="logo-gbaf">

    <div class="identite">

        <!-- Si une session est ouverte tous les champs des la table accounts sont correctements renseignes en BDD -->
        <?php if(isset($_SESSION['username'])): ?>
            <a href="users/user_form.php?username=<?=$username?>" class="header-identity"><img src='images/identity.png' alt="Paramètres utilisateur" ></a>
            <div>
                <?php
                    $userLigne = get_user($username);
                    $chaine = $userLigne['nom'] . ' ' .$userLigne['prenom'];
                    echo("$chaine"); 
                ?>
                <?php $chaine = $rootPath.'logout.php' ?>
                <a href=<?=$chaine?> class="header-logout">Se déconnecter</a>
            </div>            

        <?php endif; ?>
        <?php $chaine = $rootPath.'home.php' ?>
        <a href=<?=$chaine?> class="header-home">Accueil</a>
    </div>

</header>
<?php else:?>
    <?php include_once('login_form.php');   ?>
<?php endif;?>    
