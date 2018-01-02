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
        foreach ($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                // on appelle la méthode
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

    public function getCreation_date() 
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
    	} else {
    		trigger_error('L\'id du billet doit être de type integer et > 0.', E_USER_ERROR);
    		// return false; 
    	}
    }

    public function setAuthor($author)
    {	
    	if(is_string($author) AND strlen($author <= 30)) {
    		return $this->author = $author;
    	}
    }

    public function setTitle($title)
    {
    	if(is_string($title) AND strlen($title <= 100)) {
    		return $this->title = $title;
    	}
    }

    public function setContent($content)
    {
    	if(is_string($content) AND strlen($content <= 30)) {
    		return $this->content = $content;
    	}
    }
    
    public function setCreation_date($creation_date) 
    {
        return $this->creation_date = $creation_date;

    }

    public function setPost_amended_date($post_amended_date)
    {
    	return $this->post_amended_date = $post_amended_date;
    }

    public function ValidAuthor()
    {
    	if(!empty($this->author) AND is_string($this->author) AND strlen($this->author <= 30)) {
    		return true;
    	} else {
    		trigger_error('Le nom de l\'auteur doit être de type string et sa longueur doit être inférieur à 30 caractères.', E_USER_ERROR);
    	}
    }    
}
