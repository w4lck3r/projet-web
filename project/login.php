<?php
session_start();
if(isset($_SESSION["ident"])){
    require('views/pageAccueil.php');
}else{
    require('views/pageLogin.php');
}
?>
