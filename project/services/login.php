<?php
// fichiers requis
set_include_path('..' . PATH_SEPARATOR);
require_once('lib/common_service.php');
require_once('lib/session.php');
require_once('lib/initDataLayer.php');
require_once('lib/fonctions_parms.php');

try {
    $my_authent = [$data,"authentification"];
    if(tryConnect($my_authent)){
        header('Location: ./../index.php');
    }else{
        header('Location: ./../login.php');
    }
} catch (PDOException $e) {
    produceError($e->getMessage());
} catch (ParmsException $e) {
    produceError($e->getMessage());
}

?>