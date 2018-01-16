<?php

class User_manager extends Database 
{
	/**
	 * addUser [insérer le nouveau user en BDD]
	 * @param [string] $Username [pseudonyme]
	 */
	public function createUser($username, $password, $email) 
	{
		$sql = ('INSERT INTO members (username, password, email, inscription_date) VALUES (?,?,?,NOW())');
		$user = $this->executeQuery($sql, array($username, $password, $email));
	}
}