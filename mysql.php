<?php

const MYSQL_HOST = 'localhost';
const MYSQL_PORT = 3306;

// valeurs specifiques pour le site local
const MYSQL_NAME = 'gbaf';
const MYSQL_USER = 'root';
const MYSQL_PASSWORD = 'root';

// valeurs specifiques pour le site distant
//const MYSQL_NAME = 'u688542203_gbaf';
//const MYSQL_USER = 'u688542203_gbafuser';
//const MYSQL_PASSWORD = 'f425JG4x7PSNrta';



try {
    $mysqlClient = new PDO(
        sprintf('mysql:host=%s;dbname=%s;port=%s', MYSQL_HOST, MYSQL_NAME, MYSQL_PORT),
        MYSQL_USER,
        MYSQL_PASSWORD
    );
    $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(Exception $exception) {
    die('Erreur : '.$exception->getMessage());
}
