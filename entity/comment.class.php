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

    public function getFormatted_comment_date() 
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
        $author = trim($author);

    	if(isset($author) AND is_string($author) AND strlen($author) <= 15 AND strlen($author) >= 5) {
    		return $this->author = $author;
    	} else {
    		$_SESSION['errorAuthor']= 'Le nom de l\'auteur doit être une chaîne de caractères qui comprend entre 5 et 15 caractères.';
    	}
    }

    public function setComment($comment)
    {
        $comment = trim($comment);

    	if(isset($comment) AND is_string($comment)) {
    		return $this->comment = $comment;
    	} else {
            $_SESSION['errorComment'] = 'Le commentaire doit être une chaîne de caractères.';
        }
    }

    public function setFormatted_comment_date($comment_date) 
    {
        return $this->comment_date = $comment_date;

    }  
}