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
		// chq fois qu'une classe non déclarée est appelée, la fonction enregistrée via spl_autoload_register est appelée avec le nom de la classe
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

// ne pas lancer d'exception pour laisser la place au prochain autoloader
/*class Autoloader
{
	/** 
	* méthode registerAutoload enregistre l'autoload 
	*
	
	public static function registerAutoload()
	{
		spl_autoload_extensions('.php, .class.php');
		spl_autoload_register(array(__CLASS__, 'autoload')); 
	}

	/**
	 * méthode autoload pour charger les fichiers 
	 * @param  [string] $myClass [nom de la classe à charger]
	 * @return [bool] si true enregistre l'autoloader
	 
	public static function autoload($myClass)
	{
		echo 'Chargement de la classe "' . $myClass . '" via la méthode "' . __METHOD__ . '()"';

		$myClass = strtolower($myClass);

		// si namespace : $myClass = str_replace('\\',DIRECTORY_SEPARATOR, $myClass ); 
		require_once __DIR__ .'/'. $myClass .'.php';
	}
}
*/

