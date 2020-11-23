<?php

session_start();

include 'Classe/course.php';
include 'Classe/membre.php';

date_default_timezone_set("America/Toronto");


$bdd = new PDO('mysql:host=localhost;dbname=karting', 'root', 'P@ssw0rd123');
$bdd->query("SET NAMES UTF8");

// tout les mots de passe des membres de la bdd sont : "test"
    


?>