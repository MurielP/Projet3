<?php
/**
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
**/
?>

<nav class="navbar navbar-expand-lg bg-secondary fixed-top" id="mainNav">
    <div class="container">
    	<a class="navbar-brand js-scroll-trigger" href="index.php">
        <img src="public/img/begins_Simon_Migaj_pexels.jpg" class="rounded" width="30px"  height="30px" alt="Let's begin image d'accueil" title="Que l'aventure commence !"> Accueil</a>
    </div>
</nav>

<article id="postAndComments" class="container pt-sm-2 pt-md-1 pt-lg-0">
	<div class="card-deck">
		<div class="card my-3">
			<div class="card-header">
				<h3 class="card-title"><?=  htmlspecialchars($post->getTitle()) ?></h3>
    			<p class="card-text"><time>Le <?= $post->getFormatted_creation_date()?></time>par <?= htmlspecialchars($post->getAuthor()) ?></p>   
				
				<div class="card-body h-5">		
		    		<p class="card-text"><?= htmlspecialchars($post->getContent()) ?></p>
		    	</div>
		    </div>
		</div>
	</div>
</article>    

<div id="commentsPostPage" class="card w-75 my-4 mx-auto">
	<div class="card-header">
	    <h4 class="card-title">Commentaires liés à # <?= htmlspecialchars($post->getTitle()) ?></h4>
	    <small>Nombres de commentaires : <?= htmlspecialchars($comments_nb) ?></small>
	</div>
<?php foreach ($comments as $comment) : ?> 
		<div class="card-body">
			<p>Commentaire de : <?= htmlspecialchars ($comment->getAuthor()) ?> <br/>
			Le <?= $comment->getFormatted_comment_date() ?><br/>
			<?= nl2br(htmlspecialchars($comment->getComment())) ?>
			</p>
			<a href="index.php?action=flag&idComment=<?= $comment->getId()?>" class="btn btn-info btn-sm"><small>Signaler</small></a>
			<hr>
		</div>
<?php endforeach; ?>

	<form method="post" action="index.php?action=createComment">
				
		<fieldset>
		<legend>Partagez vos impressions</legend>
		<p><label for="author">Auteur :</label><input type="text" name="author" id="author" value=""/></p>
		<p><label for="comment">Commentaire :</label><textarea name="comment" id="comment" value=""></textarea></p>
		
		<input type="hidden" name="post_id" id="post_id" value="<?= htmlspecialchars($post->getId()) ?>"/> 
		
		<p><input type="submit" name="submitComment" value="Postez votre commentaire" /></p>
		</fieldset>
	</form>
</div>






