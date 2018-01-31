<article>
    <header>
    	<a href="index.php">Retour à l'accueil</a>
       
    </header>

<h2>Créer mon compte</h2>

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


<form method="post" action="index.php?action=registerUser">
	<fieldset>
		<legend>Créer mon compte</legend>

		<p><label for="username">Votre pseudo</label> : 
			<input type="text" name="username" id="username" value="" required/>
		</p>

		<p><label for="email">Votre Email</label> : 
			<input type="email" name="email" id="email" value="" required>
		</p>

		<p><label for="password">Votre mot de passe</label> : 
			<input type="password" name="password" id="password" value="" required>
		</p>

		<p><label for="confirm_password">Confirmer votre mot de passe</label> : 
			<input type="password" name="confirm_password" id="confirm_password" value="" required>
		</p>

		<p><button type="submit" value="" />Je veux devenir membre !</button></p>

	</fieldset>
</form>

