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

<div class="tableCommentList">
<table>
	<caption>Liste des commentaires</caption>
	<thead> <!-- en-tête du tableau -->
		<tr> <!-- Ligne du tabelau -->
			<th>Id du commentaire</th>
			<th>Id de l'article concerné</th>
			<th>Commentaire</th>
			<th>Auteur</th>
		  	<th>Date de création</th>
		  	<th>Action</th>
		</tr>
	</thead>	  


	<tbody>
<?php foreach ($comments as $comment) :?>
		<tr class="<?php 
			if($comment->getIs_flagged()){ 
				echo 'flagged'; 
				};
			?>">
			<td><?= htmlspecialchars ($comment->getId()) ?></td>
			<td><?= htmlspecialchars ($comment->getPost_id()) ?></td>
			<td><?= htmlspecialchars ($comment->getComment()) ?></td>
			<td><?= htmlspecialchars ($comment->getAuthor()) ?></td>
			<td><?= htmlspecialchars ($comment->getFormatted_comment_date()) ?></td>
			<td>
				<ul>
					<li><a href="index.php?action=readComment&id=<?= htmlspecialchars($comment->getId()) ?>&post_id=<?= htmlspecialchars($comment->getPost_id()) ?>">Lire</li>
					<li><a href="index.php?action=modifyComment&id=<?= htmlspecialchars($comment->getId()) ?>&post_id=<?= htmlspecialchars($comment->getPost_id()) ?>">Modifier</li>
					<li><a href="index.php?action=cancelComment&id=<?= htmlspecialchars($comment->getId()) ?>">Supprimer</li>	
				</ul>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>


</table>
</div>
