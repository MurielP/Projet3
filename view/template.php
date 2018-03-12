<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <!-- Cette ligne concerne uniquement les mobiles. On demande que l'affichage occupe tout l'espace disponible avec une taille de 1, autrement dit sans zoom.  -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Muriel Poulain">
        <meta name="description" content="Projet 3 - Blog pour un écrivain">

        <link rel="stylesheet" href="public/css/bootstrap.css" />
        <link rel="stylesheet" href="public/css/style2.css" /> 

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    

        <title><?= $this->title ?></title>
    </head>

    <body>
        <!-- Header -->
    <header class="masthead bg-ltgrey text-white text-center">
      <div class="container">
        <img class="img-fluid mb-5 d-block mx-auto rounded-circle" src="public/img/begins_Simon_Migaj_pexels.jpg" alt="Let's begin image d'accueil" title="Que l'aventure commence !">
        <h1 class="mb-0" id="blogTitle">Billet simple pour l'Alaska</h1>
        <hr>
        <h2 class="font-weight-light mb-0">Blog de Jean Forteroche</h2>
      </div>
    </header>

        <div class="container">

            
                <?= $content ?>
            


            <footer id="footer">
                <p>Jean Forteroche vous livre ses aventures.</p>
            </footer>   

        </div>
        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    
    </body>
</html>