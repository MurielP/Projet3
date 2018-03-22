<nav class="navbar navbar-expand-lg bg-secondary fixed-top navbar-shrink" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php"><img src="public/img/begins_Simon_Migaj_pexels.jpg" class="rounded" width="30"  height="30" alt="Let's begin image d'accueil" title="Que l'aventure commence !"> Jean Forteroche</a>

        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
          	<li class="nav-item mx-0 mx-lg-1">
              	<a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=adminProfile">Tableau de bord</a>
              </li>

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


	<div id="adminPosts" >
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
			<div class="table-responsive-lg-12 table-responsive-md-6 table-responsive-sm-4">
				<table class="table table-bordered table-hover">
					<caption class="text-uppercase">Liste des billets</caption>
						<thead class="text-uppercase text-center thead-dark"> <!-- en-tête du tableau -->
							<tr> <!-- Ligne du tabelau -->
								<th class="align-middle" scope="col">Titre</th>
								<th class="align-middle" scope="col">Aperçu du contenu</th>
								<th class="align-middle" scope="col">Auteur</th>
							  	<th class="align-middle" scope="col">Date de création</th>
							  	<th class="align-middle" scope="col">Action</th>
							</tr>
						</thead>	  
						<tbody>
							<?php foreach ($posts as $post) :?>
									<tr>
										<td><?= htmlspecialchars($post->getTitle()) ?></td>
										<td><?= $post->getContent() ?></td>
										<td><?= htmlspecialchars($post->getAuthor()) ?></td>
										<td><?= htmlspecialchars($post->getFormatted_creation_date()) ?></td>
										<td>
											<ul>
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