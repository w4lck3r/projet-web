<?php
class DataLayer {
	// private ?PDO $conn = NULL; // le typage des attributs est valide uniquement pour PHP>=7.4

	private  $conn = NULL; // connexion de type PDO   compat PHP<=7.3
	
	/**
	 * @param $DSNFileName : file containing DSN 
	 */
	function __construct(string $DSNFileName){
		$dsn = "uri:$DSNFileName";
		$this->connexion = new PDO($dsn);
		// paramètres de fonctionnement de PDO :
		$this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // déclenchement d'exception en cas d'erreur
		$this->connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC); // fetch renvoie une table associative
		// réglage d'un schéma par défaut :
		$this->connexion->query('set search_path=authent');
	}
    
    
    function authentificationProvisoire(string $login, string $password) : ?Identite{
       // à compléter
       $sql = <<< EOD
       select login , nom , prenom 
       from users
       where login= :login and password= :password
       EOD;
       $stmt = $this->conn->prepare($sql);
       $stmt->bindValue('login',$login);
       $stmt->bindValue('password',$password);
       $stmt->execute();
       $res =  $res->fetch();
       if($res){
           return new Identite($res['login'],$res['nom'],$res['prenom']);
       }else{
           return NULL;
       }
    }
    
    function authentification(string $login, string $password) : ?Identite{ // version password hash
            // à compléter
    }
    /**
    * @return bool indiquant si l'ajout a été réalisé
    */
    function createUser(string $login, string $password, string $nom, string $prenom) : bool	 {
        $sql = <<<EOD
        insert into "users" (login, password, nom, prenom)
        values (:login, :password, :nom, :prenom)
EOD;
               // à compléter
               $stmt= $this->conn->prepare($sql);
               $stmt->bindValue('login',$ogin);
               $stmt->bindValue('password',$password);
               $stmt->bindValue('nom',$nom);
               $stmt->bindValue('prenom',$prenom);
               try{
                   $stmt->execute();
                   return $stmt->rowCount == 1;
               }catch(PDOException $e){
                   return false;
               }

    }
	
}
?>
