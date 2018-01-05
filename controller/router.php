<?php
session_start();
/**
 * création de la classe Router 
 * dont la méthode principale analyse la requête entrante pour déterminer l'action à entreprendre 
 */
require_once 'homeControl.php';
require_once 'postControl.php';
require_once 'view/view.php';

class Router 
{
	private $postControl;

	public function __construct() {
		$this->postControl = new PostControl();
		$this->homeControl = new HomeControl();
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
						$this->postControl->post($postId);
					} else {
						throw new Exception ('Le numéro du billet est incorrect.');
					}

				} elseif ($_GET['action'] == 'toComment'){
					
					$author = $this->getParam($_POST, 'author');
					$comment = $this->getParam($_POST, 'comment');
					$post_id = $this->getParam($_POST, 'id');

					$this->postControl->toComment($author, $comment, $post_id);
				}
				
			} else {
				$this->homeControl->homePage();
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
		$view = new View("Error");
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



