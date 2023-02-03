<?php
session_start();

include_once('./mysql.php');
include_once('./variables.php');
include_once('./functions.php');

$postData = $_POST;

//echo " vote_update_or_create 1 ";

if (
    (!isset($postData['id_vote'])) ||
    (!isset($postData['index_acteur'])) ||
    (!isset($postData['id_acteur'])) ||
    (!isset($postData['id_user'])) ||
    (!isset($postData['vote'])) ||   
    (!isset($postData['bool_update']))
    )
{
	echo('Le vote est invalide.');
    var_dump($postData);
    return;
}

if (
    (!isset($postData['like'])) &&
    (!isset($postData['dislike']))
    )
{
	echo('Le vote est invalide.');
    var_dump($postData);
    return;
}

$boolUpdate = $postData['bool_update'];
$ancienVote = $postData['vote'];

if(isset($postData['like'])){
    $pouce = 1;
}else{
    $pouce = 2;
}

$nouveauVote = $pouce;
if($boolUpdate == true)
{
    if($pouce == 1)
    {
        // Up
        if($ancienVote == 1){
            $nouveauVote = 0; /* annulation, l'utisateur ne veux plus donner d'avis */        
        }
    }
    else
    {
        // Down
        if($ancienVote == 2){
            $nouveauVote = 0; /* annulation, l'utisateur ne veux plus donner d'avis */        
        }
    }

}else{
    $nouveauVote = $pouce;
}



$voteLigne=[
    'id_vote'   => $postData['id_vote'],
    'id_user'   => $postData['id_user'],
    'id_acteur' => $postData['id_acteur'],
    'vote'      => $nouveauVote,
];



//var_dump($voteLigne);


create_or_update_vote($voteLigne, $boolUpdate);


// header() permet d'aller directement sur une autre page, 
// mais il ne faut faire aucun affichage si exécuter aucun code html avant cet appel
$acteurIndex = $postData['index_acteur'];
$chaine = "location: actor.php?acteur_index=$acteurIndex";
header($chaine);

?>


