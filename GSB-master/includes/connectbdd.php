<?php
	// R�cup�ration des informations pour  la connexion � MySQL
	$host = "localhost";
	$id = "root";
	$mdp = "";

	// Connexion au serveur
 	$connexion= mysql_connect($host,$id,$mdp) or die("Connexion � " . SERVEUR . " impossible");

	// S�lection de la base de donn�es
	$bdd = "gsb";
	$dbselect=  mysql_select_db($bdd,$connexion) or die("Acc�s � la base de donn�es " .BASE. " impossible");
?>