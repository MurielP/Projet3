<nav class="navbar navbar-expand-lg bg-secondary fixed-top navbar-shrink" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php"><img src="public/img/begins_Simon_Migaj_pexels.jpg" class="rounded" width="30px"  height="30px" alt="Let's begin image d'accueil" title="Que l'aventure commence !"> Jean Forteroche</a>

        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
          	<li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=logoutAdmin">Me déconnecter</a>
            </li>    
            		
    		 <!--
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded " href="index.php?action=registerUser">Devenir membre</a>
            </li>
            	<li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded " href="#index.php?action=logUser">Espace membre</a>
            </li>
     		-->
            </ul>
        </div>
    </div>
</nav>

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
<h2>Bonjour <?= htmlspecialchars($_SESSION['adminUsername']) ?> !</h2>

<div class="container-fluid">
	<div class="row">
		<div id="sidebar" class="col-md-2 d-none d-md-block bg-light sidebar">
			<div class="sidebar-sticky">
				<ul nav="flex-column">
					<li class="nav-item">
						<a href=index.php?action=adminPosts class="nav-link active">Articles</a>
					</li>
				</ul>
			</div>
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