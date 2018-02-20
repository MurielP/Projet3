<header>
 <!-- <?=  '<pre>' . print_r($comments,true) . '</pre>'; ?> -->
	<a href="index.php">Retour à la liste des billets</a>

	<h2><?=  htmlspecialchars($post->getTitle()) ?></h2>
    	<time>Le <?= $post->getFormatted_creation_date()?></time>   

    	<p><?= htmlspecialchars($post->getContent()) ?></p>
    	<hr />
</header>    

    <h2>Commentaires liés à # <?= htmlspecialchars($post->getTitle()) ?></h2>
<?php foreach ($comments as $comment) : ?> 
	<article class="comments">
		<p>Commentaire de : <?= htmlspecialchars ($comment->getAuthor()) ?> <br/>
		Le <?= $comment->getFormatted_comment_date() ?><br/>
		<?= nl2br(htmlspecialchars($comment->getComment())) ?>
		</p>
	</article>
		<hr/> 
<?php endforeach; ?>

	<h3>Laissez-nous votre commentaire</h3>
<?php
	var_dump($_SESSION['errors']);
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
	// création d'un tableau vide pour vider les erreurs
	$_SESSION['errors'] = [];
?>

<div>
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

<form method="post" action="index.php?action=createComment">
	<fieldset>
	<legend>Partagez vos impressions</legend>
	<p><label for="author">Auteur :</label><input type="text" name="author" id="author" value=""/></p>
	<p><label for="comment">Commentaire :</label><textarea name="comment" id="comment" value=""></textarea></p>
	
	<input type="hidden" name="id" id="id" value="<?= htmlspecialchars($post->getId()) ?>"/> 

	<p><input type="submit" name="submitComment" value="Postez votre commentaire" /></p>
	</fieldset>
</form>
</div>


