<?php
	//var_dump($_SESSION['success']);
	if(isset($_SESSION['success']) AND !empty($_SESSION['success'])) {
		foreach ($_SESSION['success'] as $type => $message) {
?>
	<div class="container mt-xs-4">
		<div id="errors" class="overflow-visible">
			<ul class="list-group mt-2 mt-sm-6">
				<li class="list-group-item list-group-item-success"><?= $message ?></li>
			</ul>
		</div>
	</div>
<?php
		}
	}	
	$_SESSION['success'] = [];
?>

<?php
	//echo '<pre>' . print_r($user,true) . '</pre>';
	if(isset($_SESSION['errors']) AND !empty($_SESSION['errors'])) {
		foreach ($_SESSION['errors'] as $type => $message) {
?>
	<div class="msg container mt-xs-4">
		<div id="errors" class="overflow-visible">
			<ul class="list-group mt-2 mt-sm-6">
				<li class="list-group-item list-group-item-warning">Une erreur s'est produite dans le formulaire :</br><?= $message ?></li>
			</ul>
		</div>
	</div>
<?php
		}
	}	
	// création d'un tableau vide pour vider les erreurs
	$_SESSION['errors'] = [];
?>

<article id="postAndComments" class="container pt-sm-2 pt-md-1 pt-lg-0">
	<div class="card-deck">
		<div class="card my-3">
			<div class="card-header">
				<a class="card-title" href="index.php?"><h3 class="card-title"><?=  $post->getTitle() ?></h3></a>
    			<p class="card-text">Le <time><?= $post->getFormatted_creation_date()?></time><br/>par <em><?= $post->getAuthor() ?></em></p>   
				<div class="card-body h-5">		
		    		<p class="card-text text-justify"><?= $post->getContent() ?></p>
		    	</div>
		    </div>
		</div>
	</div>
</article>    

<div id="commentsPostPage" class="card w-75 mx-auto mb-3">
	<div class="card-header">
	    <h4 class="card-title">Commentaires liés à # <?= htmlspecialchars($post->getTitle()) ?></h4>
	    <p><span class="badge badge-pill badge-secondary"><?= htmlspecialchars($comments_nb) ?></span> commentaires :</p>
	</div>

	<?php foreach ($comments as $comment) : ?> 
		<div class="card-body">
			<div class="card-title">
				<p>Commentaire de <em><?= htmlspecialchars ($comment->getAuthor()) ?></em><br/>
				Le <time> <?= $comment->getFormatted_comment_date() ?></time><br/></p>
			</div>
			<div class="content">
				<p><?= nl2br(($comment->getComment())) ?></p>
			</div>
			<a href="index.php?action=flag&idComment=<?= htmlspecialchars($comment->getId())?>" class="btn btn-info btn-sm"><small>Signaler</small></a>
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






