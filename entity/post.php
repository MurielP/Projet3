<?php
/**
 * classe Post qui définit le constructeur, les getters et setters des billets 
 */
class Post
{
	/**
	 * __construct 
	 * @param array $data 
	 */
	public function __construct(array $data)	
	{
		$this->hydrate($data);
	}

	/**
	 * hydrate 
	 * @param  array  $data [attributs des billets]
	 * @return  appelle le setter si il existe
	 */
	public function hydrate(array $data)
    {
        // boucle avec le tableau de $data - $key = nom de la propriété et $ value = valeur
        foreach ($data as $key => $value)
        {
            // récupère le nom du setter correspondant
            $method = 'set'.ucfirst($key);

            // vérifie que le setter correspondant existe 
            if (method_exists($this, $method))
            {
                // si il existe -> on l'appelle 
                $this->$method($value);
            }
        }
    }

    /**
     * attributs 
     */
    private $id; 
    private $author;
    private $title;
    private $content;
    private $creation_date;
    private $post_amended_date; 

    /**
     * [getId]
     * @return [int] [id du post]
     */
    public function getId() 
    {
    	return $this->id;
    }

    public function getAuthor() 
    {
    	return $this->author;
    }

    public function getTitle() 
    {
    	return $this->title;
    }

    public function getContent() 
    {
    	return $this->content;
    }

    public function getFormatted_creation_date() 
    {
    	return $this->creation_date;
    }

    public function getPost_amended_date() 
    {
    	return $this->post_amended_date;
    }

    /**
     * [setId description]
     * @param [type] $id [description]
     */
    public function setId($id)
    {
    	$id = (int) $id;

    	if ($id > 0) {
    		return $this->id = $id;
    	} 
    }

    public function setAuthor($author)
    {	
    	if(is_string($author) AND strlen($author) <= 20 AND strlen($author) >= 5 AND 
            ($author = trim($author))) {
    		return $this->author = $author;
    	} else {
            $_SESSION['errors']['authorPost'] = 'Le nom de l\'auteur est invalide. Il doit comprendre entre 5 et 20 caractères alphanumériques.' ;
        }
    }

    public function setTitle($title)
    {
    	if(is_string($title) AND strlen($title <= 100) AND ($title = trim($title))) {
    		return $this->title = $title;
    	} else {
            $_SESSION['errors']['titlePost'] = 'Le titre de l\'article est invalide. Il doit être composé d\'une chaîne de moins de 100 caractères .' ;
        }
    }

    public function setContent($content)
    {
    	if(is_string($content) AND ($content = trim($content))) {
    		return $this->content = $content;
    	} else {
            $_SESSION['errors']['contentPost'] = 'Le contenu de l\'article est invalide. Il doit être composé d\'une chaîne de caractères .' ;
        }
    }
    
    public function setFormatted_creation_date($creation_date) 
    {
        return $this->creation_date = $creation_date;

    }

    public function setPost_amended_date($post_amended_date)
    {
    	return $this->post_amended_date = $post_amended_date;
    }

   
}
