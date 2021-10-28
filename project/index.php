<?php
spl_autoload_register(function ($className) {
     include ("lib/{$className}.class.php");
 });
require('lib/initDataLayer.php');

require_once('lib/session.php'); // sentinelle

require('views/pageAccueil.php');
?>
