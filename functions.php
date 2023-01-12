<?php

function init_acteurs_table():bool
{
    global $mysqlClient, $nbActeurs, $acteursTable;
    $error=false;

    //echo ("init acteurs 0");

    if ($mysqlClient!==null) {

        //echo ("init acteurs 2");
       $retrieveActorStatement = $mysqlClient->prepare('SELECT * FROM acteurs');
       $retrieveActorStatement->execute();
       $acteursTable = $retrieveActorStatement->fetchAll(PDO::FETCH_ASSOC);   
       
       //var_dump($acteursTable);

       $nbActeurs=count($acteursTable);

    } else {

        echo ("init acteurs 3");
       $error=true;
    }

    return($error);

}

/* liste tous les commentaires pour un acteur en particulier */
/* Recupere en meme temps les noms et prenoms de l'auteur de chaque commentaire */
function init_comment_table($acteurId):bool
{
    global $mysqlClient, $nbCommentaires, $commentairesTable;
    $error=false;

    //echo ("init_comment_table 0");

    if ($mysqlClient!==null) {

       //echo ("init_comment_table 2");
       $retrieveActorStatement = $mysqlClient->prepare("SELECT * FROM accounts LEFT JOIN posts ON accounts.id_user = posts.id_user WHERE id_acteur = $acteurId");
       $retrieveActorStatement->execute();
       $commentairesTable = $retrieveActorStatement->fetchAll(PDO::FETCH_ASSOC);   
       
       //var_dump($commentairesTable);

       $nbCommentaires=count($commentairesTable);

    } else {

        //echo ("init_comment_table 3");
       $error=true;
    }

    return($error);

}

function get_one_user_data($idUser):bool
{
    global $mysqlClient, $nbCommentaires, $oneUserTable;
    $error=false;

    //echo ("get_one_user_data 0");

    if ($mysqlClient!==null) {

       //echo ("get_one_user_data 2");
       $retrieveActorStatement = $mysqlClient->prepare("SELECT * FROM accounts WHERE id_user = $idUser");
       $retrieveActorStatement->execute();
       $oneUserTable = $retrieveActorStatement->fetchAll(PDO::FETCH_ASSOC);   
       
       //var_dump($oneUserTable);



    } else {

        //echo ("get_one_user_data 3");
       $error=true;
    }

    return($error);

}



/* renvoie true si l'utisateur a deja vote pour l'acteur */
function has_already_voted($idUser, $idActeur):bool
{
    global $mysqlClient;
    $error=false;
    //echo ("has_already_voted 0");

    if ($mysqlClient!==null) {


        //echo ("has_already_voted 2 ");
        $retrieveStatement = $mysqlClient->prepare("SELECT id_user FROM votes WHERE id_user = $idUser AND id_acteur = $idActeur");
        $retrieveStatement->execute();
        $voteLigne = $retrieveStatement->fetchAll(PDO::FETCH_ASSOC);   

        //var_dump($voteLigne);        

        if(empty($voteLigne)) {
            return false;
        }else{
            return true;
        }
 
     } else {
 
         //echo ("has_already_voted 3");
        $error=true;
     }
 
     return($error);    
}

/* renvoie la ligne vote pour un utilisateur et un acteur donne */
/* il faut au prealable avoir teste l'existence du vote avec has_already_voted() */
/* la fonction retourne true s'il y a une erreur */
function get_vote($idUser, $idActeur)
{
    global $mysqlClient;
    $error=false;
    //echo ("get_vote 0");

    if ($mysqlClient!==null) {


        //echo ("get_vote 2");
        $retrieveStatement = $mysqlClient->prepare("SELECT * FROM votes WHERE id_user = $idUser AND id_acteur = $idActeur");
        $retrieveStatement->execute();        
        $voteTable = $retrieveStatement->fetchAll(PDO::FETCH_ASSOC);  
        
        /* si tout va bien le tableau voteLigne ne contient qu'une ligne ni plus ni moins */

        //var_dump($voteTable);        

        if(empty($voteTable) || count($voteTable) != 1) {
            //echo ("get_vote 4");
            echo "L'utilisateur n'a pas voté ";
            echo($voteTable);
            $error=true;            
        }else{
            return $voteTable[0];
            /* voteLigne['vote'] contient le vote et voteLigne['id_vote'] contient l'ID du vote au sens BDD */            
        }
 
     } else {
 
         //echo ("get_vote 5");
        $error=true;
     }
 
     return($error);    
}



function get_total_votes($idActeur, $vote)
{
    global $mysqlClient, $loggedUser;
    $error=false;
    //echo ("get_total_likes 1");

    if (!isset($_SESSION['username'])) {
        echo(' Erreur dans get_total_votes(), pb connexion ');
        return(true);
    }else{
        $loggedUser = get_user($_SESSION['username']);
    }      

    if ($mysqlClient!==null) {

        $idUser=$loggedUser['id_user'];

   
        //echo ("get_total_likes 2");
        $retrieveStatement = $mysqlClient->prepare("SELECT COUNT(*) AS total FROM votes WHERE id_acteur = $idActeur AND vote = $vote");
        $retrieveStatement->execute();
        $resultat = $retrieveStatement->fetch();  
        
        /* si tout va bien le tableau voteLigne ne contient qu'une ligne ni plus ni moins */

        //echo " TOTAL ";

        //var_dump($resultat);       

        $total=$resultat['total'];

        return $total;
 
     } else {
 
        //echo ("get_total_likes 3");
        $error=true;
     }
 
     return($error);    
}    






/* Creation ou mise a jour d'une ligne dans la table votes */
/* il faut au prealable avoir teste l'existence du vote avec has_already_voted() et postionner le parametre boolUpdate logiquement */
/* boolUpdate doit etre renseigne a la valeur true en cas de mise a jour, ou a false en cas de creation
/* la fonction retourne true s'il y a une erreur */
function create_or_update_vote($voteLigne, $boolUpdate):bool
{
    global $mysqlClient, $loggedUser;
    $error=false;
    //echo ("create_or_update_vote 0");

    if (!isset($_SESSION['username'])) {
        echo(' Erreur dans create_or_update_vote(), pb connexion ');
        exit();
    }else{
        $loggedUser = get_user($_SESSION['username']);
    }      

    if ($mysqlClient!==null){
        //echo ("create_or_update_vote 2");

        if($boolUpdate == false)
        {
            /* on insere une nouvelle ligne */
            $insertVote = $mysqlClient->prepare('INSERT INTO votes(id_user, id_acteur, vote) VALUES (:id_user, :id_acteur, :vote)');
            $insertVote->execute([
                'id_user' => $loggedUser['id_user'],    
                'id_acteur' => $voteLigne['id_acteur'],
                'vote' => $voteLigne['vote']
            ]);            
        }else{
            /* on met a jour une ligne */
            $retrieveStatement = $mysqlClient->prepare("UPDATE votes SET vote = :vote WHERE id_vote = :id_vote AND id_acteur = :id_acteur AND id_user = :id_user");
            $retrieveStatement->execute([
                'id_vote' => $voteLigne['id_vote'],
                'id_acteur' => $voteLigne['id_acteur'],
                'id_user' => $loggedUser['id_user'],
                'vote' => $voteLigne['vote'],
            ]);        
        }      
     } else {
 
         //echo ("create_or_update_vote 4");
        $error=true;
     }
 
     return($error);    
}



/* renvoie true si l'utisateur $username est deja enregistre en base de donnee dans la table accounts */
function user_already_recorded($userName):bool
{
    global $mysqlClient;
    $error=false;
    //echo ("user_already_recorded 0");    
    if ($mysqlClient!==null) {
        //echo ("user_already_recorded 1 ");    
        $retrieveStatement = $mysqlClient->prepare("SELECT id_user FROM accounts WHERE username = :username");    
        $retrieveStatement->execute(['username' => $userName]);
        $userTable = $retrieveStatement->fetchAll(PDO::FETCH_ASSOC);  

        //var_dump($userTable);        

        if(empty($userTable)) {
            return false;
        }else{
            return true;
        }
 
     } else {
 
         echo ("user_already_recorded 3");
        $error=true;
     }
 
     return($error);    
}

/* renvoie la ligne username donne */
/* il faut au prealable avoir teste l'existence du user avec user_already_recorded() */
/* la fonction retourne true s'il y a une erreur */
function get_user($userName)
{
    global $mysqlClient;
    $error=false;
    //echo ("get_user 0");

    if ($mysqlClient!==null) {

        //echo ("get_user 1");        
        $retrieveStatement = $mysqlClient->prepare("SELECT * FROM accounts WHERE username = :username");
        $retrieveStatement->execute(['username' => $userName]);        
        $userTable = $retrieveStatement->fetchAll(PDO::FETCH_ASSOC);  
        
        /* si tout va bien le tableau userTable ne contient qu'une ligne ni plus ni moins */

        //var_dump($voteTable);        

        if(empty($userTable) || count($userTable) != 1) {
            echo " get_user Incoherence en BDD ";
            var_dump($userTable);
            $error=true;            
        }else{
            $userLigne = $userTable[0];
            return $userLigne;
            /* userLigne['username'] contient le username et userLigne['id_user'] contient l'ID de l'utilisateur au sens BDD */            
        }
 
     } else {
 
         //echo (" get_user Error ");
        $error=true;
     }
 
     return($error);    
}


// Creation ou mise a jour d'une ligne dans la table account 
// il faut au prealable avoir teste l'existence du user avec user_already_recorded() et postionner le parametre boolUpdate logiquement 
// boolUpdate doit etre renseigne a la valeur true en cas de mise a jour, ou a false en cas de creation 
// userLigne contient les informations a enregistrer
// dans le cas update, on va mettre a jour la ligne reperee par userLigne['username']
// la fonction retourne true s'il y a une erreur 
function create_or_update_user($userLigne, $boolUpdate):bool
{
    global $mysqlClient;
    $error=false;
    //echo ("create_or_update_vote 0");

    if ($mysqlClient!==null){
        //echo ("create_or_update_vote 2");

        if($boolUpdate == false)
        {
            /* on insere une nouvelle ligne */
            $insertVote = $mysqlClient->prepare('INSERT INTO accounts(nom, prenom, username, password, question, reponse) 
                                                        VALUES (:nom, :prenom, :username, :password, :question, :reponse)');
            $insertVote->execute([
                'nom' => $userLigne['nom'],    
                'prenom' => $userLigne['prenom'],
                'username' => $userLigne['username'],
                'password' => $userLigne['password'],
                'question' => $userLigne['question'],
                'reponse' => $userLigne['reponse']
            ]);            
        }else{
            /* on met a jour une ligne */
            $retrieveStatement = $mysqlClient->prepare('UPDATE accounts SET nom = :nom,
                                                                        prenom = :prenom,
                                                                        username = :username,
                                                                        password = :password,
                                                                        question = :question,
                                                                        reponse = :reponse
                                                        WHERE username = :username2'); 
                                                      
            $retrieveStatement->execute([
                'nom' => $userLigne['nom'],    
                'prenom' => $userLigne['prenom'],
                'username' => $userLigne['username'],
                'password' => $userLigne['password'],
                'question' => $userLigne['question'],
                'reponse' => $userLigne['reponse'],
                'username2' => $userLigne['username']
            ]);        
        }      
     } else {
 
         //echo ("create_or_update_vote 4");
        $error=true;
     }
 
     return($error);    
}