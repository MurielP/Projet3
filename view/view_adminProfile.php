<nav class="navbar navbar-expand-lg bg-secondary fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php">
        	<img src="public/img/begins_Simon_Migaj_pexels.jpg" width="30" class="rounded" height="30" alt="Let's begin image d'accueil" title="Que l'aventure commence !"> Accueil</a>

			<button class="navbar-toggler navbar-toggler-right text-uppercase bg-secondary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu
				<i class="fa fa-bars"></i>
        	</button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
            	<li class="nav-item mx-0 mx-lg-1">
              		<a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=logoutAdmin">Me déconnecter</a>

            </ul>
        </div>
    </div>
</nav>
		

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

<?php
//echo '<pre>' . print_r($user,true) . '</pre>';
	if(isset($_SESSION['errors']) AND !empty($_SESSION['errors'])) {
		foreach ($_SESSION['errors'] as $type => $message) {
?>
	<div class="btn btn-warning btn-block mt-3">
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

<div class="container">
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



<div class="container">
	<div class="row">
		<div class="table-responsive-lg-12 table-responsive-md-6 table-responsive-sm-4">
			<table class="table table-bordered table-hover">
				<caption class="text-uppercase">Liste des commentaires</caption>
				<thead class="text-uppercase text-center"> <!-- en-tête du tableau -->
					<tr> <!-- Ligne du tabelau -->
						<th scope="col">Id du commentaire</th>
						<th scope="col">Id de l'article concerné</th>
						<th scope="col">Commentaire</th>
						<th scope="col">Auteur</th>
					  	<th scope="col">Date de création</th>
					  	<th scope="col">Action</th>
					</tr>
				</thead>	  
				<tbody>
					<?php foreach ($comments as $comment) :?>
							<tr class="<?php if($comment->getIs_flagged()){ echo 'flagged'; };?>">
								<td><?= htmlspecialchars ($comment->getId()) ?></td>
								<td><?= htmlspecialchars ($comment->getPost_id()) ?></td>
								<td><?= htmlspecialchars ($comment->getComment()) ?></td>
								<td><?= htmlspecialchars ($comment->getAuthor()) ?></td>
								<td><?= htmlspecialchars ($comment->getFormatted_comment_date()) ?></td>
								<td>
									<ul>
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