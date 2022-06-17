<?php 

/**
 * Page pour modifier une section
 * @author: Tristan Huguenot
 * @version: 1.0
 * Création : 18/11/2021
 * Dernière modification : NaN
 */

    $page_titre = 'Modifier une section à "Lorem ipsum"';
    ob_start();
?>

<h2 class="contenant_principal">Modifier une section de l'article "<?= $article['titre'] ?>" :</h2>

<form enctype="multipart/form-data" id="form_modifier_section" class="contenant_principal" action="" method="post">
    <div class="champ">
        <label for="titre_section">Titre de la section :</label>
        <input type="text" name="titre_section" id="titre_section" autocomplete="off" value="<?= $section['titre'] ?>">
    </div>
    <div class="champ">
        <label for="description_section">Texte de la section :</label>
        <textarea name="description_section" id="description_section" autocomplete="off"><?= $section['texte'] ?></textarea>
    </div>
    <div class="champ">
        <label for="image_section">Image de la section :</label>
        <input type="file" name="image_section" id="image_section">
        <?php if($section['url_image'] != NULL): ?>
            <div class="contenu row">
                <img class="image" src="..<?= $section['url_image'] ?>" alt="">
                <p class="info">En choisissant une nouvelle image, la précedente sera supprimée</p>
            </div>
        <?php endif; ?>
    </div>
    
    <button for="form_modifier_section" class="bouton">Envoyer</button>

</form>

<?php 
    $page_contenu = ob_get_clean();
    require('view/template.php'); 
?>