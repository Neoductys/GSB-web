<?php
	// D�finitions de constantes pour la connexion � MySQL
	define ('SERVEUR', 'localhost');
	define ('BASE', 'gsb');
	define ('NOM', 'root');
	define ('MOTPASSE', '');

	// Connexion au serveur
 	$connexion = mysql_connect (SERVEUR, NOM, MOTPASSE) or die("Connexion � " . SERVEUR . " impossible");

	// S�lection de la base de donn�es
	$dbselect=mysql_select_db(BASE, $connexion) or die("Acc�s � la base de donn�es " .BASE. " impossible");

?>