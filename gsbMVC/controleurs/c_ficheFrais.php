<?php
include("vues/v_sommaireComptable.php");
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];
$action = $_REQUEST['action'];

switch($action){
	case 'fiches':{
		$lesFiches=$pdo->getLesFichesEnAttente();
		include("vues/v_listeFiches.php");
		}
		break;
	case 'clients':{
		$lesClients=$pdo->getLesClients();
		include("vues/v_listeClients.php");
		}
		break;
	case 'archives':{
		$lesArchives=$pdo->getLesFiches();
		
		include("vues/v_archives.php");
		}
		break;
	case 'details':{
		$idVisiteur = $_GET['visiteur'];
		$mois = $_GET['mois'];
		$uneFiche=$pdo->getLaFiche($idVisiteur,$mois);
		$unFraisForfait=$pdo->getLesFraisForfait($idVisiteur,$mois);
		$unFraisHorsForfait=$pdo->getLesFraisHorsForfait($idVisiteur,$mois);
		include("vues/v_formConsultFrais.php");
		}
		break;
	case 'detailClients':{
		$idVisiteur = $_GET['visiteur'];
		//$pdo -> hashPass($idVisiteur);
		$lesFiches=$pdo->getLesFichesClients($idVisiteur);
		include("vues/v_detailClients.php");
		}
		break;
	case 'ValidationFrais':{
		
		$lesVisiteur = $pdo->getClientsLst();
		
		if(isset($_REQUEST['lstVisiteur'])  && isset($_REQUEST['moisValid']) && isset($_REQUEST['anneeValid']))
		{
			$Visiteur = $_REQUEST['lstVisiteur'];
			$mois = $_REQUEST['moisValid'];
			$annee = $_REQUEST['anneeValid'];
			
			$date = $annee . $mois;
		
			$lesFrais = $pdo->getLesFraisForfait($Visiteur, $date);
			$lesFraisHf = $pdo->getLesFraisHorsForfait($Visiteur, $date);
			$montantTt = $pdo ->getTotal($lesFrais, $lesFraisHf);
			$infosFrais = $pdo->getLesInfosFicheFrais($Visiteur, $date);
			
		}
		
		
		include("vues/v_formValidFrais.php");
		}
		break;
		
	case 'saveFrais':{
			
			$Visiteur = $_GET['visiteur'];
			$mois = $_GET['mois'];
			
			
			
			// frais hors forfait //
			$nbLignesHF = $pdo->nbFraisHorsForfait($Visiteur, $mois);
			
			for ($i = 0; $i < $nbLignesHF; $i++)
			{

				$libelle = $_POST['hfLib'.$i];
				$date = $_REQUEST['hfDate'.$i];
				$montant = $_REQUEST['hfMont'.$i];
				if(isset($_REQUEST['hfSitu'.$i])) {$choixHf = $_REQUEST['hfSitu'.$i];}
				if(isset($_REQUEST['situ'.$i])) {$choixF = $_REQUEST['situ'.$i];}
				$id = $_REQUEST['hfId'.$i];
				
				
				 $pdo->majFraisHorsForfait($libelle, $date, $montant, $id, $choixHf);
				 $pdo->majFraisForfait($libelle, $date, $montant, $id, $choixF);
			}
					// frais forfait //
			 $repas = $_REQUEST['repas'];
			 $nuitee = $_REQUEST['nuitee'];
			 $etape = $_REQUEST['etape'];
			 $km = $_REQUEST['km'];
			
			
			 $pdo -> majFraisForfait($Visiteur,$mois,$repas,'REP');
			 $pdo -> majFraisForfait($Visiteur,$mois,$nuitee,'NUI');
			 $pdo -> majFraisForfait($Visiteur,$mois,$etape,'ETP');
			 $pdo -> majFraisForfait($Visiteur,$mois,$km,'KM');
			
			if(isset($_REQUEST['situ']))
			{
			$choixF = $_REQUEST['situ'];
				switch ($choixF){
					case 'CR':{
						$pdo->majEtatForfait($Visiteur,$mois,'Enregistrer');
					}
					case 'VA':{
						$pdo->majEtatForfait($Visiteur,$mois,'Validée');
					}
					case 'RB':{
						$pdo->majEtatForfait($Visiteur,$mois,'Rembourser');
					}
				}
			}
			include("vues/v_formValidFrais.php");
			
			// $pdo-> majEtatFicheFrais($Visiteur,$mois,$choixF);
			// $choixF = $_REQUEST['situ'];
		}
		break;
		
		case 'validerFiche':{
		$idVisiteur = $_GET['visiteur'];
		$mois = $_GET['mois'];
		$justificatifs = $_GET['justificatifs'];
		$dateModif = $_GET['dateModif'];
		
		$pdo-> validerFiche($idVisiteur,$mois,$justificatifs,$dateModif);
	  break;
			}
		
		case 'suivieFrais':{
			
			if(isset($_REQUEST['moisValid']) && isset($_REQUEST['anneeValid']))
		{
			$mois = $_REQUEST['moisValid'];
			$annee = $_REQUEST['anneeValid'];
			$date = $annee . $mois;
			
			$lesFrais = $pdo->getLesQuantiteFraisForfait($date);
			var_dump($lesFrais);
			
		}
			
		include("vues/v_formConsultFrais.php");
		}
		break;
		
	}
		
	
	

?>