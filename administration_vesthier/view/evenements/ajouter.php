<?php 

/**
 * Page pour ajouter un évenement
 * @author: Tristan Huguenot
 * @version: 1.0
 * Création : 18/11/2021
 * Dernière modification : NaN
 */

    $page_titre = 'Ajouter un évenement';
    ob_start();
?>

<h2 class="contenant_principal">Ajouter un évenement :</h2>

<form enctype="multipart/form-data" class="contenant_principal" action="" method="post">
    <div class="champ">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre">
    </div>
    <div class="champ">
        <label for="description_evenement">Description :</label>
        <textarea name="description_evenement" id="description_evenement"></textarea>
    </div>
    <div class="champ">
        <label for="adresse">Adresse :</label>
        <input type="text" name="adresse" id="adresse">
    </div>
    <div class="champ">
        <label for="date_evenement">Date de l'évenement :</label>
        <input type="date" name="date_evenement" id="date_evenement">
    </div>
    <div class="champ">
        <p>Horraire de l'évenement :</p>
        <div class="row">
            <div class="champ_row">
                <label for="heure_debut">Heure de début :</label>
                <input type="time" name="heure_debut" id="heure_debut">
            </div>
            <div class="champ_row">
                <label for="heure_fin">Heure de fin :</label>
                <input type="time" name="heure_fin" id="heure_fin">
            </div>
        </div>
    </div>
    <div class="champ">
        <label for="image_evenement">Image de l'évenement :</label>
        <input type="file" name="image_evenement" id="image_evenement">
    </div>
    
    <button class="bouton">Envoyer</button>

</form>

<?php 
    $page_contenu = ob_get_clean();
    require('view/template.php'); 
?>