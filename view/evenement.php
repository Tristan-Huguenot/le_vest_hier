<?php 

/**
 * Template de la page d'un évenement
 * @author: Tristan Huguenot
 * @version: 1.0
 * Création : 08/10/2021
 * Dernière modification : Nan
 */

    $page_titre = 'Titre de l\'évenement';
    ob_start();
?>

<div id="evenement" class="wrapper">

    <nav id="arianne">
        <a href="index.php">Accueil</a>
        <a href="index.php?dest=evenements">Évenements</a>
        <a href=""><?= $evenement['slug_titre'] ?></a>
    </nav>

    <article class="evenement">
        <h2><?= $evenement['titre'] ?></h2>
        <div class="info">
            <p class="date">Le <?= $evenement['date_formulaire'] ?></p>
            <p class="adresse"><?= $evenement['adresse'] ?></p>
        </div>
        <p class="texte">
        <?= $evenement['description_evenement'] ?>
        </p>
        <div class="img">
            <div class="decoration"></div>
            <img class="image unique_evenement" src=".<?= $evenement['url_image'] ?>" alt="">
            <div class="decoration"></div>
        </div>
    </article>

</div>

<?php 
    $page_contenu = ob_get_clean();
    require('view/template.php'); 
?>