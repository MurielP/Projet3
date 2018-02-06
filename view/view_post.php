	 <header>
    	<a href="index.php">Retour à la liste des billets</a>
        <h2><?=  htmlspecialchars($post->getTitle()) ?></h2>
         <time>Le <?= htmlspecialchars($post->getCreation_date()) ?></time>   
    </header>

    <p><?= htmlspecialchars($post->getContent()) ?></p>
  
</article>
<hr />

    <h2>Commentaires liés à # <?= htmlspecialchars($post->getTitle()) ?></h2>


<?php foreach ($comments as $comment) : ?> 
	<article>
		<p>Commentaire de : <?= htmlspecialchars ($comment->getAuthor()) ?> <br/>
		Le <?= $comment->getFormatted_comment_date() ?><br/>
		<?= nl2br(htmlspecialchars($comment->getComment())) ?>
		</p>
	</article>
		<hr/> 
<?php endforeach; ?>


<h3>Laissez-nous votre commentaire</h3>


<?php
	//var_dump($_SESSION['errors']);
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


<form method="post" action="index.php?action=toComment">
	<fieldset>
	<legend>Partagez vos impressions</legend>
	<p><label for="author">Auteur</label> : <input type="text" name="author" id="author" value=""/></p>
	<p><label for="comment">Commentaire</label> : <textarea name="comment" id="comment" value=""></textarea></p>
			
	<input type="hidden" name="id" id="id" value="<?= htmlspecialchars($post->getId()) ?>"/> 

	<p><input type="submit" value="Postez votre commentaire" /></p>
	</fieldset>
</form>
