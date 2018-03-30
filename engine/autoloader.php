<?php
/**
 * classe Autoloader
 */
class Autoloader
{
	protected  $directories = array();

	/**
	 * méthode autoload pour charger les fichiers 
	 * @param  [string] $myClass [nom de la classe à charger]
	 * @return [bool] si true enregistre l'autoloader
	 */
	private  function autoload($myClass)
	{
		// Boucle pour parcourir chaque directory afin de charger le fichier comprenant la classe requise une seule fois(require_once)
        // Si on retrouve la même classe dans un répertoire plus tard, cette classe sera ignorée grâce au require_once 
		foreach ($this->directories as $directory)
		{
			if(file_exists($path = $directory . '/' . $myClass . '.php')){
				require_once $path;
			}
		}
	}

	/** 
	* méthode registerAutoload enregistre l'autoload 
	* $this = classe Autoloader
	*/
	public function registerAutoload()
	{	
		// chq fois qu'une classe non déclarée est appelée, la fonction enregistrée via spl_autoload_register est appelée avec le nom de la classe - crée une file d’attente de fonctions d’autochargement et les exécute les unes après les autres
		spl_autoload_register(array($this, 'autoload')); 
	}

	/**
	 * [addDirectories] ajouter des directories 
	 * @param [type] $directories [fichiers à ajouter ds le tableau]
	 */
	public function addDirectories($directories)
	{
		// transtypage en array
		$this->directories = (array)$directories;
	}
}


