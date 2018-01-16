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
		return $this->id = $id; 
	}

	public function getUsername()
	{ 
		return $this->username = $username; 
	}

	public function getPassword() 
	{ 
		return $this->password = $password; 
	}

	public function getEmail() 
	{ 
		return $this->email = $email; 
	}

	public function getInscription_date() 
	{ 
		return $this->inscription_date = $inscription_date; 
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
		if (is_string($username) AND strlen($username) <= 50){
			$this->username = $username;
		} else {
			$_SESSION['usernameError'] = 'Votre pseudonyme est invalide. Il doit être composé de caractères alphanumériques.' ;
		}
	}
	/**
	 * [setPassword mot de passe]
 	* @param [string] $password [mot de passe haché]
 	*/
	public function setPassword($password) 
	{	
		if (!empty ($password)){
			$password = password_hash($password, PASSWORD_BCRYPT);
			$this->password = $password;
		} else {
			$_SESSION['passwordError'] = 'Le mot de passe saisi  n\'est pas correct';
		}
	}
	/** [setEmail email]
	* @param [string] $email selon regex
	**/
	public function setEmail($email) 
	{
		if (preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $email)) {
			$this->email = $email;
		} else {
			$_SESSION['emailError'] = 'L\'email saisi n\'est pas valide';
		}
	}
}