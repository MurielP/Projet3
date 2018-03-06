<container>
    	<nav class="navbar">
	    	<ul class="navbar-horizontale">
	    		<li ><a href="index.php">Retour à l'accueil</a></li>
	    		<li><a href="index.php?action=logout">Me déconnecter</a></li>
	    		<li><a href="index.php?action=adminProfile">Tableau de bord</a></li>
	       </ul>
	   	</nav>
    </container>


<article>
	<h2>Titre de l'article : <?=  htmlspecialchars($post->getTitle()) ?></h2>
	<p>Auteur :  <?=  htmlspecialchars($post->getAuthor()) ?></p>
	<time>Date de création : <?= $post->getFormatted_creation_date()?></time></br>   
	<time>Dernière modification : <?= $post->getFormatted_PAD() ?></time>
	<p>Contenu : <br><?= htmlspecialchars($post->getContent()) ?></p>
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
	<form class="form" method="post" action="index.php?action=modifyPost&id=<?= $post->getId() ?>">
		<fieldset>
			<legend>Modifier un article</legend>
				<p><label for="author">Auteur : </label><input type="text" name="author" id="author" value="<?=  htmlspecialchars($post->getAuthor()) ?>" /></p>
				<p><label for="title">Titre : </label><input type="text" name="title" id="title" value="<?=  htmlspecialchars($post->getTitle()) ?>" /></p>
				<p><label for="content">Contenu : </label><textarea type="text" name="content" id="content" value=""><?= htmlspecialchars($post->getContent()) ?></textarea></p>
				<input type="hidden" name="post_id" id="post_id" value="<?= htmlspecialchars($post->getId()) ?>"/> 
				<p><input type="submit" name="submit" value="Éditer l'article" /></p>
		</fieldset>
	</form>