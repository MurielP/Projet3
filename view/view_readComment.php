<?php
//echo '<pre>' . print_r($comment,true) . '</pre>';
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

<div class="container">
	<div class="row">
		<article class="col-l-8 col-md-10 mx-auto">
			<h3 class="card-title my-2">Commentaire lié à l'article : <?= htmlspecialchars($post->getTitle()) ?></h3>

			<time>Date de publication : <?= htmlspecialchars($comment->getFormatted_comment_date()) ?></time></br>   
			<p>Auteur du commentaire : <em><?= htmlspecialchars($comment->getAuthor()) ?></em></p>
		 	<p><strong>Commentaire</strong><br><?= $comment->getComment()  ?></p>
		</article>
	</div>
</div>
