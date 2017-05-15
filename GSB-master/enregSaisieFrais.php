<?php
	include('connect.php');
	
		
	//$connect=mysqli_connect("localhost","root","root","gsb");
	//extraction des informations du formulaire de saisie.
	Switch($_POST["FRA_MOIS"])
	{
		case "Janvier":$mois=1;break;
		case "F&eacute;vrier":$mois=2;break;
		case "Mars":$mois=3;break;
		case "Avril":$mois=4;break;
		case "Mai":$mois=5;break;
		case "Juin":$mois=6;break;
		case "Juillet":$mois=7;break;
		case "Aout":$mois=8;break;
		case "Septembre":$mois=9;break;
		case "Octobre":$mois=10;break;
		case "Novembre":$mois=11;break;
		case "Décembre":$mois=12;break;
	}
	$an = $_POST['FRA_AN'];
	$repasMidi = $_POST['FRA_REPAS'];
	$nuitees = $_POST['FRA_NUIT'];
	$etape = $_POST['FRA_ETAP'];
	$km = $_POST['FRA_KM'];
	//$dateHF = $_POST['FRA_AUT_DAT1'];
	$libelle = $_POST['FRA_AUT_LIB1'];
	$montant = $_POST['FRA_AUT_MONT1'];
	$id = $_COOKIE['id'];
	$date = date('Y/m/d');
	
	$exist = "select * from fichefrais where idVisiteur = '$id' and mois = $mois ";
	$existFiche = mysqli_query($connect, $exist);
	$exist = $existFiche->fetch_assoc();


	if($exist == NULL){
		//création d'une fiche frais
		$reqfichefrais="INSERT INTO fichefrais(idVisiteur,mois, dateModif) VALUES ('$id','$mois','date(YYYY/MM/DD)')";
		$resultatfichefrais=mysqli_query($connect, $reqfichefrais);
		
		//insertion des données dans la base de données.
		if ($date != NULL){
			// Check connection
			if (!$connect) {
			    die("Connection failed: " . mysqli_connect_error());
			}

			$sql =  "INSERT INTO fichefrais(idVisiteur,mois,annee,libelle,repas,nuitees,etapes,km,dateCrea,montantSaisie)
					VALUES ('$id','$mois','$an','$libelle','$repasMidi','$nuitees','$etape','$km','$date','$montant')";
			if (mysqli_query($connect, $sql)) {
			    echo "<h1>Demande envoy&eacute;e</h1>";
				include('formSaisieFrais.php');
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
			}
		}
	}else{
		echo "<h1>La demande pour ce mois &agrave; d&eacute;j&agrave; &eacute;tait effectu&eacute;e</h1>";
		include('formSaisieFrais.php');
	}

?>


