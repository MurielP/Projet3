<div id="mainContainer" class="container">
	<?php
		//var_dump($_SESSION['success']);
		if (isset($_SESSION['success']) AND !empty($_SESSION['success'])) {
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
		//var_dump($_SESSION['errors']);
		if (isset($_SESSION['errors']) AND !empty($_SESSION['errors'])) {
			foreach ($_SESSION['errors'] as $type => $message) {
	?>
		<div class="container mt-xs-4">
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

	<article id="homePageContainer" class="container pt-sm-2 pt-md-1 pt-lg-0">	
		<!-- boucle qui parcourt l'objet post pour afficher les propriétés et valeurs (public) -->	
		<?php foreach ($posts as $post) : ?> 
			<div class="card-deck">
				<div class="card my-2 md-mt-1">
					<div class="card-header">
						<a class="card-title" href="index.php?action=post&post_id=<?= $post->getId() ?>"><h3 class="card-title"><?= htmlspecialchars($post->getTitle()) ?></h3></a>
						<p class="card-text">Posté le <?= htmlspecialchars($post->getFormatted_creation_date()) ?> par <?= htmlspecialchars($post->getAuthor()) ?>
						</p>
					</div>
					<div class="card-body h-5">			
						<p class="card-text text-justify"><?= $post->getContent() ?></p>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</article> 
</div>
