<article>
    <header>
    	<a href="index.php">Retour à l'accueil</a>
       
    </header>
    
<?php
var_dump($_SESSION);

	if(isset($_SESSION['errors']) AND !empty($_SESSION['errors'])) {
		foreach ($_SESSION['errors'] as $type => $message) {
?>
	<div class="alert">
		<p>Une erreur s'est produite dans le formulaire.</p>
		<ul>
			<li><?= $message ?></li>
		</ul>
	</div>
<?php
}
}	
	// création d'un tableau vide pour afficher les erreurs 
	$_SESSION['errors'] = [];
?>

<form method="post" action="index.php?action=admin">
	<fieldset>
		<legend>Accès espace administraeur</legend>

		<p><label for="username">Votre identifiant</label> : 
			<input type="text" name="username" id="username" value="" required/>
		</p>

		<p><label for="password">Votre mot de passe</label> : 
			<input type="password" name="password" id="password" value="" required>
		</p>

		<p><button type="submit" value="" />Se connecter</button></p>

	</fieldset>
</form>

</article>
