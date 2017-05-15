<?php
	// Récupération des informations pour  la connexion à MySQL
	$host = "localhost";
	$id = "root";
	$mdp = "";

	// Connexion au serveur
 	$connexion= mysql_connect($host,$id,$mdp) or die("Connexion à " . SERVEUR . " impossible");

	// Sélection de la base de données
	$bdd = "gsb";
	$dbselect=  mysql_select_db($bdd,$connexion) or die("Accès à la base de données " .BASE. " impossible");
?>