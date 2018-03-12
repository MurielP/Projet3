<article>
    <container>
    	<nav class="navbar">
	    	<ul class="navbar-horizontale">
	    		<li ><a href="index.php">Retour à l'accueil</a></li>
	    		<li><a href="index.php?action=logoutAdmin">Me déconnecter</a></li>
	    		<li><a href="index.php?action=adminProfile">Mes infos</a></li>
	       </ul>
	   	</nav>
    </container>
		<h2>Mon tableau d'administration</h2>
		<h3 class="welcomeAdmin">Bonjour <?= htmlspecialchars($_SESSION['adminUsername']) ?> !</h3>
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

	<form class="form" method="post" action="index.php?action=createPost">
		<fieldset>
			<legend>Rédiger un nouvel épisode</legend>
				<p><label for="author">Auteur : </label><input type="text" name="author" id="author" value="" /></p>
				<p><label for="title">Titre de l'épisode : </label><input type="text" name="title" id="title" value="" /></p>
				<p><label for="content">Contenu : </label><textarea name="content" id="content" value=""></textarea></p>

				<p><input type="submit" name="submit" value="Publier l'article" /></p>
		</fieldset>
	</form>
	
<?php
	var_dump($_SESSION['success']);
	if(isset($_SESSION['success']) AND !empty($_SESSION['success'])) {
		foreach ($_SESSION['success'] as $type => $message) {
?>
	<div class="successAlert">
		<ul>
			<li><?= $message ?></li>
		</ul>
	</div>
<?php
}
}	
	$_SESSION['success'] = [];
?>

<div class="tablePostList">
<table>
	<caption>Liste des billets</caption>
	<thead> <!-- en-tête du tableau -->
		<tr> <!-- Ligne du tabelau -->
			<th>Titre</th>
			<th>Aperçu du contenu</th>
			<th>Auteur</th>
		  	<th>Date de création</th>
		  	<th>Date de modification</th>
		  	<th>Action</th>
		</tr>
	</thead>	  

<?php foreach ($posts as $post) :?>
	<tbody>
		<tr>
			<td><?= htmlspecialchars ($post->getTitle()) ?></td>
			<td><?= htmlspecialchars ($post->getContent()) ?></td>
			<td><?= htmlspecialchars ($post->getAuthor()) ?></td>
			<td><?= htmlspecialchars ($post->getFormatted_creation_date()) ?></td>
			<td><?= htmlspecialchars ($post->getFormatted_PAD()) ?></td>
			<td>
				<ul>
					<li><button><a href="index.php?action=readPost&post_id=<?= htmlspecialchars($post->getId()) ?>">Lire</a></button></li>
					<li><button><a href="index.php?action=modifyPost&post_id=<?= htmlspecialchars($post->getId()) ?>">Modifier</a></button></li>
					<li><button><a href="index.php?action=cancelPost&post_id=<?= htmlspecialchars($post->getId()) ?>">Supprime</a></button></li>	
				</ul>
			</td>
		</tr>
	</tbody>
<?php endforeach; ?>

</table>
</div>