<container>
    	<nav class="navbar">
	    	<ul class="navbar-horizontale">
	    		<li ><a href="index.php">Retour à l'accueil</a></li>
	    		<li><a href="index.php?action=logout">Me déconnecter</a></li>
	       </ul>
	   	</nav>
    </container>
		<h2>Bonjour <?= htmlspecialchars($_SESSION['adminUsername']) ?> !</h2>

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
<div id="dashboard">
	<ul id="onglets">
		<li class="active"><a href="index.php?action=adminDashboard">Articles</a></li>
		<li class="active"><a href="">Commentaires</a></li>
		<li class="active"><a href="">Membres</a></li>
	</ul>
</div>
