<?php
var_dump($_SESSION['user']);
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
	// création d'un tableau vide pour afficher les erreurs 
	$_SESSION['errors'] = [];
?>
<article>
    <header>
    	<a href="index.php">Retour à l'accueil</a>
       
    </header>
		<h2>Mon tableau d'administration</h2>
		<h3>Bonjour <?= htmlspecialchars($user->getUsername()) ?> !</h3>

		<p>Votre identifiant est : <?= htmlspecialchars($user->getUsername()) ?><br/>
		
		Date d'inscription : <?= htmlspecialchars($user->getInscription_date())?><br />
		</p>


</article>
	
