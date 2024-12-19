<?php
    $user="root";
    $mdp="";
    $serveur="localhost";
    $bd="cebg_2";
    $host="mysql:host=$serveur;dbname=$bd";
   
        $con = new PDO($host, $user, $mdp);
