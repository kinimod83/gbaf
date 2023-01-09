<?php

$bddTableName='gbaf';
$hostName='local:8080';
$bddlogin='root';
$bddPassWord=MYSQL_PASSWORD;


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
// ne fonctionne pas avec MAP
$rootPath='/gbaf/';

$rootUrl = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
$rootUrl = $rootUrl.'gbaf/';
// http://localhost:8080/gbaf/ 



$loggedUser=
[
  'id_user' => 1,
  'nom' => 'nom1',
  'prenom' => 'prenom1',
  'username' => 'username1',
  'password' => 'password1',
  'question' => 'question1',
  'reponse' => 'reponse1'
];