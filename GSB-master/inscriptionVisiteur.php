<?php
	// Appel du script de connexion
	require("connect.php");

	//Générer une chaine de caractère unique et aléatoire

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
// Génère une chaine de longueur 3
	$chaine = random(3);

	// On récupère dans des variables les données saisies par l'utilisateur 
	$nom=$_POST["nom"];
	$prenom=$_POST["prenom"];
	$login=$_POST["login"];
	$mdp=$_POST["mdp"];
	$adresse=$_POST["adresse"];
	$cp=$_POST["cp"];
	$ville=$_POST["ville"];
	$dateE=$_POST["dateE"];
		 
	// Ecriture de la requête d'insertion en SQL 
	$sql="INSERT INTO visiteur VALUES ('$chaine','$nom','$prenom','$login','$mdp','$adresse','$cp','$ville','$dateE')";
			
		
	// Exécution de la requête : on insère les informations du formulaire dans la table 
	$reslut = mysql_query($sql)or die("Erreur SQL".$sql);

	// On affiche le résultat pour le visiteur 
	echo"<center>Inscription réussie</center>";
	include("loginVisiteur.php");

	// On ferme la connexion 
	mysql_close($connexion);
?> 

