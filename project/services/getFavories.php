<?php
// fichiers requis
session_start();
set_include_path('..' . PATH_SEPARATOR);
require_once('lib/common_service.php');
require_once('lib/initDataLayer.php');
require_once('lib/fonctions_parms.php');

try {
    // traitement des paramètres
    $login = checkUnsignedInt('login', NULL, FALSE);
    // interrogation de la bdd
    $data->Afficherfavorie( $login );
} catch (PDOException $e) {
    produceError($e->getMessage());
} catch (ParmsException $e) {
    produceError($e->getMessage());
}
?>
