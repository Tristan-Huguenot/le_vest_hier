<?php 

/**
 * Page pour visionner un article
 * @author: Tristan Huguenot
 * @version: 1.0
 * Création : 18/11/2021
 * Dernière modification : NaN
 */

    $page_titre = 'Nom de l\'article';
    ob_start();
?>

<div class="contenant_principal">
    <div class="contenant contenu">
        <div class="contenu row">
            <h2><?= $article['titre'] ?></h2>
            <div class="actions">
                    <a class="icone" href="index.php?dest=blog&action=modifier&id=<?= $article['id'] ?>">
                        <img class="icone_lien" src="../public/img/icone/modifier.svg" alt="Modifier">
                    </a>
                    <a  onclick="return confirm('Confirmez la suppression de l\'article :')" class="icone_lien" href="index.php?dest=blog&action=supprimer&id=<?= $article['id'] ?>">
                        <img class="icone" src="../public/img/icone/supprimer.svg" alt="Supprimer">
                    </a>
            </div>
        </div>
        <q><?= $article['date_upload'] ?></q>
        <p><?= $article['texte_chapeau'] ?></p>

        <img class="image" src="..<?= $article['url_image_principale'] ?>" alt="">

    </div>
    <div class="contenant contenu sections">
        <h3>Sections :</h3>
        
        <?php
            $i = 1;
            foreach($listeSections as $section): 
        ?>
            <div class="section">
                <div class="contenu row">
                    

                        <h4>Section <?= $i ?><?php if($section['titre'] != NULL) echo ' : ' . $section['titre'] ?></h4>
                        <div class="actions">
                            <a class="icone" href="index.php?dest=blog&action=modifierSection&idSection=<?= $section['id'] ?>&id=<?= $article['id'] ?>">
                                <img class="icone_lien" src="../public/img/icone/modifier.svg" alt="Modifier">
                            </a>
                            <a onclick="return confirm('Confirmez la suppresion de la section :')" class="icone_lien" href="index.php?dest=blog&action=supprimerSection&id=<?= $article['id'] ?>&id_section=<?= $section['id'] ?>">
                                <img class="icone" src="../public/img/icone/supprimer.svg" alt="Supprimer">
                            </a>
                        </div>

                    
                </div>
                <div class="row">
                    <?php if($section['texte'] != NULL) echo '<p>' . Vesthier\model\Model::xWords($section['texte'], 20) . '</p>' ?>
                    <?php if($section['url_image'] != NULL) echo '<img src="..' . $section['url_image'] . '" alt="" class="image">' ?>
                </div>
            
            <?php
                $i++;
                endforeach;
            ?>
        </div>
        <a href="index.php?dest=blog&action=ajouterSection&id=<?= $article['id'] ?>" class="lien">Ajouter une section (titre, texte, image)</a>
    </div>
    <div class="contenant contenu">
        <h3>Images de fin d'article :</h3>
        <div class="row">

            <?php foreach($listeImages as $image_fin): ?>

            <div class="image_fin">
                <img src="..<?= $image_fin['url_image'] ?>" alt="" class="image">
                <div class="supprimer_image">
                    <a onclick="return confirm('Confirmez la suppression de l\'image :')" class="icone_lien" href="index.php?dest=blog&action=visionner&id=<?= $article['id'] ?>&param=supprimerImage&idImage=<?= $image_fin['id'] ?>">
                        <img src="../public/img/icone/supprimer.svg" alt="Supprimer">
                    </a>
                </div>
            </div>

            <?php endforeach; ?>

        </div>
        <form enctype="multipart/form-data" action="" method="post" id="form_images_secondaires">
            <div class="champ">
                <label for="image_fin">Choisir une nouvelle image ( png, jpg, jpeg):</label>
                <input type="file" name="image_fin" id="image_fin">
            </div>
            <button for="form_images_secondaires" class="bouton gauche">Ajouter une image</button>
        </form>
    </div>
</div>

<?php 
    $page_contenu = ob_get_clean();
    require('view/template.php'); 
?>