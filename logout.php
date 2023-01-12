<?php
session_start();
session_destroy();

//echo("ici");

header('location: home.php');

