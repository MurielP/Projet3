	 <header>
    	<a href="index.php">Retour à la liste des billets</a>
        <h1><?=  htmlspecialchars($post->getTitle()) ?></h1>
         <time>Le <?= htmlspecialchars($post->getCreation_date()) ?></time>
       
    </header>
    <p><?= htmlspecialchars($post->getContent()) ?></p>
</article>
<hr />
<header>
    <h1>Commentaires liés à # <?= htmlspecialchars($post->getTitle()) ?></h1>
</header>

<?php foreach ($comments as $comment) : ?> 
	<article>
		<p>Commentaire de : <?= htmlspecialchars ($comment->getAuthor()) ?> <br/>
		Le <?= $comment->getFormatted_comment_date() ?><br/>
		<?= nl2br(htmlspecialchars($comment->getComment())) ?>
		</p>
	</article>
		<hr/> 
<?php endforeach; ?>


<h2>Laissez-nous votre commentaire</h2>

<?php
if (isset($_SESSION['errorAuthor']) AND $_SESSION['errorAuthor'] != '' ) {
	?>
	<div class="alert">
		<p><?= $_SESSION['errorAuthor']?></p>
	</div>
	<?php
	unset($_SESSION['errorAuthor']);
}

?>

<form method="post" action="index.php?action=toComment">
	<fieldset>
	<legend>Partagez vos impressions</legend>
	<p><label for="author">Auteur</label> : <input type="text" name="author" id="author" value=""/></p>
	<p><label for="comment">Commentaire</label> : <textarea name="comment" id="comment" value=""></textarea></p>
			
	<input type="hidden" name="id" id="id" value="<?php echo $post->getId();?>"/> 

	<p><input type="submit" value="Postez votre commentaire" /></p>
	</fieldset>
</form>
