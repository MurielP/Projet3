<?php

class Comment
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
    private $post_id;
    private $author;
    private $comment;
    private $comment_date;

    public function getId() 
    {
    	return $this->id;
    }

    public function getPost_id()
    {
    	return $this->post_id;
    }

    public function getAuthor() 
    {
    	return $this->author;
    }

    public function getComment() 
    {
    	return $this->comment;
    }

    public function getComment_date() 
    {
    	return $this->comment_date;
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

    public function setPost_id($post_id)
    {

    	$post_id = (int) $post_id;
    	if ($post_id > 0) {
    		return $this->post_id = $post_id;
    	}  else {
    		trigger_error('L\'id du billet doit être de type integer et > 0.', E_USER_ERROR);
    		// return false; 
    	}
    }

    public function setAuthor($author)
    {	
    	if(is_string($author) AND strlen($author <= 30)) {
    		return $this->author = $author;
    	} else {
    		trigger_error('Le nom de l\'auteur doit être une chaîne de caractères qui comprend moins de 30 caractères.', E_USER_ERROR);
    		
    	}
    }

    public function setComment($comment)
    {
    	if(is_string($comment)) {
    		return $this->comment = $comment;
    	}
    }

    public function setComment_date($comment_date) 
    {
        return $this->comment_date = $comment_date;

    }
}