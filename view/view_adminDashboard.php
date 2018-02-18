<article>
    <container>
    	<nav class="navbar">
	    	<ul class="navbar-horizontale">
	    		<li ><a href="index.php">Retour à l'accueil</a></li>
	    		<li><a href="index.php?action=logout">Me déconnecter</a></li>
	    		<li><a href="index.php?action=getPostsList">Liste des articles</a></li>
	       </ul>
	   	</nav>
    </container>

		<h2>Mon tableau d'administration</h2>
		<h3>Bonjour <?= htmlspecialchars($_SESSION['userUsername']) ?> !</h3>

		<p>Votre identifiant est : <?= htmlspecialchars($user->getUsername()) ?><br/>
		Date d'inscription : <?= htmlspecialchars($user->getInscription_date())?><br /></p>
</article>

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

	<form class="form" method="post" action="index.php?action=addPost">
		<fieldset>
			<legend>Rédiger un nouvel épisode</legend>
				<p><label for="author">Auteur : </label><input type="text" name="author" id="author" value="" /></p>
				<p><label for="title">Titre de l'épisode : </label><input type="text" name="title" id="title" value="" /></p>
				<p><label for="content">Contenu : </label><textarea name="content" id="content" value=""></textarea></p>

				<p><input type="submit" name="submit" value="Publier l'article" /></p>
		</fieldset>
	</form>
<div class="tablePostList">
<table>
	<caption>Liste des billets</caption>
	<thead> <!-- en-tête du tableau -->
		<tr> <!-- Ligne du tabelau -->
			<th>Titre</th>
			<th>Aperçu du contenu</th>
			<th>Auteur</th>
		  	<th>Date de création</th>
		</tr>
	</thead>	  

<?php foreach ($posts as $post) :?>
	<tbody>
		<tr>
			<td><?= htmlspecialchars ($post->getTitle()) ?></td>
			<td><?= htmlspecialchars ($post->getContent()) ?></td>
			<td><?= htmlspecialchars ($post->getAuthor()) ?></td>
			<td><?= htmlspecialchars ($post->getFormatted_creation_date()) ?></td>
		</tr>
	</tbody>
<?php endforeach; ?>

</table>
</div>