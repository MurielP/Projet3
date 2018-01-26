<?php

class User_manager extends Database 
{
	/**
	 * [createUser] requête préparée qui insère le nouveau $user ds la table membres et prend en paramètre $user
	 * @param  [type] $user [fait appel aux contrôles effectués dans l'entité user.php]
	 * @return nouveau $user
	 */
	public function createUser($user) 
	{

		try {
			$sql = ('INSERT INTO members (username, password, email, inscription_date) VALUES (?,?,?,NOW())');
			$result = $this->executeQuery($sql, array(
				$user->getUsername(),
				$user->getPassword(),
				$user->getEmail()
				));		
			return $result; 
		/**
		 * catch pour attraper les erreurs liées à la bdd 
		 */
		} catch (Exception $e){
			// erreur 23000 car clé unique pour le username en bdd
			if($e->getCode() == 23000){
				$_SESSION['errors']['usernameDb'] = 'Déjà pris! Le pseudonyme '. $user->getUsername() .' est déjà utilisé. Veuillez choisir un autre pseudonyme.';
			}else {
				$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
			}
		}
	}

	/**
	 * [alreadyExists($email)] vérifie si le mail existe déjà en base de données
	 * @param  $email [mail à vérifier]
	 * @return [bool] retourne la 1ère colonne - fetchColumn() - depuis la ligne suivante d'un jeu de résultats ou FALSE s'il n'y a plus de ligne
	 */
	public function alreadyExists($user)
	{		
			// COUNT(*)  --counts all values including null
			$sql = ('SELECT COUNT(*) AS nb_resultat FROM members WHERE email = ?');
			$req = $this->executeQuery($sql, array(
				$user->getEmail())
			);
			$resultMail = $req->fetchColumn(); 
			//var_dump($resultMail); 

			if ($resultMail == 1){
				$_SESSION['errors']['existingEmail'] = 'L\'email  '. $user->getEmail() .' existe déjà en base données. Veuillez choisir un autre email.';
			} 
	}
	
	public function getUserByLogin($user)
	{
		$sql = ('SELECT id, username, email, date_FORMAT (inscription_date, \'%d %m %Y à %Hh%imin%ss\') AS inscription_date FROM members WHERE $username = ?');
		$userBdd = $this->executeQuery($sql, array(
			$user->getUsername()
			));
		// si on a trouvé un $userBdd 
			// if ($userBdd == 1) {
		// alors on va regarder avec la fontion de verifpassword() si exist
		// 
			// si ok on va formater $userBdd comme un $user normal avec set
			// renvoie vers controleur  et ajout de session
			
	}

	/**
	 * [getUserDetails] récupère les infos d'un membre 
	 * @param  [int] $id [id du membre]
	 * @return [bool]retourne le nombre de lignes affectées par la dernière requête DELETE, INSERT ou UPDATE exécutée par l'objet PDOStatement correspondant. 
	 */
	public function getUserDetails($id)
	{
		$sql = ('SELECT id, username, email, date_FORMAT (inscription_date, \'%d %m %Y à %Hh%imin%ss\') AS inscription_date FROM members WHERE id = ?');
		$user = $this->executeQuery($sql, array(
			$user->getId()
			));

		if ($user->rowCount() == 1) {
			return $user->fetch();
		} else {
			throw new Exception('Aucun membre ne correspond au numéro ' .$user->getId. '.');
		}
	}
}