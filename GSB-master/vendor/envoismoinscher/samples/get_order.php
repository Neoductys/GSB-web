<?php
/*  Cet exemple vous permet de passer une commande. L'envoi est composé d'informations basiques (expéditeur, destinataire, type) 
 *  et ne contient pas d'options supplémentaires. Il possède uniquement un filtre selon lequel le montant de la commande ne peut 
 *  pas dépasser 50€ ttc.
 */ 
ob_start();
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once dirname(dirname(dirname(__FILE__))).'/../vendor/envoismoinscher/utils/header.php';
require_once dirname(dirname(dirname(__FILE__))).'/../vendor/envoismoinscher/utils/autoload.php';
$orderPMStyle = 'style="font-weight:bold;"';
// Informations sur l'expéditeur et le destinataire 
$to = array(
  "civilite" => "mr",
  "email" => "benoit@test.fr",
  "nom" => "BUREAU",
  "prenom" => "Benoit",
  "pays" => "FR", 
  "code_postal" => "75012", 
  "ville" => "Paris", 
  "type" => "particulier", 
  "adresse" => "60, rue de Picpus",
  "tel" => "0561833359"
  );
$from = array(
  "civilite" => "mr",
  "email" => "vincent@test.fr",
  "nom" => "JONQUET",
  "prenom" => "Vincent",
  "pays" => "FR", 
  "code_postal" => "31500",   
  "ville" => "Toulouse", 
  "type" => "entreprise",
  "societe" => "maSociete",
  "adresse" => "74, rue de Limayrac",
  "tel" => "0561833359"); 

// Informations sur la cotation
$quotInfo = array(
	"collecte" => date("Y-m-d"), 
	"delai" => "aucun",
	"service" => "ColissimoExpert",  
	"code_contenu" => 40110,	
  "type_emballage.emballage" => 1, // <== Type emballage
	"operateur" => "POFR",
  "depot.pointrelais"	=> "POFR-POST",
	"colis.description" => "Le Monde, années 1990-1992"
);
$cotCl = new Env_Quotation(array("user" => 'melispot', "pass" => 'Mafate2012', "key" => 'xjwxgnux'));
$cotCl->setPerson("expediteur", $from);
$cotCl->setPerson("destinataire", $to);
$cotCl->setEnv('test'); 
$cotCl->setType("colis", array(
	1 => array(
		"poids" => 0.5, 
		"longueur" => 20, 
		"largeur" => 20, 
		"hauteur" => 20)
	)
);

$orderPassed = $cotCl->makeOrder($quotInfo, true);
if(!$cotCl->curlError && !$cotCl->respError) { 
  if($orderPassed) {
    echo "L'envoi a été correctement réalisé sous référence ".$cotCl->order['ref'];
  }
  else {
    echo "L'envoi n'a pas été correctement réalisé. Une erreur s'est produite.";
  }
}
elseif($cotCl->respError) {
  echo "La requête n'est pas valide : ";
  foreach($cotCl->respErrorsList as $m => $message) { 
    echo "<br />".$message['message'];
  }
}
else {
  echo "<b>Une erreur pendant l'envoi de la requête </b> : ".$cotCl->curlErrorText; 
}

 