<?php
 require(__DIR__."/color_defs.php"); // definit la constante COLOR_KEYWORDS

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
      $s= $_GET[$name];
      if(!isset($_GET[$name])||$_GET[$name]==""){
           return $defaultValue;
      }
      elseif(isset(COLOR_KEYWORDS[$s]) || preg_match(COLOR_REGEXP, $_GET[$name])|| $s==='transparent'){
           return $_GET[$name];
      }
      else{
           trhow new ParmsException();
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
 function checkUnsignedInt(string $name, int $defaultValue) : int {
       /* à compléter */
       if(!isset($_GET[$name])||$_GET[$name]==""){
          return $defaultValue;
       }
       elseif(!ctype_digit($_GET[$name])){
            throw new ParmsException();
       }
       else{ 
          return (int) $_GET[$name];
       }
  }
     
 ?>