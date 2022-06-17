<?php 

/**
 * Contenu de la page d'accueil
 * @author: Tristan Huguenot
 * @version: 1.1
 * Création : 03/10/2021
 * Dernière modification : 09/10/2021
 * Reste à rajouter le js pour defilements des évenements et le formulaire.
 */

    $page_titre = 'Accueil';
    ob_start();
?>

    <div id="accueil" class="wrapper">
        
        <?php if(!empty($quatreProchEv)): ?>

        <div class="evenements">

            <h2>Nos prochains évenements :</h2>
            <img class="decoration" src="public/img/decoration_1.png" alt="">

            <div class="evenement">
                <svg id="fleche_gauche_carousel" class="gauche" viewBox="0 0 26 50" fill="none" xmlns="http://www.w3.org/2000/svg" alt="Évenement précedant">
                    <path d="M11.4545 25.7497L25.1427 39.9943C25.6919 40.5703 25.995 41.3376 25.9876 42.1334V48.9308C26.002 49.1377 25.9517 49.344 25.8437 49.521C25.7357 49.698 25.5752 49.8371 25.3846 49.9189C25.194 50.0007 24.9827 50.0213 24.7799 49.9777C24.5771 49.9341 24.3929 49.8285 24.2528 49.6756L1.29091 25.7497C1.09778 25.5479 0.98999 25.2793 0.98999 25C0.98999 24.7207 1.09778 24.4521 1.29091 24.2503L24.2528 0.324445C24.3929 0.171521 24.5771 0.0659449 24.7799 0.0223442C24.9827 -0.0212566 25.194 -0.000723495 25.3846 0.0810986C25.5752 0.162921 25.7357 0.301981 25.8437 0.479013C25.9517 0.656046 26.002 0.862286 25.9876 1.06916V7.86656C25.995 8.66235 25.6919 9.42971 25.1427 10.0057L11.4545 24.2503C11.2637 24.4533 11.1574 24.7214 11.1574 25C11.1574 25.2786 11.2637 25.5467 11.4545 25.7497V25.7497Z" fill="#7FBA28"/>
                </svg>

                <?php foreach($quatreProchEv as $evenement): ?>

                    <?php if(!empty($evenement)): ?>

                        <div class="conteneur_evenement">
                            <article class="evenement">
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
                        </div>

                    <?php endif;?>
                  
                <?php endforeach; ?>

                
                <svg id="fleche_droite_carousel" class="droite" viewBox="0 0 26 50" fill="none" xmlns="http://www.w3.org/2000/svg" alt="Évenement suivant">
                    <path d="M11.4545 25.7497L25.1427 39.9943C25.6919 40.5703 25.995 41.3376 25.9876 42.1334V48.9308C26.002 49.1377 25.9517 49.344 25.8437 49.521C25.7357 49.698 25.5752 49.8371 25.3846 49.9189C25.194 50.0007 24.9827 50.0213 24.7799 49.9777C24.5771 49.9341 24.3929 49.8285 24.2528 49.6756L1.29091 25.7497C1.09778 25.5479 0.98999 25.2793 0.98999 25C0.98999 24.7207 1.09778 24.4521 1.29091 24.2503L24.2528 0.324445C24.3929 0.171521 24.5771 0.0659449 24.7799 0.0223442C24.9827 -0.0212566 25.194 -0.000723495 25.3846 0.0810986C25.5752 0.162921 25.7357 0.301981 25.8437 0.479013C25.9517 0.656046 26.002 0.862286 25.9876 1.06916V7.86656C25.995 8.66235 25.6919 9.42971 25.1427 10.0057L11.4545 24.2503C11.2637 24.4533 11.1574 24.7214 11.1574 25C11.1574 25.2786 11.2637 25.5467 11.4545 25.7497V25.7497Z" fill="#7FBA28"/>
                </svg>
            </div>

            <script src="./public/js/carousel_accueil.js"></script>

        </div>

        <?php endif; ?>

        <section id="presentation">

            <h2>Le Vest'hier itinérant</h2>
            <div class="section_1">
                <div class="texte">
                    <p>L’association est fondée sur les valeurs et principes d’une économie circulaire, 
                        les 3R : Réduire, Réutiliser, Recycler. 
                        Notre objectif étant de trier, récupérer, 
                        valoriser et redonner une seconde vie à l’ensemble 
                        des objets, meubles, jouets, vêtements...
                    </p>
                    <p>Nous favorisons l’économie des ressources grâce à la remise en circulation
                         d’objets et l’allongement de leur durée de vie. Divers ateliers tous public 
                         en lien avec le recyclage, la récup et le zéro déchet sont proposés pour valoriser 
                         les objets récupérés. Ces actions permettent d’animer la thématique réemploi et de la 
                         rendre concrète pour les individus.
                    </p>
                </div>
                <img src="public/img/mascotte.png" alt="Mascotte, une femme portant robe faîte d'objets recyclés" class="mascotte">
            </div>

            <div class="section_2">

                <img id="deco_1_s2" src="public/img/decoration_2.png" alt="" class="decoration">

                <img id="deco_2_s2" src="public/img/decoration_3.png" alt="" class="decoration">

                <img class="image" src="public/img/accueil_1.jpg" alt="">

                <p>Actuellement itinérant en Charente via la mise en place de « Journées seconde Vie », 
                    notre volonté est de s’établir dans un lieu fixe accessible pour tous. Le public pourra y trouver une large gamme 
                    d’articles, une salle réservée aux ateliers récup, des conseils, du lien social et des moments de partage de savoirs. 
                    Nous désirons, au travers de notre recyclerie, nous centrer sur l’humain et l’environnement et tendre vers l’économie sociale et solidaire. 
                    Interagir avec d’autres partenaires et associations a du sens pour aujourd’hui et demain.</p>

                <img class="image" src="public/img/accueil_2.jpg" alt="">

            </div>

        </section>

        <div id="section_rs">

            <div class="iframe">
                <h3>Venez nous retrouvez Rue des Lilas, Châteauneuf-sur-Charente 16120</h3>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d697.9320682163021!2d-0.05390579139275823!3d45.59600693351743!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1ec52a6751fbe502!2zNDXCsDM1JzQ1LjYiTiAwwrAwMycxMC4zIlc!5e0!3m2!1sfr!2sfr!4v1652696153510!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="hello">
                <p>Si vous souhaitez nous soutenir, adhérez à l’association sur :</p>
                <a href="https://www.helloasso.com/associations/le-vest-hier-itinerant/adhesions/bulletin-d-adhesion?fbclid=IwAR2MsPVSHC0uPSfc2DdflwjxXt4UqNYrDf_N2biCmt4qCLCJtO_04UsOC4U">
                    <img class="logo" src="public/img/logo/helloasso.png" alt="">
                </a>
            </div>

            <div class="section_rs">
                <p>Pour suivre l’actualité de l’association au plus près, retrouvez nous sur les réseaux sociaux :</p>
                <div class="img_rs">
                    <a href="https://www.facebook.com/levesthieritinerant">
                        <img class="rs" src="public/img/icone/facebook.svg" alt="Facebook">
                    </a>
                    <a href="https://www.instagram.com/le_vesthier_16000/?hl=fr">
                        <img class="rs" src="public/img/icone/instagram.png" alt="Instagram">
                    </a>
                </div>
            </div>

            <p class="cta_formulaire">Si vous souhaitez nous adresser un message personnel, vous trouverez ci-dessous un formulaire de contact.</p>

        </div>

        <div id="formulaire">

            <p class="info" id="formulaire">Tous les champs sont obligatoires.</p>

            <form action="" method="post">
                <div class="decoration"></div>
                <div class="champs">
                    <div class="gauche">
                        <div class="champ nom">
                            <label for="nom">Nom et prénom, nom d’entreprise/association</label>
                            <input type="text" name="nom" id="nom">
                        </div>

                        <div class="champ email">
                            <label for="email">Adresse mail</label>
                            <input type="email" name="email" id="email">
                        </div>

                        <div class="champ objet">
                            <label for="objet">Objet du message</label>
                            <input type="text" name="objet" id="objet">
                        </div>

                        <div id="cp_ville" class="champ">
                            <div class="champ ville fils">
                                <label for="ville">Ville</label>
                                <input type="text" name="ville" id="ville">
                            </div>
                            <div class="champ cp fils">
                                <label for="cp">Code postal</label>
                                <input type="text" name="cp" id="cp">
                            </div>
                        </div>
                    </div>

                    <div id="form_droite" class="champ message droite">
                        <p for="message">Message</p>
                        <textarea name="message" id="message"></textarea>
                    </div>
                </div>

                <p class="info">En cliquant sur "Envoyer" vous acceptez les <a href="index.php?dest=mentions#donnees">conditions d'utilisation de vos données personnelles</a>.</p>

                <button class="bouton">Envoyer</button>
            </form>

        </div>
    </div>

<?php 
    $page_contenu = ob_get_clean();
    require('view/template.php'); 
?>