<?php
/**
	var_dump($_SESSION['errors']);
	if(isset($_SESSION['errors']) AND !empty($_SESSION['errors'])) {
		foreach ($_SESSION['errors'] as $type => $message) {
?>
	<div class="alert">
		<p>Une erreur s'est produite dans le formulaire.</p>
		<ul>
			<li><?= $message ?></li>
		</ul>
	</div>

<?php
		}
	}	
	// création d'un tableau vide pour vider les erreurs
	$_SESSION['errors'] = [];
**/
?>

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
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=logAdmin">Espace administrateur</a>
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


<div class="containe">
	<p class="mb-0 px-4 py-3 bg-secondary text-white">Nombre d'épisodes publiés : <?= htmlspecialchars($posts_nb) ?></p>			
<?php foreach ($posts as $post) : ?> 
	<div class="card">
		<div class="card-header">
			<a href="index.php?action=post&post_id=<?= htmlspecialchars($post->getId()) ?>">
				<h3 class="card-title"><?= htmlspecialchars($post->getTitle()) ?></h3>
			</a>
			<p class="card-text"><small class="text-muted">Nombre de commentaires pour cet article : <?= htmlspecialchars($nb_comments) ?></small></p>
			<p class="card-text">Posté le <time><?= htmlspecialchars($post->getFormatted_creation_date()) ?></time> par <?= htmlspecialchars($post->getAuthor()) ?>
			</p>
		</div>
		<div class="card-body">			
			<p class="card-text"><?=  htmlspecialchars($post->getContent()) ?></p>
		</div>
	</div>
<?php endforeach; ?>

</div>
