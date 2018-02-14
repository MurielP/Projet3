<?php
//echo '<pre>' . print_r($user,true) . '</pre>';
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
	// création d'un tableau vide pour vider les erreurs
	$_SESSION['errors'] = [];
?>
<article>
    <header>
    	<ul>
    		<li><a href="index.php">Retour à l'accueil</a></li>
    		<li><a href="index.php?action=logout">Me déconnecter</a></li>
    		<li><a href="index.php?action=getPostsList">Liste des articles</a></li>
       </ul>
    </header>

		<h2>Mon tableau d'administration</h2>
		<h3>Bonjour <?= htmlspecialchars($_SESSION['userUsername']) ?> !</h3>

		<p>Votre identifiant est : <?= htmlspecialchars($user->getUsername()) ?><br/>
		Date d'inscription : <?= htmlspecialchars($user->getInscription_date())?><br /></p>
</article>

	<form method="post" action="index.php?action=addPost">
		<fieldset>
			<legend>Rédiger un nouvel épisode</legend>
				<p><label for="author">Auteur : </label><input type="text" name="author" id="author" value="" /></p>
				<p><label for="title">Titre de l'épisode : </label><input type="text" name="title" id="title" value="" /></p>
				<p><label for="content">Contenu : </label><textarea name="content" id="content" value=""></textarea></p>

				<p><input type="submit" name="submit" value="Publier l'article" /></p>
		</fieldset>
	</form>

<?php foreach ($lists as $list) :?>
	<table>
	  <caption>Liste des billets</caption>
		  <tr>
		  	 <th>Date de création</th>
			 <th>Titre</th>
			 <th>Aperçu du contenu</th>
			 <th>Auteur<?= htmlspecialchars ($list->getAuthor()) ?></th>
		  </tr>
	</table>
<?php endforeach; ?>