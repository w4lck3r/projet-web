<?php
 //require(__DIR__."/color_defs.php"); // definit la constante COLOR_KEYWORDS
  //require("ParmsException.class.php");

  //require("lib/fonctions_parms.php");
  //require("lib/fonctions_clock.php");
  
 /**
  *  prend en compte le paramètre $name passé en mode GET
  *   qui doit représenter une couleur CSS
  *  @return : valeur retenue
  *   - si le paramètre est absent ou vide, renvoie  $defaultValue
  *   - si le paramètre est incorrect, déclenche une exception ParmsException
  *
  */
 function checkColor(string $name, string $defaultValue) : string {
      /* à compléter */
      $name = $_GET[$name];
      if (!isset($name) || $name == ""){
          return $defaultValue;
        }

      if (!COLOR_KEYWORDS[$name] && isset($name) && !preg_match(COLOR_REGEXP, $name) && $name != 'transparent'){
            throw new ParmsException();
    
        }
        elseif ($name == 'transparent'){
          return (string)$name;
        }

      elseif (preg_match(COLOR_REGEXP, $name) ){
        return $name;
      }


      else{
        return (string)$name;
      }

  }
  
 /**
  *  prend en compte le paramètre $name passé en mode GET
  *   qui doit représenter un entier sans signe
  *  @return : valeur retenue, convertie en int.
  *   - si le paramètre est absent ou vide, renvoie  $defaultValue
  *   - si le paramètre est incorrect, déclenche une exception ParmsException
  *
  */
 function checkUnsignedInt(string $name, ?int $defaultValue=NULL, bool $mandatory = TRUE) : ?int {
    if ( ! isset($_REQUEST[$name]) || $_REQUEST[$name]=="" ){
        if ($defaultValue !== NULL)
            return $defaultValue;
        else if ($mandatory)
            throw new ParmsException("$name absent");
        else
            return NULL;
    }
    $val = $_REQUEST[$name];
    if (! ctype_digit($val))
        throw new ParmsException("$name incorrect");
    return (int) $val;
}

/**
 *  prend en compte le paramètre $name passé en mode REQUEST
 *   qui doit représenter une chaîne
 *  @return : valeur retenue
 *   - si le paramètre est absent ou vide, renvoie  $defaultValue
 *   - si le paramètre est incorrect, déclenche une exception ParmsException
 *
 */
function checkString(string $name, ?string $defaultValue=NULL, bool $mandatory = TRUE) : ?string {
    if ( ! isset($_REQUEST[$name]) || $_REQUEST[$name]=="" ){
        if ($defaultValue !== NULL)
            return $defaultValue;
        else if ($mandatory)
            throw new ParmsException("$name absent");
        else
            return NULL;
    }
    $val = $_REQUEST[$name];
    return $val;
}

        

  //catch(ParmsException $e){
    //     require('views/pageErreur.html');

  //}
     
 ?>