<?php 

/**
 * Template de la page d'un article
 * @author: Tristan Huguenot
 * @version: 1.0
 * Création : 09/10/2021
 * Dernière modification : Nan
 */

    $page_titre = 'Titre de l\'évenement';
    ob_start();
?>

<div id="article" class="wrapper">

    <nav id="arianne">
        <a href="index.php">Accueil</a>
        <a href="index.php?dest=blog">Blog</a>
        <a href=""><?= $article['slug_titre'] ?></a>
    </nav>

    <article>
        
        <section class="section principale">
            <h2><?= $article['titre'] ?></h2>
            <div class="infos">
                <p><?= $article['date_upload'] ?></p>
                <p><?php if(isset($categorie)) echo $categorie ?></p>
                <p><?php if(isset($sous_categorie)) echo $sous_categorie ?></p>
            </div>
            <p><?= $article['texte_chapeau'] ?>
            </p>
            <img class="image" src=".<?= $article['url_image_principale'] ?>" alt="">
            <div class="decoration"></div>
        </section>
        
        <?php foreach($sections as $section): ?>

        <section class="section">
            <?php if($section['titre']): ?>
                <h3><?= $section['titre'] ?></h3>
            <?php endif; ?>
            <?php if($section['texte']): ?>
                <p><?= $section['texte'] ?></p>
            <?php endif; ?>
            <?php if($section['url_image']): ?>
                <img class="image" src=".<?= $section['url_image'] ?>" alt="">
            <?php endif; ?>
            <div class="decoration"></div>
        </section>

        <?php endforeach; ?>

    </article>
    
    <div class="image_fin">
        <?php foreach($images_secondaires as $image): ?>
            <img src=".<?= $image['url_image'] ?>" alt="">
        <?php endforeach; ?>
    </div>

</div>

<?php 
    $page_contenu = ob_get_clean();
    require('view/template.php'); 
?>