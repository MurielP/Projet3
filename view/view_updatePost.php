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
	<div class="container">
		<div class="row">
			<article class="col-l-8 col-md-10 mx-auto my-3">
				<h2>Titre de l'article : <?= $post->getTitle() ?></h2>
				<p>Auteur :  <?=  $post->getAuthor() ?></p>

				<time>Date de création : <?= $post->getFormatted_creation_date()?></time></br>   
				<p>Contenu de l'article : <br><?= $post->getContent() ?></p>
			</article>
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

	<div id="updatePost">
		<div class="row">
			<div class="pt-2 mx-auto my-2">
				<form class="form" method="post" action="index.php?action=modifyPost&post_id=<?= $post->getId() ?>">
					<fieldset>
						<legend>Modifier un article</legend>
							<div class="form-group">
								<label for="author">Auteur </label>
								<input type="text" name="author" id="author" class="form-control" value="<?= $post->getAuthor() ?>" />
							</div>

							<div class="form-group">
								<label for="title">Titre </label>
								<input type="text" name="title" id="title" class="form-control" value="<?=  $post->getTitle() ?>" />
							</div>

							<div class="form-group">
								<label for="content">Contenu </label>
								<textarea type="text" name="content" id="content" class="form-control tiny" value=""><?= $post->getContent() ?></textarea>
							</div>

							<input type="hidden" name="post_id" id="post_id" value="<?= htmlspecialchars($post->getId()) ?>"/> 
								
							<input type="submit" name="submit" class="btn btn-info mt-1" value="Éditer l'article" />
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>