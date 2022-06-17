<?php

/**
 * Template du site Vest'hier
 * @author: Tristan Huguenot
 * @version: 1.0
 * Création : 03/10/2021
 * Dernière modification : Nan
 */

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--Metadonnees-->

        <!--Fin metadonnees-->

        <title><?= $page_titre ?> - Le Vest'hier itinérant</title>

        <link rel="shortcut icon" href="public/img/icone/accueil.svg" type="image/x-icon">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
        <link rel="stylesheet" href="public/css/style.css">
    </head>

    <body>
    
        <header id="header">
            <img class="baniere_element" src="public/img/baniere/gauche.svg" alt="">
            
            <div>
                <img class="logo" src="public/img/logo/logo.svg" alt="Le vest'hier itinérant">
                <h1>Recyclerie <br> Associative</h1>
                <div class="decoration"></div>
            </div>

            <img class="baniere_element" src="public/img/baniere/droite.svg" alt="">

        </header>

        <nav id="menu_sticky">
            <div class="wrapper">
                <a href="index.php?dest=accueil">
                    <div class="svg">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" alt="Accueil">
                        <title>icone_accueil_100px</title>
                        <g id="icônes_100px" data-name="icônes 100px"><g id="icône_Accueil_100px" data-name="icône Accueil 100px">
                        <path fill="#7FBA28" d="M98,100a2,2,0,0,0,2-2A50,50,0,0,0,0,98a2,2,0,0,0,2,2H40.47a2,2,0,0,0,2-2V74a2,2,0,0,1,2-2h11a2,2,0,0,1,2,2V95.88c0,.1.05.19.06.29V98a2,2,0,0,0,2,2Z"/>
                        <path fill="#7FBA28" d="M51.5,20.93,80,48.31A6.12,6.12,0,0,0,84.28,50h13.6a2,2,0,0,0,1.49-3.47L51.5.6a2.17,2.17,0,0,0-3,0L.63,46.53A2,2,0,0,0,2.12,50h13.6A6.12,6.12,0,0,0,20,48.31L48.5,20.93A2.19,2.19,0,0,1,51.5,20.93Z"/>
                        </g></g>
                        </svg> 
                    </div>
                    <div class="texte">Accueil</div>
                </a>
                <a href="index.php?dest=evenements">Événements</a>
                <a href="index.php?dest=blog">Blog</a>
                <a href="index.php?dest=une_recyclerie">Une recyclerie ?</a>
            </div>
        </nav>

        <div id="burger">
            <img src="public/img/icone/burger.svg" alt="Ouvrir le menu burger" id="burger_img">
        </div>

        <script src="public/js/menu_burger_site.js"></script>

        <main id="main">

            <?php if(isset($_SESSION['message'])): ?>

            <div id="session_message" class='<?= $_SESSION['message']['type'] ?>'> <?= $_SESSION['message']['text'] ?> </div>

            <?php 
            endif; 
            unset($_SESSION['message']);
            ?>

            <script src="public/js/session_message.js"></script>

            <?= $page_contenu ?>

        </main>

        <footer id="footer">
            <div class="decoration footer"></div>
            <div class="wrapper">
                <a href="index.php?dest=mentions">Mentions légales</a>
                <div class="reseaux_sociaux">
                    <a href="https://www.facebook.com/levesthieritinerant">
                        <img class="rs" src="public/img/icone/facebook.svg" alt="Facebook">
                    </a>
                    <a href="https://www.instagram.com/le_vesthier_16000/?hl=fr">
                        <img class="rs" src="public/img/icone/instagram.png" alt="Instagram">
                    </a>
                </div>
            </div>
        </footer>
    </body>
</html>