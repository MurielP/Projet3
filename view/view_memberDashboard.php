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
	
<article>
	<header>
		<h3>Modifier mes informations</h3>
	</header>
</article>

				
				