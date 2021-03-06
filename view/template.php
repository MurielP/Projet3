<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <!-- Cette ligne concerne uniquement les mobiles. On demande que l'affichage occupe tout l'espace disponible avec une taille de 1, autrement dit sans zoom.  -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Muriel Poulain">
        <meta name="description" content="Projet 3 - Blog pour un écrivain">

        <link rel="stylesheet" href="public/css/bootstrap.css" />
        <link rel="stylesheet" href="public/css/style3.css" /> 

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:500" rel="stylesheet">

        <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
        <script type="text/javascript">
            tinymce.init({
            selector: '.tiny',
            menubar: false,
            content_css: "public/css/style3.css",
            toolbar: [' undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify ', 
             'bullist numlist outdent indent | link image | print preview fullpage | forecolor backcolor emoticons', 
            ], 
            plugins: [
              'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
              'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime  nonbreaking',
              'save table contextmenu directionality emoticons template paste textcolor'
            ], 
            
            height: 150,
            branding: false, // supprime le "Powered by TinyMCE" branding           
            });
        </script>

        <title><?= $this->title ?></title>

    </head>

    <body class="<?php if($this->getAdmin()) { echo 'admin';} ;?>">

    <!-- Header -->
    <header id="header" class="masthead">
        <nav class="navbar navbar-expand-lg bg-secondary fixed-top navbar-shrink" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="index.php"><img src="public/img/begins_Simon_Migaj_pexels.jpg" class="rounded" width="30"  height="30" alt="Let's begin image d'accueil" title="Que l'aventure commence !"> Jean Forteroche</a>
                <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu</button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <?php if (isset($_SESSION['adminUsername'])) { ?>
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php">Accueil</a></li>
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=logAdmin">Tableau de bord</a></li>
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=logoutAdmin">Me déconnecter</a></li>
                        <?php  } else { ?>
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php">Accueil</a></li>
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=logAdmin">Espace administrateur</a></li>
                         <?php } ?> 
                    </ul>
                </div>
            </div>
        </nav>

        <div class="carousel-item">
            <img class="img-fluid w-100 d-none d-md-block mx-auto" src="public/img/snow_pexels.jpg" alt="Let's begin image d'accueil" title="Que l'aventure commence !">
            <div class="carousel-caption">
                <h1 class="mb-0" id="blogTitle">Billet simple pour l'Alaska</h1>
                <hr>
                <h2 class="font-weight-light mb-0">Blog de Jean Forteroche</h2>
            </div>
        </div>
    </header>  

    <!-- Content -->
    <div class="template">    
        <?= $content ?>                      
    </div>
   
    <!-- Footer --> 
    <footer id="footer" class="footer w-100 mt-1 text-center text-white fixed-bottom">
        <div class="container">
            <p>Jean Forteroche vous livre ses aventures.<br />
                <small>Copyright 2018 jean.forteroche.com </small></p>
        </div>
    </footer>  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>