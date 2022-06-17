<?php 

/**
 * Page pour ajouter un article
 * @author: Tristan Huguenot
 * @version: 1.0
 * Création : 18/11/2021
 * Dernière modification : NaN
 */

    $page_titre = 'Ajouter un article';
    ob_start();
?>

<h2 class="contenant_principal">Ajouter un article :</h2>

<form id="form_ajout_article" enctype="multipart/form-data" class="contenant_principal" action="" method="post">
    <div class="champ">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre">
    </div>
    <div class="champ">
        <label for="texte_chapeau">Description :</label>
        <textarea name="texte_chapeau" id="texte_chapeau"></textarea>
    </div>
    <div class="champ">
        <label for="image_article">Image principal de l'article (jpg, jpeg, png) :</label>
        <input type="file" name="image_article" id="image_article">
    </div>
    <div class="champ_row">
        <div class="champ">
            <label for="categorie">Catégorie :</label>
            <select name="categorie" id="categorie">

                <option id="aucune_categorie" value="">Aucune catégorie</option>
                
                <?php foreach($listeCategories as $categorie): ?>

                    <option id="<?= $categorie['slug'] ?>" class="categorie" value="<?= $categorie['id'] ?>"><?= $categorie['nom'] ?></option>

                <?php endforeach; ?>

            </select>
        </div>
        <div class="champ">
            <label for="sous_categorie">Sous-catégorie :</label>
            <select name="sous_categorie" id="sous_categorie">

                <option id="aucune_sous_categorie" value="">Aucune sous-catégorie</option>

                <?php foreach($listeCategories as $categorie): ?>
                    
                    <?php foreach($categorieModel->readSousCategories($categorie['id']) as $sousCategorie): ?>
                        
                        <option class="sous_categorie <?= $categorie['slug'] ?>" value="<?= $sousCategorie['id'] ?>"><?= $sousCategorie['nom'] ?></option>

                    <?php endforeach; ?>

                <?php endforeach; ?>
    
            </select>
        </div>
    </div>

    <script src="public/js/formulaire_categorie_article.js"></script>

    <p class="info">Après avoir créé l’article vous pourrez ajouter des sections et des images de fin d’article.</p>

    <button form="form_ajout_article" class="bouton">Envoyer</button>

</form>

<?php 
    $page_contenu = ob_get_clean();
    require('view/template.php'); 
?>