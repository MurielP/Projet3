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
		foreach ($this->directories as $directory)
		{
			if(file_exists($path = $directory . '/' . $myClass . '.php')){
				require_once $path;
			}
		}
	}

	/** 
	* méthode registerAutoload enregistre l'autoload 
	*
	*/
	public  function registerAutoload()
	{
		spl_autoload_register(array($this, 'autoload')); 
	}

	public function addDirectories($directories)
	{
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

