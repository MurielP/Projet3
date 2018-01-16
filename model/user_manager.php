<?php

class User_manager extends Database 
{
	/**
	 * createUser [insérer le nouveau user en BDD]
	 * @param [string] $username [pseudonyme]
	 * @param  [string] $password [mot de passe ]
	 * @param  [string] $email    [email]
	 * @return  le nouvel utilisateur
	 */
	public function createUser($username, $password, $email) 
	{
		$sql = ('INSERT INTO members (username, password, email, inscription_date) VALUES (?,?,?,NOW())');
		$user = $this->executeQuery($sql, array($username, $password, $email));		
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