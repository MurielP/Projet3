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
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php">Accueil</a>
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

	<div id="loginAdminPage" class="container pt-sm-0">
		<div class="row">
			<div class="pt-2 mx-auto my-2">
				<form method="post" action="index.php?action=logAdmin">
					<div class="my-3">
						<h3 class="mb-4">Accès espace administrateur</h3>
						<div class="mb-2 form-label-group">
							<label for="login">Votre identifiant</label> 
							<input type="text" name="username" id="username" class="form-control" value="" placeholder=""/>
						</div>
						<div class="mb-2 form-label-group">
							<label for="password">Votre mot de passe</label> 
							<input type="password" name="password" id="password" class="form-control" value="" >
						</div>
						<input type="submit" class="btn btn-info mt-1" value="Se connecter" />
					</div>
				</form>
			</div>
		</div>	
	</div>
</div>
