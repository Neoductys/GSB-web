<?php
	// Définitions de constantes pour la connexion à MySQL
	define ('SERVEUR', 'localhost');
	define ('BASE', 'gsb');
	define ('NOM', 'root');
	define ('MOTPASSE', '');

	// Connexion au serveur
 	$connexion = mysql_connect (SERVEUR, NOM, MOTPASSE) or die("Connexion à " . SERVEUR . " impossible");

	// Sélection de la base de données
	$dbselect=mysql_select_db(BASE, $connexion) or die("Accès à la base de données " .BASE. " impossible");

?>