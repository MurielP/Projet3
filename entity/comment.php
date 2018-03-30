<?php
class Comment
{
    /**
     * attributs 
     */
    private $id; 
    private $post_id;
    private $author;
    private $comment;
    private $comment_date;
    private $is_flagged;
    private $updated_comment;

	/**
	 * __construct 
	 * @param array $data 
	 */
	public function __construct(array $data)	
	{
        //var_dump($data);
		$this->hydrate($data);
	}

	/**
	 * hydrate - méthode pour remplir les valeurs aux attributs de l'objet Comment sous forme de tableau
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
     * getters
     */
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

    public function getIs_flagged()
    {
        return $this->is_flagged;
    }

    public function getUpdated_comment()
    {
        return $this->updated_comment;
    }

    /**
     * setters
     */
    public function setId($id)
    {
    	$id = (int) $id;

    	if ($id > 0) {
    		return $this->id = $id;
    	} else {
    		$_SESSION['errors']['errorId'] = 'L\'id du commentaire doit être de type integer et > 0.';
    	}
    }

    public function setPost_id($post_id)
    {
    	$post_id = (int) $post_id;
    	if ($post_id > 0) {
    		return $this->post_id = $post_id;
    	}  else {
    		$_SESSION['errors']['errorPostId'] = 'L\'id du billet doit être de type integer et > 0.';
    	}
    }

    public function setAuthor($author)
    {
    	if (isset($author) AND is_string($author) AND strlen($author) >= 4 AND strlen($author) <= 15 AND 
            ($author = trim($author))) {
    		return $this->author = $author;
    	} else {
    		$_SESSION['errors']['errorAuthor']= 'Le nom de l\'auteur doit être une chaîne de caractères qui comprend entre 4 et 15 caractères.';
    	}
    }

    public function setComment($comment)
    {
    	if (isset($comment) AND is_string($comment) AND strlen($comment) >= 5 AND strlen($comment) <= 1500 AND ($comment = trim($comment))) {
    		return $this->comment = $comment;
    	} else {
            $_SESSION['errors']['errorComment'] = 'Le commentaire doit être une chaîne de caractères comprise entre 5 et 1500 caractères.';
        }
    }

    public function setFormatted_comment_date($comment_date) 
    {
        return $this->comment_date = $comment_date;
    }  

    public function setIs_flagged($is_flagged)
    {
        if ($is_flagged == 1 OR $is_flagged) {
            return $this->is_flagged = true;
        } else {
            return $this->is_flagged = false;
        }
    }

    public function setUpdated_comment($updated_comment)
    {
        return $this->updated_comment;
    }
}