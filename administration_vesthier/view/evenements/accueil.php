<?php 

/**
 * Liste des évenements
 * @author: Tristan Huguenot
 * @version: 1.0
 * Création : 18/11/2021
 * Dernière modification : NaN
 */

    $page_titre = 'Évenements';
    ob_start();
?>

<div class="contenant_principal">
    <h2 class="contenu">Évenements du Vesthier itinérant :</h2>

    <a class="contenu lien" href="index.php?dest=evenements&action=ajouter">Ajouter un évenement</a>
</div>

<table class="contenant_principal" id="tableau_evenements">
    <thead>
        <tr class="titres">
            <th scope="col">Titre</th>
            <th scope="col">Description</th>
            <th scope="col">Date</th>
            <th scope="col">Horraire</th>
            <th scope="col">Adresse</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    
    <tbody>
        <?php foreach($listeEvenements as $evenement):?>

            <tr class="evenement">
                <td><?= Vesthier\model\Model::xWords($evenement['titre'], 4) ?></td>
                <td><?= Vesthier\model\Model::xWords($evenement['description_evenement'], 7) ?></td>
                <td><?= $evenement['date_evenement'] ?></td>
                <td><?= Vesthier\model\Model::deleteFrom($evenement['heure_debut'], ':') ?> - <?= Vesthier\model\Model::deleteFrom($evenement['heure_fin'], ':') ?></td>
                <td><?= $evenement['adresse'] ?></td>
                <td class="actions">
                    <a class="icone" href="index.php?dest=evenements&action=modifier&id=<?= $evenement['id'] ?>">
                        <img class="icone_lien" src="../public/img/icone/modifier.svg" alt="Modifier">
                    </a>
                    <a onclick="return confirm('Confirmez vous la suppression de l\'évenement ?')" class="icone_lien" href="index.php?dest=evenements&action=supprimer&id=<?= $evenement['id'] ?>">
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