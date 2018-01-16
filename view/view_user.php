<article>
    <header>
    	<a href="index.php">Retour à l'accueil</a>
       
    </header>

<h2>S'inscrire</h2>

<?php
if (isset($_SESSION['usernameError']) AND $_SESSION['usernameError'] != '') {
?>
	<div class="alert">
		<p><?= $_SESSION['usernameError']?></p>
	</div>
<?php
	unset($_SESSION['usernameError']);
}
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

