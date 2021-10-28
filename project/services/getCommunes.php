<?php
// fichiers requis
set_include_path('..' . PATH_SEPARATOR);
require_once('lib/common_service.php');
require_once('lib/initDataLayer.php');
require_once('lib/fonctions_parms.php');

try {
    // traitement des paramètres
    $territoire = checkUnsignedInt('territoire', NULL, FALSE);
    // interrogation de la bdd
    $communes = $data->getCommunes( $territoire );
    // production du résultat
    function utf8ize($d) {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = utf8ize($v);
            }
        } else if (is_string ($d)) {
            return utf8_encode($d);
        }
        return $d;
    }
    produceResult(utf8ize($communes));
} catch (PDOException $e) {
    produceError($e->getMessage());
} catch (ParmsException $e) {
    produceError($e->getMessage());
}
?>
