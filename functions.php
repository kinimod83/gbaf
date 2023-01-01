<?php

function init_acteurs_table():bool
{
    global $mysqlClient, $nbActeurs, $acteursTable;
    $error=false;

    echo ("init acteurs 0");

    if ($mysqlClient!==null) {

        echo ("init acteurs 2");
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








