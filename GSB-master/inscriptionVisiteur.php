<?php
	// Appel du script de connexion
	require("connect.php");

	//G�n�rer une chaine de caract�re unique et al�atoire

	function random($car) {
	$string = "";
	$chaine = "abcdefghijklmnpqrstuvwxy";
	srand((double)microtime()*1000000);
	for($i=0; $i<$car; $i++) {
	$string .= $chaine[rand()%strlen($chaine)];
	}
	return $string;
	}

// APPEL
// G�n�re une chaine de longueur 3
	$chaine = random(3);

	// On r�cup�re dans des variables les donn�es saisies par l'utilisateur 
	$nom=$_POST["nom"];
	$prenom=$_POST["prenom"];
	$login=$_POST["login"];
	$mdp=$_POST["mdp"];
	$adresse=$_POST["adresse"];
	$cp=$_POST["cp"];
	$ville=$_POST["ville"];
	$dateE=$_POST["dateE"];
		 
	// Ecriture de la requ�te d'insertion en SQL 
	$sql="INSERT INTO visiteur VALUES ('$chaine','$nom','$prenom','$login','$mdp','$adresse','$cp','$ville','$dateE')";
			
		
	// Ex�cution de la requ�te : on ins�re les informations du formulaire dans la table 
	$reslut = mysql_query($sql)or die("Erreur SQL".$sql);

	// On affiche le r�sultat pour le visiteur 
	echo"<center>Inscription r�ussie</center>";
	include("loginVisiteur.php");

	// On ferme la connexion 
	mysql_close($connexion);
?> 

