<?php 

class User_control
{
	private $user_manager;

	public function __construct()
	{
		$this->user_manager = new User_manager();
	}

	/**
	 * [registerUser] enregistre un nouvel utilisateur
	 * @param  [str] $username [pseudo]
	 * @param  [str] $password [mot de passe]
	 * @param  [str] $mail     [mail]
	 * @return [un nouvel utilisateur et renvoie vers page dashborad]
	 */
	public function registerUser($username, $password, $email)
	{
		
		if (!isset($_SESSION['usernameError']) AND !isset($_SESSION['passwordError']) AND !isset($_SESSION['emailError'])){
			
			$user = new User(array(
				'username' => $username,
				'password' => $password,
				'email' => $email
			));

			$this->user_manager->createUser(
					$user->getUsername(),
					$user->getPassword(),
					$user->getEmail()
				);

			header('Location: index.php?action=dashboard');
		} else {
			$view = new View('user');
			$view ->setTitle('S\'inscrire');
			$view->generate(array(
				'username' => $username,
				'password' => $password,
				'email' => $email
			));
		}
	}

	public function registerUserPage()
	{
		$view = new View('user');
		$view ->setTitle('S\'inscrire');
		$view->generate(array());
	}
}



