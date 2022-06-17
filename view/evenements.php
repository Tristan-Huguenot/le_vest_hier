<?php 

/**
 * Template de la page regroupant les évenements
 * @author: Tristan Huguenot
 * @version: 1.0
 * Création : 08/10/2021
 * Dernière modification : Nan
 */

    $page_titre = 'Évenements';
    ob_start();
?>

    <div id="evenements" class="wrapper">

        <nav id="arianne">
            <a href="index.php">Accueil</a>
            <a href="index.php?dest=evenements">Évenements</a>
            <a href="index.php?dest=evenements&page=<?= $_GET['page'] ?>">Page <?= $_GET['page'] ?></a>
        </nav>

        <div class="evenements">

            <?php foreach($evenements_page as $evenement): ?>
                <article class="evenement">
                    <div class="decoration"></div>
                    <div class="img">
                        <div class="gradiant"></div>
                        <img class="image evenement" src=".<?= $evenement['url_image'] ?>" alt="image illustrant l'évenement">
                        <p>Le <?= $evenement['date_entiere'] ?></p>
                    </div>
                    <div class="texte_evenement">
                        <section class="texte">
                            <h3><?= $evenement['titre'] ?></h3>
                            <p><?= Vesthier\model\Model::xWords($evenement['description_evenement'], 15) ?></p>
                        </section>
                        <a href="index.php?dest=evenement&id=<?= $evenement['id'] ?>" class="bouton">Lire la suite...</a>
                    </div>
                </article>
            <?php endforeach; ?>

            <nav class="pages">

                <?php if($precedant): ?>
                    <a class="precedant" href="index.php?dest=evenements&page=<?= $_GET['page'] - 1 ?>">
                        <svg class="gauche" viewBox="0 0 26 50" fill="none" xmlns="http://www.w3.org/2000/svg" alt="Évenement précedant">
                            <path d="M11.4545 25.7497L25.1427 39.9943C25.6919 40.5703 25.995 41.3376 25.9876 42.1334V48.9308C26.002 49.1377 25.9517 49.344 25.8437 49.521C25.7357 49.698 25.5752 49.8371 25.3846 49.9189C25.194 50.0007 24.9827 50.0213 24.7799 49.9777C24.5771 49.9341 24.3929 49.8285 24.2528 49.6756L1.29091 25.7497C1.09778 25.5479 0.98999 25.2793 0.98999 25C0.98999 24.7207 1.09778 24.4521 1.29091 24.2503L24.2528 0.324445C24.3929 0.171521 24.5771 0.0659449 24.7799 0.0223442C24.9827 -0.0212566 25.194 -0.000723495 25.3846 0.0810986C25.5752 0.162921 25.7357 0.301981 25.8437 0.479013C25.9517 0.656046 26.002 0.862286 25.9876 1.06916V7.86656C25.995 8.66235 25.6919 9.42971 25.1427 10.0057L11.4545 24.2503C11.2637 24.4533 11.1574 24.7214 11.1574 25C11.1574 25.2786 11.2637 25.5467 11.4545 25.7497V25.7497Z" fill="#7FBA28"/>
                        </svg>
                    </a>
                <?php endif; ?>
                <div class="nombres">
                    <p class="page_actuelle"><?= $_GET['page'] ?></p>
                    <p class="nombre_pages"><?= $nbr_pages ?></p>
                </div>
                <?php if($suivant): ?>
                    <a class="suivant" href="index.php?dest=evenements&page=<?= $_GET['page'] + 1 ?>">
                        <svg class="droite" viewBox="0 0 26 50" fill="none" xmlns="http://www.w3.org/2000/svg" alt="Évenement précedant">
                            <path d="M11.4545 25.7497L25.1427 39.9943C25.6919 40.5703 25.995 41.3376 25.9876 42.1334V48.9308C26.002 49.1377 25.9517 49.344 25.8437 49.521C25.7357 49.698 25.5752 49.8371 25.3846 49.9189C25.194 50.0007 24.9827 50.0213 24.7799 49.9777C24.5771 49.9341 24.3929 49.8285 24.2528 49.6756L1.29091 25.7497C1.09778 25.5479 0.98999 25.2793 0.98999 25C0.98999 24.7207 1.09778 24.4521 1.29091 24.2503L24.2528 0.324445C24.3929 0.171521 24.5771 0.0659449 24.7799 0.0223442C24.9827 -0.0212566 25.194 -0.000723495 25.3846 0.0810986C25.5752 0.162921 25.7357 0.301981 25.8437 0.479013C25.9517 0.656046 26.002 0.862286 25.9876 1.06916V7.86656C25.995 8.66235 25.6919 9.42971 25.1427 10.0057L11.4545 24.2503C11.2637 24.4533 11.1574 24.7214 11.1574 25C11.1574 25.2786 11.2637 25.5467 11.4545 25.7497V25.7497Z" fill="#7FBA28"/>
                        </svg>
                    </a>
                <?php endif; ?>
            </nav>

        </div>

    </div>

<?php 
    $page_contenu = ob_get_clean();
    require('view/template.php'); 
?>