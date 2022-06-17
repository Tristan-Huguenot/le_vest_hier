<?php
/**
 * Page pour ajouter un partenaire
 * @author: Tristan Huguenot
 * @version: 1.0
 * Création : 19/11/2021
 * Dernière modification : NaN
 */

    $page_titre = 'Articles';
    ob_start();
?>

<h2 class="contenant_principal">Ajouter un partenaire :</h2>

<form enctype="multipart/form-data" class="contenant_principal" action="" method="post">
    <div class="champ">
        <label for="nom_partenaire">Nom du partenaire :</label>
        <input type="text" name="nom_partenaire" id="nom_partenaire">
    </div>
    <div class="champ">
        <label for="lien_partenaire">Lien du site / réseau social :</label>
        <input type="text" name="lien_partenaire" id="lien_partenaire">
    </div>
    <div class="champ">
        <label for="logo_partenaire">Logo du partenaire (jpg, jpeg ou png) :</label>
        <input type="file" name="logo_partenaire" id="logo_partenaire">
    </div>
    
    <button class="bouton">Envoyer</button>

</form>

<?php 
    $page_contenu = ob_get_clean();
    require('view/template.php'); 
?>