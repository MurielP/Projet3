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
 * méthode qui génère la vue 
 * @param  $data (titre et vue)
 * @return $view
 */
	public function generate($data) 
	{
		$content = $this->generateFile($this->file, $data);
		$view = $this->generateFile('view/template.php', array(
			'title' => $this->title, 
			'content' => $content));

		echo $view;
	}
 /**
  * méthode qui génère fichier vue et renvoie le résultat - encapsule l'utilisation de require et permet le check de l'existence du fichier vue à afficher
  * @param  $file [nom du fichier vue à afficher]
  * @param  $data [données à afficher]
  * @return ob_get_clean pour arrêter la temporisation de sortie 
  */
	private function generateFile($file, $data) 
	{
		// Rend les éléments du tableau $donnees accessibles dans la vue
		if (file_exists($file)) {
			extract($data);
			ob_start();
			// inclut fichier vue
			// résultat placé dans le tampon de sortie 
			require $file;
			return ob_get_clean();
		} else {
			throw new Exception ('Le fichier '. $file . ' introuvable.');
		}
	}
}