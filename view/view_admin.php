<div id="mainContainer" class="container">	
	<?php
		//var_dump($_SESSION['success']);
		if (isset($_SESSION['success']) AND !empty($_SESSION['success'])) {
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
		if (isset($_SESSION['errors']) AND !empty($_SESSION['errors'])) {
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
							<label for="username">Votre identifiant</label> 
							<input type="text" name="username" id="username" class="form-control" value=""/>
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
