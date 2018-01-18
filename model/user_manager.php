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
				$_SESSION['errors']['usernameDb'] = 'Déjà pris! Le pseudonyme choisi est déjà utilisé. Veuillez choisir un autre pseudonyme.';
			}
		}
	}

	public function getUserDetails($userId)
	{
		$sql = ('SELECT id, username, email, date_FORMAT (inscription_date, \'%d %m %Y à %Hh%imin%ss\') AS inscription_date FROM members WHERE id = ?');
		$user = $this->executeQuery($sql, array($userId));

		if ($user->rowCount() == 1)
			return $user->fetch();

		else 
			throw new Exception('Aucun membre ne correspond au numéro ' .$userId. '.');
	}
}