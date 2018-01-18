<article>
    <header>
    	<a href="index.php">Retour à l'accueil</a>
       
    </header>

<h2>S'inscrire</h2>

<?php
var_dump($_SESSION);
	if(isset($_SESSION['errors']) AND $_SESSION['errors'] != '') {
		foreach ($_SESSION['errors'] as $key => $value) {
?>
	<div class="alert">
		<p><?= $value ?></p>
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
		<p><label for="username">Pseudo</label> : <input type="text" name="username" id="username" value=""/></p>
		<p><label for="email">Email</label> : <input type="email" name="email" id="email" value=""></p>
		<p><label for="password">Mot de passe</label> : <input type="password" name="password" id="password" value=""></p>
		<p><label for="confirmPassword">Confirmer mon mot de passe</label> : <input type="password" name="confirmPassword" id="confirmPassword" value=""></p>

		<p><button type="submit" value="" />Créer mon compte</button>

	</fieldset>
</form>

