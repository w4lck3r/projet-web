<?php
spl_autoload_register(function ($className) {
     include ("lib/{$className}.class.php");
 });

try {
  require('lib/initDataLayer.php');
  require('lib/fonctions_parms.php');
  
   // à compléter
   
   $res = $data->createUser($login, $password, $nom, $prenom);
   
   $login = checkString("login",NULL,true);
   $password = checkString("password",NULL,true);
   $nom = checkString("nom",NULL,true);
   $prenom = checkString("prenom",NULL,true);
   
   if ($res){
     require('views/pageCreateOK.php');
     exit();
   } else {
     $erreurCreation = true;
     require('views/pageRegister.php');
     exit();
   }
 } catch (ParmsException $e) {
   echo $e;
 }

?>
