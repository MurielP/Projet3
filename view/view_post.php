<?php
	//var_dump($_SESSION['errors']);
	if(isset($_SESSION['errors']) AND !empty($_SESSION['errors'])) {
		foreach ($_SESSION['errors'] as $type => $message) {
?>
	<div class="btn btn-warning btn-block mt-3">
		<p>Une erreur s'est produite dans le formulaire : </p>
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
	//var_dump($_SESSION['success']);
	if(isset($_SESSION['success']) AND !empty($_SESSION['success'])) {
		foreach ($_SESSION['success'] as $type => $message) {
?>
	<div class="btn btn-success btn-block mt-3">
		<ul>
			<li><?= $message ?></li>
		</ul>
	</div>
<?php
}
}	
	$_SESSION['success'] = [];
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

<div id="commentsPostPage" class="card w-75 mx-auto mb-3">
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


	<div class="row">
		<div class="col-lg-8 pt-2 mx-auto my-2">
			<form method="post" action="index.php?action=createComment">
				<fieldset>
					<legend>Partagez vos impressions</legend>
						<div class="control-group">
							<div class="form-group floating-label-form-group mb-0 pb-2">
								<label for="author">Auteur</label>
								<input type="text" name="author" id="author" class="form-control w-75" value="" placeholder="Pseudonyme"/>
							</div>
						</div>
						<div class="control-group">
							<div class="form-group floating-label-form-group mb-0 pb-2">
								<label for="comment">Commentaire</label>
								<textarea name="comment" id="comment" class="form-control w-75" value="" placeholder="Message"></textarea>
							</div>
						</div>
					<input type="hidden" name="post_id" id="post_id" value="<?= htmlspecialchars($post->getId()) ?>"/> 
				
					<input type="submit" name="submitComment" class="btn btn-info" value="Postez votre commentaire" />
				</fieldset>
			</form>
		</div>
	</div>
</div>






