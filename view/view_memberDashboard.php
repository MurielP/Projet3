<?php
 '<pre>' . print_r($user,true) . '</pre>';
	if(isset($_SESSION['errors']) AND !empty($_SESSION['errors'])) {
		foreach ($_SESSION['errors'] as $type => $message) {
?>
	<div class="alert">
		<ul>
			<li><?= $message ?></li>
		</ul>
	</div>
<?php
}
}	
	//  création d'un tableau vide pour vider les erreurs
	$_SESSION['errors'] = [];
?>
<article>
    <header>
    	<ul>
    		<a href="index.php">Retour à l'accueil</a>
   	 </ul>
    </header>
		<h2>Mon compte</h2>

		<h3>Bonjour <?= $_SESSION['userUsername']?> !</h3> <!-- méthode registerUser ds user_control--> 
		<p>Votre identifiant est : <?= htmlspecialchars($user->getUsername()) ?><br/>
		Votre email est : <?= htmlspecialchars($user->getEmail()) ?><br/>
		Date d'inscription : <?= htmlspecialchars($user->getFormatted_inscription_date() )?><br />
		</p>
</article>	

<hr/>

<article>
	<h2>Mes commentaires</h2>
	<p>Afficher liste des commentaires. </br>
	Lien qui renvoie au billet et ses commentaires </br>
	Lien qui permet de modifier le commentaire</p>
</article>

<hr/>

<article>
	<p>Ajouter les fonctionnalités suivantes :</p>
	<ul>
		<li>Modifier mon email</li>
		<li>Changer mon mot de passe</li>
		<li>Ajouter un avatar</li>
	</ul>
</article>			
				