<?php 

/**
 * Liste des articles
 * @author: Tristan Huguenot
 * @version: 1.0
 * Création : 18/11/2021
 * Dernière modification : NaN
 */

    $page_titre = 'Articles';
    ob_start();
?>

<div class="contenant_principal">
    <h2 class="contenu">Articles du Vesthier itinérant :</h2>
    <div class="contenu contenant">
        <h3>Citation du blog :</h3>
        <form class="citation" action="" method="post">
            <input type="text" name="citation" id="citation" value="<?= $citation ?>">

            <div class="actions">
                <input id="bouton_citation" class="bouton" type="submit" value="Modifier">
            </div>
            
        </div>
    </div>
    <div class="contenu"><a class="contenu lien" href="index.php?dest=blog&action=ajouter">Ajouter un article</a></div>
</div>

<table class="contenant_principal" id="tableau_articles">
    <thead>
        <tr class="titres">
            <th scope="col">Titre</th>
            <th scope="col">Description</th>
            <th scope="col">Catégorie</th>
            <th scope="col">Sous-catégorie</th>
            <th scope="col">Date</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    
    <tbody>

    <?php foreach($listeArticles as $article):?>

        <tr class="article">
            <td><?= Vesthier\model\Model::xWords($article['titre'], 8) ?></td>
            <td><?= Vesthier\model\Model::xWords($article['texte_chapeau'], 8) ?></td>
            <td><?= ($article['categorie_articles_id'])? $categorieModel->readCategories($article['categorie_articles_id'])['nom'] : 'Pas de catégorie' ?></td>
            <td><?= ($article['sous_categorie_articles_id'])? $categorieModel->readSousCategories($article['categorie_articles_id'], $article['sous_categorie_articles_id'])['nom'] : 'Pas de sous-catégorie' ?></td>
            <td><?= $article['date_upload'] ?></td>
            <td class="actions">
                <a class="icone" href="index.php?dest=blog&action=visionner&id=<?= $article['id'] ?>">
                    <img class="icone_lien" src="../public/img/icone/info.svg" alt="Visionner">
                </a>
                <a class="icone" href="index.php?dest=blog&action=modifier&id=<?= $article['id'] ?>">
                    <img class="icone_lien" src="../public/img/icone/modifier.svg" alt="Modifier">
                </a>
                <a onclick="return confirm('Confirmez la suppression de l\'article :')" class="icone_lien" href="index.php?dest=blog&action=supprimer&id=<?= $article['id'] ?>">
                    <img class="icone" src="../public/img/icone/supprimer.svg" alt="Supprimer">
                </a>
            </td>
        </tr>

    <?php endforeach; ?>

    </tbody>
</table>

<?php 
    $page_contenu = ob_get_clean();
    require('view/template.php'); 
?>