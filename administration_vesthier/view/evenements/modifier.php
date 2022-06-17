<?php 

/**
 * Page pour modifier un évenement
 * @author: Tristan Huguenot
 * @version: 1.0
 * Création : 18/11/2021
 * Dernière modification : NaN
 */

    $page_titre = 'Modifier un évenement';
    ob_start();
?>

<h2 class="contenant_principal">Modifier un évenement :</h2>

<form id="form_modif_even" enctype="multipart/form-data" class="contenant_principal" action="" method="post">
    <div class="champ">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre" autocomplete="off" value="<?= $evenement['titre'] ?>">
    </div>
    <div class="champ">
        <label for="description_evenement">Description :</label>
        <textarea autocomplete="off" id="description_evenement" name="description_evenement"><?= $evenement['description_evenement'] ?></textarea>
    </div>
    <div class="champ">
        <label for="adresse">Adresse :</label>
        <input type="text" name="adresse" id="adresse" value="<?= $evenement['adresse'] ?>">
    </div>
    <div class="champ">
        <label for="date_evenement">Date de l'évenement :</label>
        <input type="date" name="date_evenement" id="date_evenement" autocomplete="off" value="<?= $evenement['date_formulaire'] ?>">
    </div>
    <div class="champ">
        <p>Horraire de l'évenement :</p>
        <div class="row">
            <div class="champ_row">
                <label for="heure_debut">Heure de début :</label>
                <input type="time" name="heure_debut" id="heure_debut" autocomplete="off" value="<?= Vesthier\model\Model::deleteFrom($evenement['heure_debut'], ':') ?>">
            </div>
            <div class="champ_row">
                <label for="heure_fin">Heure de fin :</label>
                <input type="time" name="heure_fin" id="heure_fin" autocomplete="off" value="<?= Vesthier\model\Model::deleteFrom($evenement['heure_fin'], ':') ?>">
            </div>
        </div>
    </div>
    <div class="champ">
        <label for="image_evenement">Image de l'évenement :</label>
        <input type="file" name="image_evenement" id="image_evenement">
        <div class="contenu row">
            <img class="image" src="..<?= $evenement['url_image'] ?>" alt="">
            <p>En choisissant une nouvelle image, la précedente sera supprimée</p>
        </div>
    </div>

    <button for="form_modif_even" class="bouton">Envoyer</button>

</form>

<?php 
    $page_contenu = ob_get_clean();
    require('view/template.php'); 
?>