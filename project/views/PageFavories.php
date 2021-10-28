<?php



?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta charset="UTF-8"/>
    <title>Liste des Favories</title>
    <link rel="stylesheet" type="text/css" href="style_td6.css" />
    <script src="js/fetchUtils.js"></script>
    <script src="js/communes.js"></script>
    <script src="js/carte.js"></script>
</head>
<body>
<header>
<h1>Liste des Favories</h1>
</header>
<section id="main">

  <ul id="liste_communes" data-login="<?= $_SESSION['ident']->login ?>" class="fav_list">
</ul>
</section>

<footer>
    <? if(alreadyLogged()) { ?>
    Connecté en tant que <?= $personne->login ?> <a href="logout.php">Liste de Favorie</a> / <a href="logout.php">Se déconnecter</a>
    <? }else{ ?>
    <a href="login.php">Connecter</a> / <a href="register.php">S'inscrire</a>
    <? } ?>
</footer>

</body>
</html>

<?php
?>
