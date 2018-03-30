<div id="mainContainer" class="container">
	<div id="dashboard" class="container">
		<div class="row my-3">
			<div class="col-md-4">
				<h3 class="">Mon tableau d'administration</h3>
			</div>

			<div class="col-md-8">
				<div id="dashboard" class="d-flex align-items-end flex-column">	
					<ul class="list-inline" id="onglets">
						<li class="btn btn-primary btn-lg active list-inline-item" role="button" aria-pressed="true"><a href="index.php?action=adminPosts">Articles</a></li>
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

	<div class="container" id="adminPosts" >
		<div class="row">
			<div class="pt-2 mx-auto my-2">
				<form class="form" method="post" action="index.php?action=createPost">
					<fieldset>
						<legend>Rédiger un nouvel épisode</legend>
							<div class="form-group">
								<label for="author">Auteur </label>
								<input type="text" name="author" id="author" class="form-control" value="" />
							</div>
							
							<div class="form-group">
								<label for="title">Titre de l'épisode </label>
								<input type="text" name="title" id="title" class="form-control" value="" />
							</div>

							<div class="form-group">
								<label for="content">Contenu </label>
								<input name="content" id="content" class="form-control tiny" value="" />
							</div>

							<button type="submit" name="submit"  class="btn btn-info mt-1" value="">Publier l'article</button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div id="table" class="col-md-12">
				<div class="col-md-12 table table-bordered table-condensed table-hover">
					<table class="table table-bordered table-hover">
						<caption class="text-uppercase">Liste des billets</caption>
							<thead class="text-uppercase text-center thead-dark"> <!-- en-tête du tableau -->
								<tr> <!-- Ligne du tabelau -->
									<th class="align-middle resp" scope="col">Titre</th>
									<th class="align-middle resp" scope="col">Contenu</th>
									<th class="align-middle resp" scope="col">Auteur</th>
								  	<th class="align-middle resp" scope="col">Date de création</th>
								  	<th class="align-middle resp" scope="col">Action</th>
								</tr>
							</thead>	  
							<tbody>
							<?php foreach ($posts as $post) :?>
									<tr>
										<td data-title="Titre" class="resp"><?= htmlspecialchars($post->getTitle()) ?></td>
										<td data-title="Contenu" class="resp"><?= $post->getContent() ?></td>
										<td data-title="Auteur" class="resp"><?= htmlspecialchars($post->getAuthor()) ?></td>
										<td data-title="Date de création" class="resp"><?= htmlspecialchars($post->getFormatted_creation_date()) ?></td>
										<td data-title="Action" class="resp">
											<ul id="min">
												<li class="btn btn-primary btn-sm active py-0" role="button" aria-pressed="true"><a href="index.php?action=readPost&post_id=<?= htmlspecialchars($post->getId()) ?>">Lire</a></li>
												<li class="btn btn-primary btn-sm active py-0" role="button" aria-pressed="true"><a href="index.php?action=modifyPost&post_id=<?= htmlspecialchars($post->getId()) ?>">Modifier</a></li>
												<li class="btn btn-primary btn-sm active py-0" role="button" aria-pressed="true"><a href="index.php?action=cancelPost&post_id=<?= htmlspecialchars($post->getId()) ?>">Supprimer</a></li>	
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
</div>