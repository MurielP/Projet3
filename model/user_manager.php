<?php
class User_manager extends Database 
{
	/**
	 * [verifyUserByPassword] vérifie le mot de passe 
	 * @param  [type] $adminCheck     [nveau User créé dans contrôleur]
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
				// Vérifie que mot de passe saisi correspond au password haché en bdd
			if ($adminCheck AND password_verify($passwordAdmin, $result['password'])) {
				$adminCheck->setId($result['id']);
				$adminCheck->setUsername($result['username']);
				return $adminCheck;
			} else {
				// si aucun retour = erreur
				return false; 
			}
		} catch (Exception $e) {
			$_SESSION['errors']['errorUserBdd'] = 'Votre identifiant est erroné.';
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}
	}	

	/**
	 * [getAdminByLogin] récupère les info de l'admin 
	 * @param  [str] $admin1 [instanciation du User]
	 * @return nouveau User 
	 */
	public function getAdminByLogin($admin1)
	{
		try {
			$sql = ('SELECT id, username, DATE_FORMAT(inscription_date, \'%d %m %Y\') AS formatted_inscription_date FROM members WHERE username = ?');
			$adminBdd = $this->executeQuery($sql, array($admin1->getUsername()));
			
			$resultAdmin = $adminBdd->fetch(PDO::FETCH_ASSOC);	
			
			if ($resultAdmin != false) {
				$admin2 = new User($resultAdmin); 
				return $admin2;
			} else {
				$_SESSION['errors']['errorAdmin2'] = 'Impossible de créer $admin2.';
			}
		} catch (Exception $e) {
			$_SESSION['errors']['errorAdminBdd'] = 'Votre identifiant est erroné.';
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}
	}
}