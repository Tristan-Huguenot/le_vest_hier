<?php 

/**
 * Page permettant CRUD sur les catégories et sous-catégories
 * @author: Tristan Huguenot
 * @version: 1.0
 * Création : 19/11/2021
 * Dernière modification : NaN
 */

    $page_titre = 'Administration';
    ob_start();
?>

<div class="contenant_principal">
    <h2 class="contenu">Catégorie des articles</h2>

    <div class="contenu"><a href="index.php?dest=categories&action=ajouterCategorie" class="lien lien_1">Ajouter une catégorie</a></div>

    <?php foreach($listeCategories as $categorie): ?>
    
        <div class="contenant contenu categorie">

            <form id="<?= $categorie['id']?>" action="index.php?dest=categories&action=modifierCategorie&id_categorie=<?= $categorie['id'] ?>" method="post" class="contenu row form_categorie">
                <h3 class="icone_lien titre"><?= $categorie['nom']?></h3>
                <input class="bouton actions_invisible" type="text" name="nom" id="" value="<?= $categorie['nom']?>">
                <div class="actions">
                    <img class="icone_lien modifier" src="../public/img/icone/modifier.svg" alt="Modifier">
                    <a onclick="return confirm('Attention ! Tous les articles liés à <?= $categorie['nom'] ?> ne seront plus catégorisés et les sous-catégories seront supprimées également. Confirmez vous la suppression ?')" href="index.php?dest=categories&action=deleteCategorie&id_categorie=<?= $categorie['id']?>"><img class="icone_lien supprimer" src="../public/img/icone/supprimer.svg" alt="Supprimer"></a>
                    <input class="bouton actions_invisible valider" type="submit" value="Valider">
                    <a href="" onclick="return false" class="bouton actions_invisible annuler">Annuler</a>
                </div>
            </form>

        <a href="index.php?dest=categories&action=ajouterSousCategorie&id_categorie=<?= $categorie['id'] ?>" class="lien lien_2">Ajouter une sous-catégorie</a>

        <?php foreach($categoriesModel->readSousCategories($categorie['id']) as $sousCategorie): ?>
            <form id="<?= $sousCategorie['id']?>" action="index.php?dest=categories&action=modifierSousCategorie&id_sous_categorie=<?= $sousCategorie['id']?>" method="post" class="contenu row form_categorie">
                <h4 class="icone_lien titre"><?= $sousCategorie['nom']?></h4>
                <input class="bouton actions_invisible" type="text" name="nom" id="" value="<?= $sousCategorie['nom']?>">
                <div class="actions">
                    <img class="icone_lien modifier" src="../public/img/icone/modifier.svg" alt="Modifier">
                    <a onclick="return confirm('Attention ! Tous les articles liés à <?= $categorie['nom'] ?> ne seront plus catégorisés. Confirmez vous la suppression ?')" href="index.php?dest=categories&action=deleteSousCategorie&id_sous_categorie=<?= $sousCategorie['id']?>"><img class="icone_lien supprimer" src="../public/img/icone/supprimer.svg" alt="Supprimer"></a>
                    <input class="bouton actions_invisible valider" type="submit" value="Valider">
                    <a href="" onclick="return false" class="bouton actions_invisible annuler">Annuler</a>
                </div>
            </form>
        <?php endforeach;?>

        </div>
       
    <?php endforeach;?>

</div>

<script src="./public/js/categorie.js"></script>

<?php 
    $page_contenu = ob_get_clean();
    require('view/template.php'); 
?>