<?php
/**
 * création de la classe View qui génère les instructions données aux différentes vues
 */
class View 
{
	// Nom du fichier associé à la vue
	private $file;
	// Nom du titre associé à la vue
	private $title;
	// si admin est connecté 
	private $admin;
/**
 * @param $action qui détermine le fichier vue utilisé
 */
	public function __construct($action) 
	{
		$this->file = 'view/view_' .$action .'.php'; // Détermination du nom du fichier vue à partir de l'action
	}

/**
 * [getTitle]
 * @return [str] [titre]
 */
public function getTitle() 
    {
    	return $this->title;
    }
/**
* [getFile]
* @return [str] [fichier]
 */
public function getFile() 
    {
    	return $this->file;
    }

/**
 * [getAdmin]
 * @return [bool] [admin]
 */
public function getAdmin()
{
	return $this->admin;
}

/**
 * permet de générer le titre de l'onglet
 * @param $title 
 */
	public function setTitle($title) 
	{
		$this->title = $title;
	}

/**
 * permet de générer le fichier associé la vue
 * @param $file 
 */
	public function setFile($file) 
	{
		$this->file = $file;
	}
/**
 * permet de générer si vue côté admin ou côté visiteur
 * @param $admin 
 */
public function setAdmin($admin)
{
	$this->admin = $admin;
}


/**
 * méthode qui génère la vue 
 * @param  $data (titre et vue)
 * @return $view 
 */
	public function generate($data) 
	{
		// appelle la vue selon action et récupère les données
		$content = $this->generateFile($this->file, $data);

		$view = $this->generateFile('view/template.php', array(
			'title' => $this->title, // onglet
			'content' => $content, // contenu
			'admin' => $this->getAdmin(), // si true alors image masquée / si false image affichée 	
		));

		echo $view;
	}
 /**
  * méthode qui génère fichier vue et renvoie le résultat - encapsule l'utilisation de require et permet la vérification de l'existence du fichier vue à afficher
  * @param  $file [nom du fichier vue à afficher]
  * @param  array($data) [données à afficher]
  * @return ob_get_clean pour arrêter la temporisation de sortie 
  */
	private function generateFile($file, $data) 
	{
		// Rend les éléments du tableau $donnees accessibles dans la vue
		if (file_exists($file)) {
			// vérifie l'existence d'une variable / transforme en variable les index d'un tableau associatif 
			extract($data);
			ob_start();
			// inclut fichier vue
			// résultat placé dans le tampon de sortie 
			require $file;
			return ob_get_clean();
		} else {
			throw new Exception ('Le fichier '. $file . ' est introuvable.');
		}
	}
}