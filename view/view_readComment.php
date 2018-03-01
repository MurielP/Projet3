<container>
    	<nav class="navbar">
	    	<ul class="navbar-horizontale">
	    		<li ><a href="index.php">Retour à l'accueil</a></li>
	    		<li><a href="index.php?action=logoutAdmin">Me déconnecter</a></li>
	    		<li><a href="index.php?action=adminProfile">Tableau de bord</a></li>
	       </ul>
	   	</nav>
</container>

<article>
	<h2>Commentaire lié à l'article : <?= $post->getTitle()?></h2>

	<time>Date de création : <?= $comment->getFormatted_comment_date() ?></time></br>   
	<p>Auteur du commentaire : <?= htmlspecialchars($comment->getAuthor()) ?></p>
 	<p>Commentaire : <br><?= htmlspecialchars($comment->getComment()) ?></p>
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

<?=  '<pre>' . print_r($comment,true) . '</pre>'; ?>
