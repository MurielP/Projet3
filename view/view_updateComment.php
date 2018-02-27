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
	<p>Auteur :  <?=  htmlspecialchars($comment->getAuthor()) ?></p>
	<time>Date de création : <?= $comment->getFormatted_comment_date()?></time></br>   
	<p>Contenu : <br><?= htmlspecialchars($comment->getComment()) ?></p>
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
	<form class="form" method="post" action="index.php?action=modifyComment&id=<?= htmlspecialchars($comment->getId()) ?>&post_id=<?= htmlspecialchars($comment->getPost_id()) ?>">
		<fieldset>
			<legend>Modifier un commentaire</legend>
				<p><label for="author">Auteur : </label><input type="text" name="author" id="author" value="" /></p>
				<p><label for="comment">Commentaire : </label><textarea type="text" name="comment" id="comment" value=""></textarea></p>
				<input type="hidden" name="id" id="id" value="<?= htmlspecialchars($comment->getId()) ?>"/> 
				<input type="hidden" name="post_id" id="post_id" value="<?= htmlspecialchars($comment->getPost_id()) ?>"/> 
				<p><input type="submit" name="submit" value="Éditer l'article" /></p>
		</fieldset>
	</form>