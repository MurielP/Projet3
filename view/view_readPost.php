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



<container>
    <nav class="navbar">
	    <ul class="navbar-horizontale">
	    	<li ><a href="index.php">Retour à l'accueil</a></li>
	    	<li><a href="index.php?action=logout">Me déconnecter</a></li>
	    	<li><a href="index.php?action=adminProfile">Tableau de bord</a></li>
	      </ul>
	</nav>
</container>

<article>
	<h2>Titre de l'article : <?=  htmlspecialchars($post->getTitle()) ?></h2>
	<time>Date de création : <?= $post->getFormatted_creation_date()?></time></article></br>   
	<time>Dernière modification : <?= $post->getFormatted_PAD() ?></time>
	<p>Contenu : <br><?= htmlspecialchars($post->getContent()) ?></p>
</article>

<?php
//echo '<pre>' . print_r($user,true) . '</pre>';
	if(isset($_SESSION['errors']) AND !empty($_SESSION['errors'])) {
		foreach ($_SESSION['errors'] as $type => $message) {
?>
	<div class="alert">
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

