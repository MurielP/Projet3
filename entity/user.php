<?php 

class User
{
	/**
     * attributs 
     */
    private $id; 
    private $username;
    private $password;
    private $email; 
    private $inscription_date; 
    private $confirm_password;

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
 	* getters 
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

	public function getFormatted_inscription_date() 
	{ 
		return $this->inscription_date; 
	}

	public function getConfirm_password()
	{
		return $this->confirm_password;
	}


	/**
 	* setters 
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
		if (is_string(trim($username)) AND preg_match('#^[a-zA-Z0-9_]{5,15}$#', $username)) {
			if (ucfirst($username) != $username) {
				$_SESSION['errors']['usernameFormatUC'] ='Votre pseudonyme doit commencer par une majuscule.';
			} else {
				$this->username = $username;
			}
		} else {
			$_SESSION['errors']['usernameFormatError'] = 'Votre pseudonyme est invalide. Il doit comprendre entre 5 et 15 caractères alphanumériques.' ;
		}
	}

	/**
	 * [setPassword]  mot de passe
 	* @param [string] $password [mot de passe haché]
 	*/
	public function setPassword($password) 
	{	
		$password = trim($password);

		if (preg_match('#^[a-zA-Z0-9_]{8,32}$#', $password)) {
			// Crée une clé de hachage pour un mot de passe - PASSWORD_DEFAULT - Utilisation de l'algorithme bcrypt
			$password_hash = password_hash($password, PASSWORD_DEFAULT);
			$this->password = $password_hash;
		} else {
			$_SESSION['errors']['passwordError'] = 'Votre mot de passe saisi  n\'est pas correct. Il doit comporter au moins 8 caractères alphanumériques.';
		}
	}

	/** [setEmail email]
	* @param [string] $email selon regex
	**/
	public function setEmail($email) 
	{
		$email = trim($email);

		if(preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $email)) {
			$this->email = $email;
		} else {
			$_SESSION['errors']['emailError'] = 'Le mail saisi  n\'est pas correct. Les caractères doivent être en minuscules';
		}
	}

	/**
	 * [setConfirm_password] valide le mot de passe si les champs mot de passe et validation du mot de passe sont identiques
	 * @param [string] $confirm_password [mot de passe confirmé]
	 */
	public function setConfirm_password($confirm_password)
	{
		$confirm_password = trim($confirm_password);

		if ($_POST['confirm_password'] == $_POST['password']) {
			$this->confirm_password = $confirm_password;
		} else {
			$_SESSION['errors']['confirm_passwordError'] = 'Le mot de passe de confirmation saisi est différent. Merci de vérifier votre mot de passe. ';
		}
	}

	public function setFormatted_inscription_date($inscription_date)
	{
		$this->inscription_date = $inscription_date;
	}

}