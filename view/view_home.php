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
 
 <div id="mainContainer" class="container">

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
	//var_dump($_SESSION['errors']);

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


	<article id="homePageContainer" class="container pt-sm-2 pt-md-1 pt-lg-0">		
	<?php foreach ($posts as $post) : ?> 
		<div class="card-deck">
			<div class="card my-2 md-mt-1">
				<div class="card-header">
					<a class="card-title" href="index.php?action=post&post_id=<?= $post->getId() ?>">
						<h3 class="card-title"><?= htmlspecialchars($post->getTitle()) ?></h3>
					</a>
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
