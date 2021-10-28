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
		//$this->connexion->query('set search_path=authent');
	}
    
    
	/**
	 * Liste des territoires
	 * @return array tableau de territoires
	 * chaque territoire comporte les clés :
		* id (identifiant, entier positif),
		* nom (chaîne),
		* min_lat (latitude minimale, flottant),
		* min_lon (longitude minimale, flottant),
		* max_lat, max_lon
	 */
	function getTerritoires(): array {
		$sql = "select id, nom , min_lat, min_lon, max_lat, max_lon from territoires";
		$stmt = $this->connexion->prepare($sql);
		$stmt->execute();
		$res= $stmt->fetchAll();
		return $res;
	}
	
	/**
	 * Liste de communes correspondant à certains critères
	 * @param territoire : territoire des communes cherchées
	 * @return array tableau de communes (info simples)
	 * chaque commune comporte les clés :
		* insee (chaîne),
		* nom (chaîne),
		* lat, lon 
		* min_lat (latitude minimale, flottant),
		* min_lon (longitude minimale, flottant),
		* max_lat, max_lon
	 */
	function getCommunes(?int $territoire=NULL): array {
		//$sql = "select insee, nom, lat, lon from communes";
		$sql = "SELECT communes.insee, communes.nom, communes.lat, communes.lon, territoires.min_lat, territoires.min_lon, territoires.max_lat, territoires.max_lon FROM communes INNER JOIN territoires ON communes.territoire=territoires.id;";
		$conds =[];  // tableau contenant les code SQL de chaque condition à appliquer
		$binds=[];   // association entre le nom de pseudo-variable et sa valeur
		if ($territoire !== NULL){
			$conds[] = "territoire = :territoire";
			$binds[':territoire'] = $territoire;
		}
		if (count($conds)>0){ // il ya au moins une condition à appliquer ---> ajout d'ue clause where
			$sql .= " where ". implode(' and ', $conds); // les conditions sont reliées par AND
		}
		$stmt = $this->connexion->prepare($sql);
		$stmt->execute($binds);
		$res= $stmt->fetchAll() ;
		return $res;
	}
	
	
	/**
	 * Information détaillée sur une commune
	 * @param insee : code insee de la commune
	 * @return commune ou NULL si commune inexistante
	 * l'objet commune comporte les clés :
	 *	insee, nom, nom_terr, surface, perimetre, pop2016, lat, lon, geo_shape
	 */
	function getDetails(string $insee): ?array {
		$sql = <<<EOD
			select insee, communes.nom, territoires.nom as nom_terr, surface, perimetre, population.pop_totale as pop2016,
			lat, lon, geo_shape   from communes 
			join communes_mel.territoires on id=territoire
			natural left join communes_mel.population
			where (recensement=2016 or recensement is null) and insee=:insee
EOD;
		$stmt = $this->connexion->prepare($sql);
		$stmt->execute([':insee'=>$insee]);
		$res= $stmt->fetch() ;
		return $res ? $res : NULL;
	}
    
    
    function authentification(string $login, string $password) : ?Identite{ // version password hash
			$sql = "select login, nom, prenom from users where login = :login and password = :password ";
			$stmt = $this->connexion->prepare($sql);
			$stmt->bindValue('login', $login);
    		$stmt->bindValue('password', $password);
			$stmt->execute();
			$res = $stmt->fetch(); // renvoie une table assoc ou False
			
			if ($res) {
				return new Identite($res['login'], $res['nom'], $res['prenom']);
				header('Location : ./');
			} else {
				return NULL;
			}

			
    }
    /**
    * @return bool indiquant si l'ajout a été réalisé
    */
    function createUser(string $login, string $password, string $nom, string $prenom) : bool	 {
		$sql = "insert into users (login, password, nom, prenom) values (:login, :password, :nom, :prenom)";
		$stmt = $this->connexion->prepare($sql);
		$stmt ->bindValue('login',$login);
		$stmt ->bindValue('password',$password);
		$stmt ->bindValue('nom',$nom);
		$stmt ->bindValue('prenom',$prenom);
		try{
			$stmt->execute();
			echo json_encode(["status" => "ok","login" => $login ]);
		}
		catch(PDOException $e){
			echo json_encode(["status" => "error"]);
		}
    }
		
}
?>
