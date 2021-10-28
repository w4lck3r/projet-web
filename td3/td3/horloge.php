<?php
  
  require("lib/ParmsException.class.php");

  require("lib/fonctions_parms.php");
  require("lib/fonctions_clock.php");
  
/**
 * IMPORTANT : 
 * Ce script n'est qu'une ébauche.
 * 
 * En l'état actuel son fonctionnement n'est pas satisfaisant
 *
 * 
 * Utiliser directement les variable du tableau $_GET peut être dangereux
 *
 * Ce script est à modifier et compléter au cours de l'exercice
 * 
 */
if(!isset($_GET['hours'])||$_GET['hours']=""){
  $seconds = 0;
  return $seconds;
}
elseif(!ctype_digit($_GET['secounds'])){
  throw new PharmsException();
}
 
  try{
   // hours doit être un entier sans signe
   $hours = $_GET['hours'];
   $hours = checkUnsignedInt($_GET['hours'],0);
  
   // minutes doit être un entier sans signe
   $minutes = $_GET['minutes'];
    $minutes = checkUnsignedInt($_GET['minutes'],0);
   // seconds doit être un entier sans signe
   $seconds = $_GET['seconds'];
    $seconds= checkUnsignedInt($_GET['secounds'],0);
    $hands = $_GET['hands'];
    $hands = checkColor($_GET['hands'],'#f0f8ff');
    $bg= checkColor($_GET['bg'],'#000000');
    $markers = checkColor($_GET['markers'],'#f00000')  
   // calcul des angles des aiguilles
   $angles = angles($hours, $minutes, $seconds);
 
   // inclusion de la page template :
   require('views/page.php');

  } catch (ParmsException $e){
    include("pageErreur.html");
 
  }
 

 
 
?>