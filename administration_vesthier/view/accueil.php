<?php 

/**
 * Contenu de la page d'accueil du backoffice
 * @author: Tristan Huguenot
 * @version: 1.0
 * Création : 09/10/2021
 * Dernière modification : NaN
 */

    $page_titre = 'Administration';
    ob_start();
?>

<div id="presentation" class="contenant_principal">

    <p class="contenu">Bienvenue sur la partie administration du site.</p>
    <p class="contenu">Ici vous pourrez gérer vos évenements, vos articles et vos partenaires.</p>

</div>

<div id="evenement" class="contenant_principal">

    <h2 class="contenu">Dernier évenement mis en ligne :</h2>

    <?php if(!empty($lastEvenement)): ?>

        <div class="contenu row">
            <img class="image" src="..<?= $lastEvenement['url_image'] ?>" alt="">
            <div class="texte">
                <div class="resume">
                    <h3><?= $lastEvenement['titre'] ?></h3>
                    <p><?= Vesthier\model\Model::xWords($lastEvenement['description_evenement'], 12) ?></p>
                </div>
                
                <div class="liens">
                    <a class="lien" href="index.php?dest=evenements&action=modifier&id=<?= $lastEvenement['id'] ?>">Modifier l'évenement</a>
                    <a onclick="return confirm('Confirmez la suppression de l\'évenement :')" class="lien" href="index.php?dest=evenements&action=supprimer&id=<?= $lastEvenement['id'] ?>">Supprimer l'évenement</a>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <?php if(empty($lastEvenement)) echo '<p> Il n\'y a aucun évenement.</p>'; ?>

</div>

<div id="article" class="contenant_principal">

    <h2 class="contenu">Dernier article mis en ligne :</h2>

    <?php if(!empty($lastArticle)): ?>
        <div class="contenu row">
            <div class="image_resume">
                <img class="image" src="..<?= $lastArticle['url_image_principale'] ?>" alt="">
            </div>
            <div class="texte">
                <div class="resume">
                    <h3><?= $lastArticle['titre'] ?></h3>
                    <p><?= Vesthier\model\Model::xWords($lastArticle['texte_chapeau'], 12) ?></p>
                </div>
                
                <div class="liens">
                    <a class="lien" href="index.php?dest=blog&action=visionner&id=<?= $lastArticle['id'] ?>">Visionner l'article</a>
                    <a class="lien" href="index.php?dest=blog&action=modifier&id=<?= $lastArticle['id'] ?>">Modifier l'article</a>
                    <a onclick="return confirm('Confirmez vous la suppression de l\'article ?')" class="lien" href="index.php?dest=blog&action=supprimer&id=<?= $lastArticle['id'] ?>">Supprimer l'article</a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if(empty($lastArticle)) echo '<p> Il n\'y a aucun article.</p>'; ?>

</div>

<?php 
    $page_contenu = ob_get_clean();
    require('view/template.php'); 
?>