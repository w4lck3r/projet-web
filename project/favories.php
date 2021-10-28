<?php
session_start();
if(isset($_SESSION["ident"])){
    require('views/pageFavories.php');
}else{
    require('views/pageLogin.php');
}
?>