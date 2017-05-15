<?php
	include('connect.php');

Switch($_POST["moisSaisie"])
	{
		case "Janvier":$moisIndex=1;break;
		case "F&eacute;vrier":$moisIndex=2;break;
		case "Mars":$moisIndex=3;break;
		case "Avril":$moisIndex=4;break;
		case "Mai":$moisIndex=5;break;
		case "Juin":$moisIndex=6;break;
		case "Juillet":$moisIndex=7;break;
		case "Aout":$moisIndex=8;break;
		case "Septembre":$moisIndex=9;break;
		case "Octobre":$moisIndex=10;break;
		case "Novembre":$moisIndex=11;break;
		case "D&eacute;cembre":$moisIndex=12;break;
	}

	$id=$_POST['visiteur'];	
	//$mois=$_COOKIE['mois'];
	$comptable=$_COOKIE['comptable'];
	$justificatif=$_POST['hcMontant'];
	$date= date("Y-m-d");
	$req= "";
	
	$montant = $_POST['repas']*25+$_POST['nuitee']*80+$_POST['etape']*110+$_POST['km']*0.62+$_POST['hfMont1'];
	
	if(($_POST['situation']=="V")||($_POST['situationHF']=="V"))
	{
		$req="UPDATE fichefrais SET idEtat='VA', idCptResp='$comptable', nbJustificatifs='$justificatif',dateModif='$date',montantValide='$montant' WHERE idVisiteur='$id' AND mois='$moisIndex'";

	}elseif(($_POST['situation']=="R")||($_POST['situationHF']=="R"))
	{
		$req="UPDATE fichefrais SET idEtat='RB', idCptResp='$comptable', nbJustificatifs='$justificatif',dateModif='$date',montantValide='$montant' WHERE idVisiteur='$id' AND mois='$moisIndex'";

	}else{
		$req="UPDATE fichefrais SET idEtat='CR', idCptResp='$comptable', nbJustificatifs='$justificatif',dateModif='$date',montantValide='$montant' WHERE idVisiteur='$id' AND mois='$moisIndex'";
	}

	if (mysqli_query($connect, $req)) {
		echo "<h1>Enregistrement R&eacute;ussi</h1>";
	}else{
		echo "<h1>Enregistrement non effectu&eacute</h1>";
	}
	include("formValidFrais.php");
?>