<?php
// fichiers requis
set_include_path('..' . PATH_SEPARATOR);
require_once('lib/common_service.php');
require_once('lib/initDataLayer.php');
require_once('lib/fonctions_parms.php');

try {
    $data->createUser($_POST['login'],$_POST['password'],$_POST['nom'],$_POST['prenom']);
} catch (PDOException $e) {
    produceError($e->getMessage());
} catch (ParmsException $e) {
    produceError($e->getMessage());
}
?>
