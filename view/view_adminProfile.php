<div id="mainContainer" class="container">
	<div id="dashboard" class="container">
		<div class="row my-3">
			<div class="col-md-4">
				<h2>Bonjour <?= htmlspecialchars($_SESSION['adminUsername']) ?> !</h2>
			</div>
			
			<div class="col-md-8">
				<div id="dashboard" class="d-flex align-items-end flex-column">	
					<ul class="list-inline" id="onglets">
						<li class="btn btn-primary btn-lg active list-inline-item"" role="button" aria-pressed="true"><a href="index.php?action=adminPosts">Articles</a></li>
						<li class="btn btn-primary btn-lg active list-inline-item" role="button" aria-pressed="true"><a href="index.php?action=adminComments">Commentaires</a></li>
					</ul>
				</div>
			</div>	
		</div>
	</div>	

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
	//echo '<pre>' . print_r($user,true) . '</pre>';
		if (isset($_SESSION['errors']) AND !empty($_SESSION['errors'])) {
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
			<div id="table" class="col-md-12">
				<table class="col-md-12 table table-bordered table-condensed table-hover">
					<caption class="text-uppercase">Liste des commentaires</caption>
					<thead class="text-uppercase text-center thead-dark"> <!-- en-tête du tableau -->
						<tr> <!-- Ligne du tableau -->
							<th class="align-middle resp" scope="col">Id du commentaire/<br />Id de l'article</th>
							<th class="align-middle resp" scope="col">Commentaire</th>
							<th class="align-middle resp" scope="col">Auteur</th>
						  	<th class="align-middle resp" scope="col">Date de création</th>
						  	<th class="align-middle resp" scope="col">Action</th>
						</tr>
					</thead>	  
					<tbody>
						<?php foreach ($comments as $comment) :?>
								<tr class="<?php if($comment->getIs_flagged()){ echo 'flagged'; };?>">
									<td data-title="Id commentaire / Id article" class="resp min"><?= htmlspecialchars($comment->getId()) ?> / <?=  htmlspecialchars($comment->getPost_id()) ?></td>
									<td data-title="Commentaire" class="resp"><?= $comment->getComment() ?></td>
									<td data-title="Auteur" class="resp"><?= htmlspecialchars($comment->getAuthor()) ?></td>
									<td data-title="Date de commentaire" class="resp"><?= htmlspecialchars($comment->getFormatted_comment_date()) ?></td>
									<td data-title="Action" class="resp">
										<ul id="min">
											<li class="btn btn-primary btn-sm active py-0" role="button" aria-pressed="true"><a href="index.php?action=readComment&id=<?= htmlspecialchars($comment->getId()) ?>&post_id=<?= htmlspecialchars($comment->getPost_id()) ?>">Lire</a></li>
											<li class="btn btn-primary btn-sm active py-0" role="button" aria-pressed="true"><a href="index.php?action=modifyComment&id=<?= htmlspecialchars($comment->getId()) ?>&post_id=<?= htmlspecialchars($comment->getPost_id()) ?>">Modifier</a></li>
											<li class="btn btn-primary btn-sm active py-0" role="button" aria-pressed="true"><a href="index.php?action=cancelComment&id=<?= htmlspecialchars($comment->getId()) ?>">Supprimer</a></li>	
										</ul>
									</td>
								</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>