<?php
// require_once 'controller/autoloader.php';
// Autoloader::registerAutoload();
//require_once 'home_control.php';
//require_once 'post_control.php';
//require_once 'view/view.php';


/**
 * création de la classe Router 
 * dont la méthode principale analyse la requête entrante pour déterminer l'action à entreprendre 
 */

class Router 
{
	private $post_control;
	private $home_control;
	private $user_control;
	private $admin_control;

	public function __construct() {
		$this->post_control = new Post_control();
		$this->home_control = new Home_control();
		$this->user_control = new User_control();
		$this->admin_control = new Admin_control();
	}
/**
 * [routeQuery méthode qui permet d'appeler la page nécessaire pour exécuter l'action passée en paramètre
 * @return affiche la page demandée
 */
	public function routeQuery() {
		try {
			if (isset($_GET['action'])) {
				if ($_GET['action'] == 'post') {

					// déclaration de la variable $post_id qui récupère l'id du billet
					$post_id = intval($this->getParam($_GET, 'id'));

					// si j'ai un id de billet, je vais chercher la méthode post($post_id) pour afficher le détail du billet choisi
					if ($post_id > 0) {
						$this->post_control->post($post_id);
					} else {
						/**
						 * lance une instance de la classe Exception selon son constructeur
						 * public __construct (
						 * [ string $message = "" 
						 * [, int $code = 0 
						 * [, Throwable $previous = NULL ]]] )
						 */
						throw new Exception ('Le numéro du billet est incorrect.');
					}

				} elseif ($_GET['action'] == 'addComment'){
					/*
					* si les champs sont remplis correctement -> j'appelle la méthode pour enregistrer le comment(manager)
					*/				
					if(!empty($_POST['author']) AND !empty($_POST['comment'])){
					$author = $this->getParam($_POST, 'author');
					$comment = $this->getParam($_POST, 'comment');
					$post_id = $this->getParam($_POST, 'id');

					$this->post_control->addComment($author, $comment, $post_id);
					/**
					 * si j'ai des erreurs j'affiche un msg et je renvoie vers la page du billet choisi avec ses commentaires
					 */
					} else {
						if (empty($_POST['author'])){
							$author = $this->getParam($_POST, 'author');
							$_SESSION['errors']['emptyAuthor'] = 'Le champ Auteur doit être rempli';

						} if (empty($_POST['comment'])){
							$comment = $this->getParam($_POST, 'comment');
							$_SESSION['errors']['emptyComment'] = 'Le champ Commentaire doit être rempli';
						}
						// vérifie si j'ai un id de billet 
						$post_id = (int)$this->getParam($_POST, 'id');

						// si id de billet mais des erreurs, je renvoie sur la page du billets et ses commentaires 
						if ($post_id > 0) {
							header('Location: index.php?action=post&id=' .$post_id ); // non traité $_POST
						} else {
							header('Location : index.php');
						}
					} 
				} elseif ($_GET['action'] == 'registerUser') {
					/*
					* si les champs sont remplis et que mon mdp de confirmation est ok -> j'appelle la méthode pour enregistrer le nouveau user(manager)
					*/
					if(!empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['email']) AND!empty($_POST['confirm_password'])){

						$username = $this->getParam($_POST, 'username');
						$password = $this->getParam($_POST, 'password');
						$email = $this->getParam($_POST, 'email');
						$confirm_password = $this->getParam($_POST, 'confirm_password');

						$this->user_control->registerUser($username, $password, $email, $confirm_password);
						
					} else {
						/**
						 * si mon champ est vide j'envoie un msg d'erreur 
						 */
						if (isset($_POST['username']) AND empty($_POST['username'])){
							$_SESSION['errors']['emptyUser'] = 'Le champ Pseudo doit être rempli';

						} if (isset($_POST['email']) AND empty($_POST['email'])){
							$_SESSION['errors']['emptyEmail'] = 'Le champ Email doit être rempli';
							
						} if (isset($_POST['password']) AND empty($_POST['password'])){
							$_SESSION['errors']['emptyPassword'] = 'Le champ Mot de passe doit être rempli';

						} if (isset($_POST['confirm_password']) AND empty($_POST['confirm_password'])){
							$_SESSION['errors']['emptyConfirm_password'] = 'Le champ Confirmer votre mot de passe doit être rempli';
						}
						/*
						* et je renvoie le visiteur sur la page de création de compte si les champs sont vides
						*/
						$this->user_control->registerUserPage();
					}

				// si insertion registerUser ok -> j'affiche userProfile 
				} elseif ($_GET['action'] == 'userProfile'){

					if(!empty($_SESSION['userUsername'])){
						$username = $this->getParam($_SESSION,'userUsername');
						$this->user_control->userProfile();
					}

				} elseif ($_GET['action'] == 'logAdmin') {
					// si ma session existe et n'est pas vide alors adminProfile
					if(isset($_SESSION['userUsername']) AND !empty($_SESSION['userUsername'])) {
						$this->user_control->adminProfile();
					}
					
					// si mes champs sont correctement remplis,je logAdmin
					if(!empty($_POST['username']) AND !empty($_POST['password'])) {
						$loginAdmin = $this->getParam($_POST, 'username');
						$passwordAdmin = $this->getParam($_POST, 'password');

						$this->user_control->logAdmin($loginAdmin, $passwordAdmin);

					} else {
						/**
						 * si mon champ est vide j'envoie un msg d'erreur 
						 */
						
						if (isset($_POST['username']) AND empty($_POST['username'])){						
							$_SESSION['errors']['emptyloginAdmin'] = 'Le champ Identifiant doit être rempli';
						} if (isset($_POST['password']) AND empty($_POST['password'])){					
							$_SESSION['errors']['emptyPasswordAdmin'] = 'Le champ Mot de passe doit être rempli';
						}
						/*
						* et je renvoie l'admin sur la page de connexion  si les champs sont vides
						*/
						$this->user_control->tryLogAdmin();
					}
				// si insertion logAdmin ok -> j'affiche adminProfile	
				}elseif ($_GET['action'] == 'adminProfile'){
					
					if(!empty($_SESSION['userUsername'])){
						$username = $this->getParam($_SESSION,'userUsername');
						$this->user_control->adminProfile();
					} else {
						throw new Exception ('Vous ne pouvez pas accéder à la page d\'administration.');
					}
				} elseif ($_GET['action'] == 'logout') {
					if(isset($_SESSION['userUsername']) AND !empty($_SESSION['userUsername'])){
						$this->user_control->logout();
					}

				} elseif ($_GET['action'] == 'addPost') {
					//si tous les chps du form sont remplis -> méthode controleur createPost()
					if(!empty($_POST['author']) AND !empty($_POST['title']) AND !empty($_POST['content'])){

						$author = $this->getParam($_POST, 'author');
						$title = $this->getParam($_POST, 'title');
						$content = $this->getParam($_POST, 'content');
						
						$this->admin_control->addPost($author, $title, $content);
					} else {
					/**
						 * si mon champ est vide j'envoie un msg d'erreur 
						 */
						if (isset($_POST['author']) AND empty($_POST['author'])){
							$_SESSION['errors']['emptyAuthor'] = 'Le champ Auteur doit être rempli';

						} if (isset($_POST['title']) AND empty($_POST['title'])){
							$_SESSION['errors']['emptyTitle'] = 'Le champ Titre doit être rempli';
							
						} if (isset($_POST['content']) AND empty($_POST['content'])){
							$_SESSION['errors']['emptyContent'] = 'Le champ Contenu doit être rempli';
						}
						/*
						* et je renvoie le visiteur sur la page de création d'article si les champs sont vides
						*/
						$this->admin_control->addPostPage();
					}
				} elseif ($_GET['action'] == 'getPostsList') { //dashboard
					$this->admin_control->getPostsList();
					
				} else {
					throw New Exception ('Action inconnue.');
				}
				
				
			} else {
				// page par défaut
				$this->home_control->homePage();
			}
		// attrape les exceptions "Exception" si existantes avec la varivable $e qui représente l'exception lancée	
		} catch (Exception $e) {
			$this->error($e->getMessage());
		}
	}

/**
 * méthode 'error' qui permet de générer la vue pour les messages d'erreur
 * @param  [string] $errorMessage 
 * @return [string]  message d'erreur dans la vue             
 */
	private function error($errorMessage) {
		$view = new View('error');
		$view->generate(array(
			'errorMessage' => $errorMessage));
	}

/** 
* getParam méthode privée qui recherche un paramètre dans un tableau. Si un paramètre est manquant on affiche un message indiquant le nom du parmètre manquant.
* $array[$key]
*/
	private function getParam($array, $name) {
		// équivaut if(isset($_POST/GET['name']))
		if (isset($array[$name])) {
			return $array[$name]; 
		} else 
		throw new Exception ('Le paramètre ' . $name . ' est absent.');
	}

}





