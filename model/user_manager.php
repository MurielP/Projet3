<?php

class User_manager extends Database 
{

	/**
	 * [verifyUserByPassword] si mot de passe  vérifié
	 * @param  [type] $adminCheck     [instanciation de la classe User créée dans contrôleur]
	 * @param  [type] $passwordAdmin  [mot de passe saisi dans le formulaire de la page view_admin]
	 * @return [type] $adminCheck     [administrateur]
	 */
	public function verifyUserByPassword($adminCheck, $passwordAdmin)
	{
		try {
			$sql = ('SELECT id, username, password FROM members WHERE username = ?');
			$userBdd = $this->executeQuery($sql, array($adminCheck->getUsername()));
			
			$result = $userBdd->fetch();	
			//var_dump($result);
				// si j'ai un $adminCheck et que password_verify est ok -> je crée un admin avec les caractéristiques du user
				if($adminCheck AND password_verify($passwordAdmin, $result['password'])){

					$adminCheck->setId($result['id']);
					$adminCheck->setUsername($result['username']);

					return $adminCheck;
				} else {
					// si aucun retour = erreur
					return false; 
				}
		} catch(Exception $e) {
			$_SESSION['errors']['errorUserBdd'] = 'Votre identifiant est erroné.';
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}
	}	

	/**
	 * [getAdminByLogin] récupère les info de l'admin 
	 * @param  [str] $admin1 [instanciation du User]
	 * @return [type]         [description]
	 */
	public function getAdminByLogin($admin1)
	{
		try{
			$sql = ('SELECT id, username, DATE_FORMAT(inscription_date, \'%d %m %Y\') AS formatted_inscription_date FROM members WHERE username = ?');
			$adminBdd = $this->executeQuery($sql, array($admin1->getUsername()));
			
			$resultAdmin = $adminBdd->fetch(PDO::FETCH_ASSOC);	
			
			if($resultAdmin != false){
				$admin2 = new User($resultAdmin); 
				return $admin2;
			} else {
				$_SESSION['errors']['errorAdmin2'] = 'Impossible de créer $admin2.';
			}
		}catch(Exception $e){
			$_SESSION['errors']['errorAdminBdd'] = 'Votre identifiant est erroné.';
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}
	}

	/**
	 * [getUserByLogin] récupère l'identifiant de l'admin
	 * @param  [type] $user [description]
	 * @return [type]       [description]
	 */
	public function getUserByLogin($user)
	{
		try{
		$sql = ('SELECT id, username, email, DATE_FORMAT(inscription_date, \'%d %m %Y\') AS formatted_inscription_date FROM members WHERE username = ?');
		$userBdd = $this->executeQuery($sql, array($user->getUsername()));
		
		// fetch(PDO::FETCH_ASSOC) :Retourne la ligne suivante en tant qu'un tableau indexé par le nom des colonnes
		$result = $userBdd->fetch(PDO::FETCH_ASSOC);
		//print_r($result);
		$user = new User($result);
		return $user;

		}catch(Exception $e){
			$_SESSION['errors']['errorUserBdd'] = 'Votre identifiant est erroné.';
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}
	}

	
	/**
	 * [createUser] requête préparée qui insère le nouveau $user ds la table membres et prend en paramètre $user
	 * @param  [type] $user [fait appel aux contrôles effectués dans l'entité user.php]
	 * @return [$result] le nouveau $user
	 */
	public function createUser($user) 
	{
		try {
			$sql = ('INSERT INTO members (username, email, password, inscription_date) VALUES (?,?,?,NOW())');
			$result = $this->executeQuery($sql, array(
				$user->getUsername(),
				$user->getEmail(),
				$user->getPassword(),
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
				$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' et le code erreur est : '.$e->getCode() .'';
			}
		}
	}

	/**
	 * [emailExists] vérifie si le mail du $user existe déjà en base de données
	 * @param  [str] $user []
	 * @return [bool] retourne la 1ère colonne - fetchColumn() - depuis la ligne suivante d'un jeu de résultats ou FALSE s'il n'y a plus de ligne
	 */
	public function emailExists($user)
	{		
		try {
			// COUNT(*)  --counts all values including null
			$sql = ('SELECT COUNT(*) AS nb_resultat FROM members WHERE email = ?');
			$req = $this->executeQuery($sql, array(
				$user->getEmail()
			));
			// récupère la 1ère colonne ici colonne email
			$resultMail = $req->fetchColumn(); 
			//var_dump($resultMail); 

			// si le mail existe en bdd -> je crée un tableau d'erreurs que je stocke ds une variable de session $_SESSION
			if ($resultMail == 1){
				$_SESSION['errors']['existingEmail'] = 'L\'email  '. $user->getEmail() .' existe déjà en base données. Veuillez choisir un autre email.';
			} 
		} catch (Exception $e){
				$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' et le code erreur est : '.$e->getCode() .'';
			}
	}
	

	/**
	 * [getUserDetails] récupère les infos d'un membre 
	 * @param  [int] $id [id du membre]
	 * @return [bool]retourne le nombre de lignes affectées par la dernière requête DELETE, INSERT ou UPDATE exécutée par l'objet PDOStatement correspondant. 
	 */
/*	public function getUserDetails($userId)
	{
		$sql = ('SELECT id, username, email, date_FORMAT (inscription_date, \'%d %m %Y à %Hh%imin%ss\') AS inscription_date FROM members WHERE id = ?');
		$userDetails = $this->executeQuery($sql, array($userId));

		if ($userDetails->rowCount() > 0) {
			$result = new User($userDetails->fetch());
			return $result;
		} else {
			throw new Exception('Aucun membre ne correspond au numéro ' .$userDetails->getId(). '.');
		}
	}
*/	
}