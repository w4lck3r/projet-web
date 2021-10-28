<?php
// fichiers requis
session_start();
set_include_path('..' . PATH_SEPARATOR);
require_once('lib/common_service.php');
require_once('lib/initDataLayer.php');
require_once('lib/fonctions_parms.php');

try {
    // traitement des paramètres
    $insee = checkUnsignedInt('insee', NULL, FALSE);
    
    if(isset($_SESSION['ident']) && isset($insee)){
        $data->favorie($insee,$_SESSION['ident']->login);
    }
    
} catch (PDOException $e) {
    produceError($e->getMessage());
} catch (ParmsException $e) {
    produceError($e->getMessage());
}
    