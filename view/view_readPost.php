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
  
          		<li class="nav-item mx-0 mx-lg-1">
             		<a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=adminProfile">Tableau de bord</a>
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

	<article class="container pt-sm-2 pt-md-1 pt-lg-0">
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
</div>

