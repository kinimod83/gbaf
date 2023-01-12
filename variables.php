<?php

$bddTableName='gbaf';
$hostName='local:8080';
$bddlogin='root';
$bddPassWord='root';


$rootPath='/gbaf';

$acteursTable = [];
$nbActeurs=0;

$commentairesTable = [];
$nbCommentaires=0;

$oneUserTable=[];

$ligneActeur=[];


$rootPath = $_SERVER['DOCUMENT_ROOT'];

$rootPath = $rootPath.'/gbaf/';
// G:/code/gbaf/ 
// ne fonctionne pas avec MAMP

// Dans les parametres du serveur HTTP, le chemin "document root" est G:\code
$rootPath='/gbaf/';

$rootUrl = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
$rootUrl = $rootUrl.'gbaf/';
// http://localhost:8080/gbaf/ 

/* contiendra la "ligne" de la table users */
$loggedUser= [];
