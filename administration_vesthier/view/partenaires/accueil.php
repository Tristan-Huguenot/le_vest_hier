<?php 

/**
 * Liste des partenaires
 * @author: Tristan Huguenot
 * @version: 1.0
 * Création : 19/11/2021
 * Dernière modification : NaN
 */

    $page_titre = 'Articles';
    ob_start();
?>

<div class="contenant_principal">

    <h2 class="contenu">Partenaires</h2>

    <div class="contenu"><a class="lien" href="index.php?dest=partenaires&action=ajouter">Ajouter un partenaire</a></div>
    
    <?php foreach($liste_partenaires as $partenaire): ?>

        <div class="contenu row partenaire">

            <h3><?= $partenaire['nom'] ?></h3>
            <a href="<?= $partenaire['lien'] ?>"><img src="..<?= $partenaire['url_logo'] ?>" alt="<?= $partenaire['nom'] ?>" class="image_partenaire"></a>
            <div class="actions">
                <a class="icone" href="index.php?dest=partenaires&action=modifier&id_partenaire=<?= $partenaire['id'] ?>">
                    <img class="icone_lien" src="../public/img/icone/modifier.svg" alt="Modifier">
                </a>
                <a onclick="return confirm('Confirmez vous la suppression du partenaires <?= $partenaire['nom'] ?>')" class="icone_lien" href="index.php?dest=partenaires&action=supprimer&id_partenaire=<?= $partenaire['id'] ?>">
                    <img class="icone" src="../public/img/icone/supprimer.svg" alt="Supprimer">
                </a>
            </div>

        </div>

    <?php endforeach; ?>

</div>

<?php 
    $page_contenu = ob_get_clean();
    require('view/template.php'); 
?>