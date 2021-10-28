<?php
 require(__DIR__."/color_defs.php"); // definit la constante COLOR_KEYWORDS


  
 /**
  *  prend en compte le paramètre $name passé en mode GET
  *   qui doit représenter un entier sans signe
  *  @return : valeur retenue, convertie en int.
  *   - si le paramètre est absent ou vide, renvoie  $defaultValue
  *   - si le paramètre est incorrect, déclenche une exception ParmsException
  *
  */
  function checkUnsignedInt(string $name,
                          ?int $defaultValue = NULL,
                          bool $mandatory = TRUE) {

    if (!isset($_GET[$name]) || $_GET[$name] == "") {
        if ($defaultValue == NULL) {
            if ($mandatory) {
                throw new ParmsException("$name absent");
            } else {
                return NULL;
            }
        } else {
            return $defaultValue;
        }

    } else {
        $val = $_GET[$name];
        if (! ctype_digit($val))
            throw new ParmsException("$name incorrect");
        return (int) $val;
    }
}
     
 ?>