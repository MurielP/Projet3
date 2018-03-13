<nav class="navbar navbar-expand-lg bg-secondary fixed-top" id="mainNav">
    <div class="container">
    	<a class="navbar-brand js-scroll-trigger" href="index.php">
        <img src="public/img/begins_Simon_Migaj_pexels.jpg" class="rounded" width="30px"  height="30px" alt="Let's begin image d'accueil" title="Que l'aventure commence !"> Accueil</a>
    </div>
</nav>

<?php
//var_dump($_SESSION['errors']);

	if(isset($_SESSION['errors']) AND !empty($_SESSION['errors'])) {
		foreach ($_SESSION['errors'] as $type => $message) {
?>
	<div class="btn btn-warning btn-block mt-3">
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
?>

<div id="loginAdminPage">
	<div class="row">
		<div class="pt-2 mx-auto my-2">
			<form method="post" action="index.php?action=logAdmin">
				<div class="text-center my-3">
					<h3 class="mb-5">Accès espace administrateur</h3>
					<div class="form-label-group">
						<label for="login">Votre identifiant</label> 
						<input type="text" name="username" id="username" class="form-control" value="" placeholder=""/>
					</div>
					<div class="form-label-group">
						<label for="password">Votre mot de passe</label> 
						<input type="password" name="password" id="password" class="form-control" value="" >
					</div>
					<input type="submit" class="btn btn-info mt-1" value="Se connecter" />
				</div>
			</form>
		</div>
	</div>	
</div>


