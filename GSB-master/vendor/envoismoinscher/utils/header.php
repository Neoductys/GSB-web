<!DOCTYPE html>
<html>
  <head>
    <title>Librairie PHP pour l'API EnvoiMoinsCher</title>
    <meta charset="utf-8">
  </head>
  <body>
<?php
  // r�cup�ration des donn�es
  $userData = parse_ini_file("config.ini");
  ini_set('error_reporting',E_ALL & ~E_NOTICE); 
?>