<div id="mainContainer" class="container">
	<div class="container">
		<div class="row">
			<article class="col-l-8 col-md-10 mx-auto my-3">
				<h2 class="card-title">Titre de l'article : <?= htmlspecialchars($post->getTitle()) ?></h2>
				<p>Auteur :  <em><?=  htmlspecialchars($post->getAuthor()) ?></em></p>

				<p><time>Date de création : <?= htmlspecialchars($post->getFormatted_creation_date()) ?></time><p>   
				<p><strong>Contenu de l'article : </strong><br><?= $post->getContent() ?></p>
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

	<div id="updatePost">
		<div class="row">
			<div class="pt-2 mx-auto my-2">
				<form class="form" method="post" action="index.php?action=modifyPost&post_id=<?= htmlspecialchars($post->getId()) ?>">
					<fieldset>
						<legend>Modifier un article</legend>
							<div class="form-group">
								<label for="author">Auteur </label>
								<input type="text" name="author" id="author" class="form-control" value="<?= htmlspecialchars($post->getAuthor()) ?>" />
							</div>

							<div class="form-group">
								<label for="title">Titre </label>
								<input type="text" name="title" id="title" class="form-control" value="<?=  htmlspecialchars($post->getTitle()) ?>" />
							</div>

							<div class="form-group">
								<label for="content">Contenu </label>
								<textarea name="content" id="content" class="form-control tiny"><?=  $post->getContent()?></textarea> 
							</div>

							<input type="hidden" name="post_id" id="post_id" value="<?= htmlspecialchars($post->getId()) ?>"/> 
								
							<input type="submit" name="submit" class="btn btn-info mt-1" value="Éditer l'article" />
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>