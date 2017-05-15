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

$cotCl = new Env_OrderStatus(array("user" => $userData["login"], "pass" => $userData["password"], "key" => "ufumbkhu"));
$cotCl->setEnv("prod");

$cotCl->getOrderInformations("1411079745POFR0YBVFR");
if(!$cotCl->curlError && !$cotCl->respError) { 
	var_dump($cotCl);
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
?>
 
