<div id="mainContainer" class="container">
	<div class="container">
		<div class="row">
			<article class="col-l-8 col-md-10 mx-auto my-3">
				<time>Date de publication : <?= $comment->getFormatted_comment_date() ?></time></br>   
				<p>Auteur du commentaire : <em><?= htmlspecialchars($comment->getAuthor()) ?></em></p>
			 	<p><strong>Commentaire</strong><br><?= $comment->getComment() ?></p>
			</article>
		</div>
	</div>

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

	<div id="updateComment">
		<div class="row">
			<div class="pt-2 mx-auto my-2">
				<form class="form" method="post" action="index.php?action=modifyComment&id=<?= htmlspecialchars($comment->getId()) ?>&post_id=<?= htmlspecialchars($comment->getPost_id()) ?>">
					<fieldset>
						<legend>Modérer le commentaire</legend>
							<div class="form-group">
								<label for="author">Auteur </label>
								<input type="text" name="author" id="author" class="form-control" value="<?= htmlspecialchars($comment->getAuthor()) ?>" />
							</div>
								
							<div class="form-group">
								<label for="comment">Commentaire </label>
								<textarea name="comment" id="comment" class="form-control tiny"><?= $comment->getComment() ?></textarea>
							</div>

							<input type="hidden" name="id" id="id" value="<?= htmlspecialchars($comment->getId()) ?>"/> <!-- crée la variable $_POST['id'] ds page cible -->
							<input type="hidden" name="post_id" id="post_id" value="<?= htmlspecialchars($comment->getPost_id()) ?>"/> 

							<input type="submit" name="submit" class="btn btn-info mt-1" value="Modifier le commentaire" />
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
