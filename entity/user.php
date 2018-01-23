<?php 

class User
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
    private $username;
    private $password;
    private $email; 
    private $inscritpion_date; 

    /**
 	* liste les getters 
	*/
	public function getId() 
	{ 
		return $this->id; 
	}

	public function getUsername()
	{ 
		return $this->username; 
	}

	public function getPassword() 
	{ 
		return $this->password; 
	}

	public function getEmail() 
	{ 
		return $this->email; 
	}

	public function getInscription_date() 
	{ 
		return $this->inscription_date; 
	}

	/**
 	* liste les setters 
	*/

 	/** [setId Id du user] */
	public function setId($id)
	{
		$id = (int)$id;
		if ($id > 0) {
			$this->id = $id;
		}
	}
	/** [setUsername pseudonyme] */
	public function setUsername($username) 
	{
		if (is_string(trim($username)) AND preg_match('#^[a-zA-Z0-9]{5,15}$#', $username)) {
			if (ucfirst($username) != $username) {
				$_SESSION['errors']['usernameFormatUC'] ='Votre pseudonyme doit commencer par une majuscule.';
			} else {
				$this->username = $username;
			}
		} else {
			$_SESSION['errors']['usernameFormatError'] = 'Votre pseudonyme est invalide. Il doit comprendre entre 5 et 15 caractères alphanumériques. Les espaces vides ne sont pas acceptés.' ;
		}
	}
	/**
	 * [setPassword mot de passe]
 	* @param [string] $password [mot de passe haché]
 	*/
	public function setPassword($password) 
	{	
		$password = trim($password);

		if (!empty ($password)){
			$password_hash = password_hash($password, PASSWORD_BCRYPT);
			$this->password = $password_hash;
		} else {
			$_SESSION['errors']['passwordError'] = 'Le mot de passe saisi  n\'est pas correct';
		}
	}
	/** [setEmail email]
	* @param [string] $email selon regex
	**/
	public function setEmail($email) 
	{
		$email = trim($email);

		if(preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $email)){
			$this->email = $email;
		} else {
			$_SESSION['errors']['emailError'] = 'Le mail saisi  n\'est pas correct.';
		}
		
	}
}