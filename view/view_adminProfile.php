<container>
    <nav class="navbar">
	    <ul class="navbar-horizontale">
	    	<li ><a href="index.php">Retour à l'accueil</a></li>
	    	<li><a href="index.php?action=logoutAdmin">Me déconnecter</a></li>
	    </ul>
	</nav>
</container>

		<h2>Bonjour <?= htmlspecialchars($_SESSION['adminUsername']) ?> !</h2>

<?php
//var_dump($_SESSION['success']);
	if(isset($_SESSION['success']) AND !empty($_SESSION['success'])) {
		foreach ($_SESSION['success'] as $type => $message) {
?>
	<div class="successAlert">
		<ul>
			<li><?= $message ?></li>
		</ul>
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

<div id="infoAdmin">
	<h3>Mes infos</h3>
		<p>Pseudonyme : <?= $adminReq->getUsername() ?></p>	
</div>

<div id="dashboard">
	<ul id="onglets">
		<li class="active"><a href="index.php?action=adminPosts">Articles</a></li>
		<li class="active"><a href="index.php?action=adminComments">Commentaires</a></li>
		<li class="active"><a href="">Membres</a></li>
	</ul>
</div>

