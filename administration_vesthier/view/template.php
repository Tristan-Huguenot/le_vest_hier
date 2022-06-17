<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?= $page_titre ?> - Le Vest'hier itinérant</title>

        <link rel="shortcut icon" href="../public/img/icone/accueil.svg" type="image/x-icon">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
        <link rel="stylesheet" href="public/css/style.css">
    </head>
<body>
    
    <header>
        <a class="lien" href="../index.php">Le vest'hier itinérant</a>

        <nav>

            <h1>Gestion du site</h1>

            <ul>
                <li>
                    <a class="lien" href="index.php">Accueil</a>
                </li>
                <li>
                    <a class="lien" href="index.php?dest=evenements">Évenements</a>
                </li>
                <li>
                    <a class="lien" href="index.php?dest=blog">Blog</a>
                    <ul>
                        <li>
                            <a class="lien" href="index.php?dest=categories">Catégories</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="lien" href="index.php?dest=partenaires">Partenaires</a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        
        
        <?php if(isset($_SESSION['message'])): ?>

        <div id="session_message" class='<?= $_SESSION['message']['type'] ?>'> <?= $_SESSION['message']['text'] ?> </div>

        <?php 
        endif; 
        unset($_SESSION['message']);
        ?>

        <script src="public/js/session_message.js"></script>

        <?= $page_contenu ?>

    </main>

</body>
</html>