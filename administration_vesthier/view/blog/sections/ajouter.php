<?php 

/**
 * Page pour ajouter une section
 * @author: Tristan Huguenot
 * @version: 1.0
 * Création : 18/11/2021
 * Dernière modification : NaN
 */

    $page_titre = 'Ajouter une section à "Lorem ipsum"';
    ob_start();
?>

<h2 class="contenant_principal">Ajouter une section à l'article "<?= $article['titre'] ?>" :</h2>

<form enctype="multipart/form-data" class="contenant_principal" action="" method="post">
    <div class="champ">
        <label for="titre_section">Titre de la section :</label>
        <input type="text" name="titre_section" id="titre_section">
    </div>
    <div class="champ">
        <label for="description_section">Texte de la section :</label>
        <textarea name="description_section" id="description_section"></textarea>
    </div>
    <div class="champ">
        <label for="image_section">Image de la section :</label>
        <input type="file" name="image_section" id="image_section">
    </div>
    
    <button class="bouton">Envoyer</button>

</form>

<?php 
    $page_contenu = ob_get_clean();
    require('view/template.php'); 
?>