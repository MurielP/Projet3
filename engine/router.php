<?php
/**
 * création de la classe Router 
 * dont la méthode principale analyse la requête entrante pour déterminer l'action à entreprendre 
 */
/*
require_once 'controller/autoloader.php';
Autoloader::registerAutoload();
*/

//require_once 'home_control.php';
//require_once 'post_control.php';
//require_once 'view/view.php';

class Router 
{
	private $post_control;
	private $home_control;
	private $user_control;

	public function __construct() {
		$this->post_control = new Post_control();
		$this->home_control = new Home_control();
		$this->user_control = new User_control();
	}
/**
 * [routeQuery méthode qui permet d'appeler la page nécessaire pour exécuter l'action passée en paramètre
 * @return affiche la page demandée
 */
	public function routeQuery() {
		try {
			if (isset($_GET['action'])) {
				if ($_GET['action'] == 'post') {

					$postId = intval($this->getParam($_GET, 'id'));

					if ($postId != 0) {
						$this->post_control->post($postId);
					} else {
						throw new Exception ('Le numéro du billet est incorrect.');
					}

				} elseif ($_GET['action'] == 'toComment'){

					if(!empty($_POST['author'])  AND !empty($_POST['comment'])){
					$author = $this->getParam($_POST, 'author');
					$comment = $this->getParam($_POST, 'comment');
					$post_id = $this->getParam($_POST, 'id');

					$this->post_control->toComment($author, $comment, $post_id);
					}
				} elseif ($_GET['action'] == 'registerUser') {
					
					if(!empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['email'])){
						$username = $this->getParam($_POST, 'username');
						$password = $this->getParam($_POST, 'password');
						$email = $this->getParam($_POST, 'email');

						$this->user_control->registerUser($username, $password, $email);
					} else {
						$this->user_control->registerUserPage();
					}
				} else {
					throw New Exception ('Action non valide.');
				 // elseif ($_GET['action'] == 'logUser') {}
				}
				// } elseif ($_GET['action'] == 'logOutUser') {}
				
			} else {
				$this->home_control->homePage();
			}
		} 
		catch (Exception $e) {
			$this->error($e->getMessage());
		}
	}

/**
 * error méthode qui permet de générer la vue pour les messages d'erreur
 * @param  [string] $errorMessage 
 * @return [string]  message d'erreur dans la vue             
 */
	private function error($errorMessage) {
		$view = new View('error');
		$view->generate(array(
			'errorMessage' => $errorMessage));
	}

/** 
* getParam méthode privée qui recherche un paramètre dans un tableau. Si un paramètre est manquant on affiche un message indiquant le nom du parmètre manquant 
*/
	private function getParam($array, $name) {
		if (isset($array[$name])) {
			return $array[$name];
		} else 
		throw new Exception ('Le paramètre ' . $name . ' est absent.');
	}
}



