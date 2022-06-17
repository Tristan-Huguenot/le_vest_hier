<?php 

/**
 * Template de la page d'un évenement
 * @author: Tristan Huguenot
 * @version: 1.0
 * Création : 08/10/2021
 * Dernière modification : Nan
 */

    $page_titre = 'Une recyclerie ?';
    ob_start();
?>

<div id="recyclerie" class="wrapper">
    <nav id="arianne">
        <a href="index.php">Accueil</a>
        <a href="">Une recyclerie ?</a>
    </nav>

    <article>
        <section>
            <h2>Le Vest’hier Itinérant, Recyclerie Associative est un acteur du réemploi</h2>
            <p class="margin-bottom">Une recyclerie permet de donner une nouvelle vie à des objets et des matériaux divers et variés, par le réemploi ou la réutilisation.</p>

            <h3>Notre recyclerie met en œuvre différentes actions:</h3>
            <ul>
                <li>La collecte d’objets auprès des particuliers et des entreprises</li>
                <li>La valorisation et le réemploi d’objets</li>
                <li>La revente à prix solidaire dans notre espace de réemploi</li>
                <li>La sensibilisation à la préservation de notre environnement et nos ressources</li>
                <li>Mise en place d’ateliers de créations sur le thème du réemploi auprès de différents public</li>
                <li>La mise en place de partenariats avec des entreprises, des artisans, des commerçants..</li>
            </ul>
            <p>Vous l’aurez compris notre objectif ,en tant que structure de l’économie sociale et solidaire est d’agir concrètement sur la diminution de notre production de déchets et de lutter contre toutes formes de gaspillage.</p>
        </section>
        <div class="decoration"></div>
    </article>

    <div class="partenaires">
        <div class="remerciement">
            <p>Nous prenons à coeur de remercier nos donateurs, nos adhérants et nos partenaires qui soutiennent notre recyclerie et qui rendent possible cette aventure.</p>
            <p>Grâce à eux l’association continue ses actions en Charente et Charente maritime pour réduire toujours plus nos déchets.</p>
        </div>

    <?php if(!empty($liste_partenaires)): ?>

        <div class="partenaire">

        <?php foreach($liste_partenaires as $partenaire): ?>

           <a href="<?= $partenaire['lien'] ?>"><img src=".<?= $partenaire['url_logo'] ?>" alt="<?= $partenaire['nom'] ?>"></a>

        <?php endforeach; ?>

        </div>

    <?php endif; ?>

    </div>

</div>

<?php 
    $page_contenu = ob_get_clean();
    require('view/template.php'); 
?>