<?php
session_start();
  /*
    Utilise le contenu de $_SESSION (en particulier $_SESSION['ident'])
  */
  //if ( ! isset($_SESSION['ident'])){  // si la page était protégée, on ne devrait même pas faire ce test
  //    require('views/pageErreur.php');
  //    exit();
  //}
  $personne = $_SESSION['ident'];
  //$avatarURL = "images/avatar_def.png";
  //$avatarURL = "getAvatar.php?login={$personne->login}";
  if(!isset($personne)){
    echo "<style>ul#liste_communes>li button{display:none!important;}</style>";  
  }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta charset="UTF-8"/>
    <title>Communes de la MEL</title>
    <link rel="stylesheet" type="text/css" href="style_td6.css" />
    <script src="js/fetchUtils.js"></script>
    <script src="js/communes.js"></script>
    <script src="js/carte.js"></script>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
  </head>
<body>
<header>
<h1>Communes de la MEL</h1>
</header>
<section id="main">
  <div id="choix">
    <form id="form_communes" action="">
      <fieldset>
        <legend>Choix des communes</legend>
        <label>Territoire :
          <select name="territoire">
              <option value=""
                      data-min_lat="50.499" data-min_lon="2.789"
                      data-max_lat="50.794" data-max_lon="3.272"
              >
                Tous
              </option>
              <!-- les autres options seront crées en JS -->
          </select>
        </label>
        </fieldset>
      <button type="submit">Afficher la liste</button>
    </form>
  </div>
  <div id='carte'></div>
  <ul id="liste_communes">
</ul>

  
  <div id="details"></div>
</section>
<footer>
    <? if(alreadyLogged()) { ?>
    Connecté en tant que <?= $personne->login ?> <a href="favories.php">Liste de Favorie</a> / <a href="logout.php">Se déconnecter</a>
    <? }else{ ?>
    <a href="login.php">Connecter</a> / <a href="register.php">S'inscrire</a>
    <? } ?>
</footer>
</body>
</html>
