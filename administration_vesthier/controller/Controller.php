<?php

use Vesthier\model\{CategoriesModel, PartenairesModel, Model, BlogModel, EvenementsModel};

class Controller
{
    public function accueil()
    {
        $evenementsModel = new EvenementsModel;
        $blogModel = new BlogModel;

        $lastArticle = $blogModel->readLastArticle();
        $lastEvenement = $evenementsModel->readLastEvenement();
        require_once 'view/accueil.php';
    }
    public function evenements()
    {
        $evenementsModel = new EvenementsModel;

        $listeEvenements = $evenementsModel->readEvenements();

        if(isset($_GET['action'])){

            switch($_GET['action']){

                case 'ajouter':

                    if(isset($_POST['titre'], $_POST['adresse'], $_POST['description_evenement'], $_POST['date_evenement'], $_POST['heure_debut'], $_POST['heure_fin'], $_FILES['image_evenement'])){
                        
                        if(!empty($_POST['titre']) && !empty($_POST['adresse']) && !empty($_POST['description_evenement']) && !empty($_POST['date_evenement']) && !empty($_POST['heure_debut']) && !empty($_POST['heure_fin']) && $_FILES['image_evenement']['size'] > 0){

                            if($_FILES['image_evenement']['type'] != 'image/png' && $_FILES['image_evenement']['type'] != 'image/jpg' && $_FILES['image_evenement']['type'] != 'image/jpeg'){
    
                                $_SESSION['message']['text'] = 'Le type du fichier n\'est pas accepté !';
                                $_SESSION['message']['type'] = 'warning';
    
                            }
                            else{

                                $slug = Model::slugify($_POST['titre']);
                                $uploadname = $slug . '_image-evenement' . time();

                                $uploaddir = '/public/img/evenements/';
                                
                                if($_FILES['image_evenement']['type'] === 'image/png') $uploadname .= '.png';
                                if($_FILES['image_evenement']['type'] === 'image/jpeg') $uploadname .= '.jpeg';
                                if($_FILES['image_evenement']['type'] === 'image/jpg') $uploadname .= '.jpg';

                                $uploadfile = '..' . $uploaddir . basename($uploadname);

                                if(move_uploaded_file($_FILES['image_evenement']['tmp_name'], $uploadfile)){
                                    
                                    if($evenementsModel->createEvenement($_POST['titre'], $_POST['adresse'], $_POST['date_evenement'], $_POST['heure_debut'], $_POST['heure_fin'], $_POST['description_evenement'], $uploaddir . basename($uploadname), $slug)){

                                        $_SESSION['message']['text'] = 'L\'évenement a bien été ajouté';
                                        $_SESSION['message']['type'] = 'success';
                                        header('Location: index.php?dest=evenements');
                                        exit(0);
                                    }

                                }
                                else{
                                    $_SESSION['message']['text'] = 'Une erreur est survenu, le fichier n\'as pas pu être téléchargé.';
                                    $_SESSION['message']['type'] = 'warning';
                                }
                            }
                        }
                        else{
                            $_SESSION['message']['text'] = 'Tous les champs doivent être remplis !';
                            $_SESSION['message']['type'] = 'warning';
                        }
                    }

                    require_once 'view/evenements/ajouter.php';
                    break;

                    case 'modifier':

                        if(!isset($_GET['id'])){
                            header('Location: index.php?dest=evenements');
                            exit(0);
                        }
                        else $evenement = $evenementsModel->readEvenements($_GET['id']);

                        if(isset($_POST['titre'], $_POST['adresse'], $_POST['description_evenement'], $_POST['date_evenement'], $_POST['heure_debut'], $_POST['heure_fin'])){
                            
                            if(!empty($_POST['titre']) && !empty($_POST['adresse']) && !empty($_POST['description_evenement']) && !empty($_POST['date_evenement']) && !empty($_POST['heure_debut']) && !empty($_POST['heure_fin'])){
                                
                                if($_FILES['image_evenement']['size'] > 0){

                                    if($_FILES['image_evenement']['type'] != 'image/png' && $_FILES['image_evenement']['type'] != 'image/jpg' && $_FILES['image_evenement']['type'] != 'image/jpeg'){
            
                                        $_SESSION['message']['text'] = 'Le type du fichier n\'est pas accepté !';
                                        $_SESSION['message']['type'] = 'warning';
            
                                    }
                                    else{
        
                                        $slug = Model::slugify($_POST['titre']);
                                        $uploadname = $slug . '_image-evenement' . time();
        
                                        $uploaddir = '/public/img/evenements/';
                                        
                                        if($_FILES['image_evenement']['type'] === 'image/png') $uploadname .= '.png';
                                        if($_FILES['image_evenement']['type'] === 'image/jpeg') $uploadname .= '.jpeg';
                                        if($_FILES['image_evenement']['type'] === 'image/jpg') $uploadname .= '.jpg';
        
                                        $uploadfile = '..' . $uploaddir . basename($uploadname);

                                        $url_image = $uploaddir . basename($uploadname);

                                        if(!move_uploaded_file($_FILES['image_evenement']['tmp_name'], $uploadfile)){

                                            $_SESSION['message']['text'] = 'Une erreur est survenu, le fichier n\'as pas pu être téléchargé.';
                                            $_SESSION['message']['type'] = 'warning';
                                        }
                                        else{
                                            unlink('..' . $evenement['url_image']);
                                        }
                                    }   
                                }
                                else{

                                    $slug = Model::slugify($_POST['titre']);
                                    $uploadname = $slug . '_image-evenement' . time();
        
                                    $uploaddir = '/public/img/evenements/';
                                        
                                    if(Model::str_contains($evenement['url_image'], '.png')) $uploadname .= '.png';
                                    if(Model::str_contains($evenement['url_image'], '.jpeg')) $uploadname .= '.jpeg';
                                    if(Model::str_contains($evenement['url_image'], '.jpg')) $uploadname .= '.jpg';
        
                                    $url_image = $uploaddir . $uploadname;

                                    rename('..' . $evenement['url_image'], '..' . $url_image);
                                }



                                if( $evenementsModel->updateEvenement($_GET['id'], $_POST['titre'], $_POST['adresse'], $_POST['date_evenement'], $_POST['heure_debut'], $_POST['heure_fin'], $_POST['description_evenement'], $url_image, $slug)){
                                    $_SESSION['message']['text'] = 'L\'évenement a bien été modifié.';
                                    $_SESSION['message']['type'] = 'success';
                                    header('Location: index.php?dest=evenements');
                                    exit(0);
                                }
                                
                            }
                            else{
                                $_SESSION['message']['text'] = 'Tous les champs doivent être remplis !';
                                $_SESSION['message']['type'] = 'warning';
                            }
                        }
                        else echo 'bite';
    
                        require_once 'view/evenements/modifier.php';
                        break;
                
                case 'supprimer':

                    $evenement = $evenementsModel->readEvenements($_GET['id']);

                    if(!isset($_GET['id'])){
                        header('Location: index.php?dest=evenements');
                        exit(0);
                    }
                    else{

                        unlink('..' . $evenement['url_image']);
                        $evenementsModel->deleteEvenements($_GET['id']);

                        $_SESSION['message']['text'] = 'L\'évenement a bien été supprimé';
                        $_SESSION['message']['type'] = 'success';
                        header('Location: index.php?dest=evenements');
                    }
                    break;

                default:

                    require_once 'view/evenements/accueil.php';
                    break;
            }
        }
        else require_once 'view/evenements/accueil.php';

    }
    public function blog()
    {

        $blogModel = new BlogModel;
        $categorieModel = new CategoriesModel;

        $citation = $blogModel->readCitation();

        $listeArticles = $blogModel->readArticles();

        $listeCategories = $categorieModel->readCategories();

        if(isset($_GET['action'])){

            switch($_GET['action']){
                
                case 'ajouter':
                    if(isset($_POST['titre'], $_POST['texte_chapeau'], $_POST['categorie'], $_POST['sous_categorie'], $_FILES['image_article'])){

                        if(!empty($_POST['titre']) && !empty($_POST['texte_chapeau']) && $_FILES['image_article']['size'] > 0){

                            $categorie = (empty($_POST['categorie']))? NULL : $_POST['categorie'];
                            $sous_categorie = (empty($_POST['sous_categorie']))? NULL : $_POST['sous_categorie'];

                            if($_FILES['image_article']['type'] != 'image/png' && $_FILES['image_article']['type'] != 'image/jpg' && $_FILES['image_article']['type'] != 'image/jpeg'){
    
                                $_SESSION['message']['text'] = 'Le type du fichier n\'est pas accepté !';
                                $_SESSION['message']['type'] = 'warning';
    
                            }
                            else{

                                $slug = Model::slugify($_POST['titre']);
                                $uploadname = $slug . '_image-principale';
                                if(!is_dir('../public/img/articles/'. $slug)){
                                    mkdir("../public/img/articles/". $slug, 0774, true);
                                }
                                $uploaddir = '/public/img/articles/'. $slug .'/';
                                
                                if($_FILES['image_article']['type'] === 'image/png') $uploadname .= '.png';
                                if($_FILES['image_article']['type'] === 'image/jpeg') $uploadname .= '.jpeg';
                                if($_FILES['image_article']['type'] === 'image/jpg') $uploadname .= '.jpg';

                                $uploadfile = '..' . $uploaddir . basename($uploadname);

                                if(move_uploaded_file($_FILES['image_article']['tmp_name'], $uploadfile)){
                                    
                                    $blogModel->createArticle($_POST['titre'], $_POST['texte_chapeau'], $uploaddir . basename($uploadname), $slug, $categorie, $sous_categorie);

                                    $_SESSION['message']['text'] = 'L\'article a bien été ajouté';
                                    $_SESSION['message']['type'] = 'success';
                                    header('Location: index.php?dest=blog');
                                    exit(0);
                                }
                                
                                $_SESSION['message']['text'] = 'Une erreur est survenu, le fichier n\'as pas pu être téléchargé.';
                                $_SESSION['message']['type'] = 'warning';
                            }
                            
                        }
                        else{
    
                            $_SESSION['message']['text'] = 'Tous les champs ne sont pas remplis !';
                            $_SESSION['message']['type'] = 'warning';
                        }

                    }
                    require_once 'view/blog/ajouter.php';
                    break;

                case 'visionner':

                    if(!isset($_GET['id']) || $_GET['id'] <= 0){
                        header('Location: index.php?dest=blog');
                        exit(0);
                    }

                    $article = $blogModel->readArticles($_GET['id']);
                    $listeImages = $blogModel->readImagesArticle($article['id']);
                    $listeSections = $blogModel->readSections();

                    if(isset($_GET['param'], $_GET['idImage'])){

                        if($_GET['param'] === 'supprimerImage' && $_GET['idImage'] > 0){

                            $image = $blogModel->readImage($_GET['idImage']);

                            unlink('..' . $image['url_image']);

                            $blogModel->deleteImageArticle($_GET['idImage']);

                            $_SESSION['message']['text'] = 'L\'image a bien été supprimmé';
                            $_SESSION['message']['type'] = 'success';

                            header('Location: index.php?dest=blog&action=visionner&id='. $article['id']);
                            exit(0);
                        }

                    }

                    if(isset($_FILES['image_fin']) && $_FILES['image_fin'] > 0){

                        if($_FILES['image_fin']['type'] != 'image/png' && $_FILES['image_fin']['type'] != 'image/jpg' && $_FILES['image_fin']['type'] != 'image/jpeg'){
    
                            $_SESSION['message']['text'] = 'Le type du fichier n\'est pas accepté !';
                            $_SESSION['message']['type'] = 'warning';

                        }
                        else{

                            $slug = $article['slug_titre'];

                            $uploadname = $slug . '_image-secondaire_' . time();
                            $uploaddir = '/public/img/articles/'. $slug .'/';
                            
                            if($_FILES['image_fin']['type'] === 'image/png') $uploadname .= '.png';
                            if($_FILES['image_fin']['type'] === 'image/jpeg') $uploadname .= '.jpeg';
                            if($_FILES['image_fin']['type'] === 'image/jpg') $uploadname .= '.jpg';

                            $uploadfile = '..' . $uploaddir . basename($uploadname);

                            if(move_uploaded_file($_FILES['image_fin']['tmp_name'], $uploadfile)){
                                
                                $blogModel->createImageSecondaire($_GET['id'], $uploaddir . basename($uploadname));

                                $_SESSION['message']['text'] = 'L\'image a bien été ajouté';
                                $_SESSION['message']['type'] = 'success';
                                
                                header('Location: index.php?dest=blog&action=visionner&id='. $article['id']);
                                exit(0);
                                
                            }else{
                                $_SESSION['message']['text'] = 'Une erreur est survenu, le fichier n\'as pas pu être téléchargé.';
                                $_SESSION['message']['type'] = 'warning';
                            }
                        }

                    }

                    require_once 'view/blog/visionner.php';
                    break;

                case 'modifier':

                    if(!isset($_GET['id']) || $_GET['id'] <= 0){
                        header('Location: index.php?dest=blog');
                        exit(0);
                    }

                    $article = $blogModel->readArticles($_GET['id']);

                    if(isset($_POST['titre'], $_POST['description'], $_POST['categorie'], $_POST['sous_categorie'], $_FILES['image_article'])){

                        if(!empty($_POST['titre']) && !empty($_POST['description'])){

                            $categorie = (empty($_POST['categorie']))? NULL : $_POST['categorie'];
                            $sous_categorie = (empty($_POST['sous_categorie']))? NULL : $_POST['sous_categorie'];
                            if(!isset($slug)) $slug = Model::slugify($_POST['titre']);
                            if(!is_dir('../public/img/articles/'. $slug)){
                                mkdir("../public/img/articles/". $slug, 0774, true);
                            }

                            if($_FILES['image_article']['size'] > 0){

                                if($_FILES['image_article']['type'] != 'image/png' && $_FILES['image_article']['type'] != 'image/jpg' && $_FILES['image_article']['type'] != 'image/jpeg'){
        
                                    $_SESSION['message']['text'] = 'Le type du fichier n\'est pas accepté !';
                                    $_SESSION['message']['type'] = 'warning';
                                    header('Location: index.php?dest=blog&action=modifier&id=' . $article['id']);
                                    exit(0);
        
                                }
                                else{
                                    
                                    unlink('..' . $article['url_image_principale']);


                                    $uploadname = $slug . '_image-principale';
                                    $uploaddir = '/public/img/articles/'. $slug .'/';
                                    
                                    if($_FILES['image_article']['type'] === 'image/png') $uploadname .= '.png';
                                    if($_FILES['image_article']['type'] === 'image/jpeg') $uploadname .= '.jpeg';
                                    if($_FILES['image_article']['type'] === 'image/jpg') $uploadname .= '.jpg';

                                    $uploadfile = '..' . $uploaddir . basename($uploadname);

                                    if(!move_uploaded_file($_FILES['image_article']['tmp_name'], $uploadfile)){

                                        $_SESSION['message']['text'] = 'Une erreur est survenu, le fichier n\'as pas pu être téléchargé.';
                                        $_SESSION['message']['type'] = 'warning';
                                        header('Location: index.php?dest=blog&action=modifier&id=' . $article['id']);
                                        exit(0);
                                    }
                                    
                                    $blogModel->updateUrlArticle($article['id'], $uploaddir . basename($uploadname));
                                    
                                }
                            }else{
                                $nouveau_chemin = '/public/img/articles/' . $slug . '/' . $slug . '_image-principale' . time();

                                if(Model::str_contains($article['url_image_principale'], '.jpeg')) $nouveau_chemin .= '.jpeg';
                                if(Model::str_contains($article['url_image_principale'], '.jpg')) $nouveau_chemin .= '.jpg';
                                if(Model::str_contains($article['url_image_principale'], '.png')) $nouveau_chemin .= '.png';

                                rename('..' . $article['url_image_principale'], '..' . $nouveau_chemin);

                                $blogModel->updateUrlArticle($article['id'], $nouveau_chemin);
                            }

                            $listeSections = $blogModel->readSectionsFromArticle($article['id']);

                            foreach($listeSections as $section){

                                $nouveau_chemin = '/public/img/articles/' . $slug . '/' . $slug . '_image-section' . time();

                                if(Model::str_contains($section['url_image'], '.jpeg')) $nouveau_chemin .= '.jpeg';
                                if(Model::str_contains($section['url_image'], '.jpg')) $nouveau_chemin .= '.jpg';
                                if(Model::str_contains($section['url_image'], '.png')) $nouveau_chemin .= '.png';

                                rename('..' . $section['url_image'], '..' . $nouveau_chemin);

                                $blogModel->updateUrlSection($section['id'], $nouveau_chemin);
                            }

                            $listeImages = $blogModel->readImagesArticle($article['id']);

                            foreach($listeImages as $image){

                                $nouveau_chemin = '/public/img/articles/' . $slug . '/' . $slug . '_image-secondaire' . time();

                                if(Model::str_contains($image['url_image'], '.jpeg')) $nouveau_chemin .= '.jpeg';
                                if(Model::str_contains($image['url_image'], '.jpg')) $nouveau_chemin .= '.jpg';
                                if(Model::str_contains($image['url_image'], '.png')) $nouveau_chemin .= '.png';

                                rename('..' . $image['url_image'], '..' . $nouveau_chemin);

                                $blogModel->updateUrlImage($image['id'], $nouveau_chemin);
                            }

                            rmdir('../public/img/articles/' . $article['slug_titre']);

                            if($blogModel->updateArticle($article['id'], $_POST['titre'], $_POST['description'], $slug, $categorie, $sous_categorie)){

                                $_SESSION['message']['text'] = 'L\'article à bien été modifié.';
                                $_SESSION['message']['type'] = 'success';
                                header('Location: index.php?dest=blog&action=visionner&id=' . $article['id']);
                                exit(0);
                            }

                        }else{
                            $_SESSION['message']['text'] = 'Le titre et la description doivent être remplis.';
                            $_SESSION['message']['type'] = 'warning';
                        }
                    }

                    require_once 'view/blog/modifier.php';
                    break;
                case 'supprimer':

                    if(isset($_GET['id'])){
                        $liste_images_secondaires = $blogModel->readImagesArticle($_GET['id']);
                        foreach($liste_images_secondaires as $image){
                            if(file_exists('..' . $image['url_image'])) unlink('..' . $image['url_image']);
                        }
                        $blogModel->deleteAllImageFromArticle($_GET['id']);

                        $liste_sections = $blogModel->readSectionsFromArticle($_GET['id']);
                        foreach($liste_sections as $section){
                            if($section['url_image'] != NULL){
                                if(file_exists('..' . $section['url_image'])) unlink('..' . $section['url_image']);
                            }
                        }
                        $blogModel->deleteSectionsFromArticle($_GET['id']);

                        $article = $blogModel->readArticles($_GET['id']);
                        if(file_exists('..' . $article['url_image_principale'])) unlink('..' . $article['url_image_principale']);
                        if(file_exists('../public/img/articles/' . $article['slug_titre'])) rmdir('../public/img/articles/' . $article['slug_titre']);

                        $blogModel->deleteArticle($_GET['id']);

                        $_SESSION['message']['text'] = 'L\'article a bien été suprimmé.';
                        $_SESSION['message']['type'] = 'success';
                    }

                    header('Location: index.php?dest=blog');
                    exit(0);
                    break;
                case 'ajouterSection' :

                    $article = $blogModel->readArticles($_GET['id']);

                    if(!isset($_GET['id']) || empty($_GET['id'])){
                        header('Location: index.php?dest=blog&action=visionner&id=' . $article['id']);
                        exit(0);
                    }

                    if(isset($_POST['titre_section'], $_POST['description_section'], $_FILES['image_section'])){

                        if(empty($_POST['titre_section']) && empty($_POST['description_section']) && $_FILES['image_section']['size'] <= 0){

                            $_SESSION['message']['text'] = 'Au moins un des champs doit être rempli.';
                            $_SESSION['message']['type'] = 'warning';

                        }
                        else{

                            if($_FILES['image_section']['size'] > 0){

                                if($_FILES['image_section']['type'] != 'image/png' && $_FILES['image_section']['type'] != 'image/jpg' && $_FILES['image_section']['type'] != 'image/jpeg'){
    
                                    $_SESSION['message']['text'] = 'Le type du fichier n\'est pas accepté !';
                                    $_SESSION['message']['type'] = 'warning';
                                }
                                else{
                                    $slug = $article['slug_titre'];
        
                                    $uploadname = $slug . '_image-section_' . time();
                                    $uploaddir = '/public/img/articles/'. $slug .'/';
                                    
                                    if($_FILES['image_section']['type'] === 'image/png') $uploadname .= '.png';
                                    if($_FILES['image_section']['type'] === 'image/jpeg') $uploadname .= '.jpeg';
                                    if($_FILES['image_section']['type'] === 'image/jpg') $uploadname .= '.jpg';
        
                                    $uploadfile = '..' . $uploaddir . basename($uploadname);

                                    $url_image = $uploaddir . basename($uploadname);
        
                                    if(!move_uploaded_file($_FILES['image_section']['tmp_name'], $uploadfile)){

                                        $_SESSION['message']['text'] = 'Une erreur est survenu, le fichier n\'as pas pu être téléchargé.';
                                        $_SESSION['message']['type'] = 'warning';
                                        header('Location: index.php?dest=blog&action=visionner&id=' . $article['id']);
                                        exit(0);
                                    }
                                }
                            }
                            else $url_image = NULL;

                            if(empty($_POST['titre_section'])){
                                $titre_section = NULL;
                                $slug_titre = NULL;
                            }
                            else{
                                $titre_section = $_POST['titre_section'];
                                $slug_titre = Model::slugify($titre_section);
                            }
                            (empty($_POST['description_section'])) ? $description_section = NULL : $description_section = $_POST['description_section'];
                            
                            if($blogModel->createSection($article['id'], $titre_section, $description_section, $url_image, $slug_titre)){

                                $_SESSION['message']['text'] = 'La section à bien été ajouté';
                                $_SESSION['message']['type'] = 'success';

                                header('Location: index.php?dest=blog&action=visionner&id=' . $article['id']);
                                exit(0);
                            }
                        }
                    }

                    require_once 'view/blog/sections/ajouter.php';
                    break;

                case 'modifierSection':

                    $article = $blogModel->readArticles($_GET['id']);
                    $section = $blogModel->readSections($_GET['idSection']);

                    if(!isset($_GET['id']) || empty($_GET['id'])){
                        header('Location: index.php?dest=blog&action=visionner&id=' . $article['id']);
                        exit(0);
                    }

                    if(isset($_POST['titre_section'], $_POST['description_section'], $_FILES['image_section'])){
                        if(empty($_POST['titre_section']) && empty($_POST['description_section']) && $_FILES['image_section']['size'] <= 0){

                            $_SESSION['message']['text'] = 'Au moins un des champs doit être rempli.';
                            $_SESSION['message']['type'] = 'warning';

                        }
                        else{

                            if(!$_FILES['image_section']['size'] <= 0){

                                if($_FILES['image_section']['type'] != 'image/png' && $_FILES['image_section']['type'] != 'image/jpg' && $_FILES['image_section']['type'] != 'image/jpeg'){
    
                                    $_SESSION['message']['text'] = 'Le type du fichier n\'est pas accepté !';
                                    $_SESSION['message']['type'] = 'warning';
                                }
                                else{

                                    if(file_exists('..' . $section['url_image'])) unlink('..' . $section['url_image']);

                                    $slug = $article['slug_titre'];
        
                                    $uploadname = $slug . '_image-section_' . time();
                                    $uploaddir = '/public/img/articles/'. $slug .'/';
                                    
                                    if($_FILES['image_section']['type'] === 'image/png') $uploadname .= '.png';
                                    if($_FILES['image_section']['type'] === 'image/jpeg') $uploadname .= '.jpeg';
                                    if($_FILES['image_section']['type'] === 'image/jpg') $uploadname .= '.jpg';
        
                                    $uploadfile = '..' . $uploaddir . basename($uploadname);

                                    $url_image = $uploaddir . basename($uploadname);
        
                                    if(!move_uploaded_file($_FILES['image_section']['tmp_name'], $uploadfile)){

                                        $_SESSION['message']['text'] = 'Une erreur est survenu, le fichier n\'as pas pu être téléchargé.';
                                        $_SESSION['message']['type'] = 'warning';
                                        header('Location: index.php?dest=blog&action=visionner&id=' . $article['id']);
                                        exit(0);
                                    }
                                }
                            }else $url_image = $blogModel->readUrlFromSection($_GET['idSection']);

                            if(empty($_POST['titre_section'])){
                                $titre_section = NULL;
                                $slug_titre = NULL;
                            }
                            else{
                                $titre_section = $_POST['titre_section'];
                                $slug_titre = Model::slugify($titre_section);
                            }

                            (empty($_POST['description_section'])) ? $description_section = NULL : $description_section = $_POST['description_section'];

                            if($blogModel->updateSection($section['id'], $titre_section, $description_section, $url_image, $slug_titre)){

                                $_SESSION['message']['text'] = 'La section à bien été modifié';
                                $_SESSION['message']['type'] = 'success';

                                header('Location: index.php?dest=blog&action=visionner&id=' . $article['id']);
                                exit(0);
                            }
                        }
                    }

                    require_once 'view/blog/sections/modifier.php';
                    break;

                case 'supprimerSection':

                    $section = $blogModel->readSections($_GET['id_section']);
                    var_dump($section);

                    if(file_exists('..' . $section['url_image'])) unlink('..' . $section['url_image']);

                    $blogModel->deleteSection($section['id']);

                    $_SESSION['message']['text'] = 'La section à bien été supprimé';
                    $_SESSION['message']['type'] = 'success';

                    header('Location: index.php?dest=blog&action=visionner&id=' . $_GET['id']);
                    exit(0);

                    break;
                default:
                    
                    require_once 'view/blog/accueil.php';
                    break;
            }
        }
        else{

            if(isset($_POST['citation'])){
                if(!empty($_POST['citation'])){
                    $blogModel->updateCitation($_POST['citation']);
                }
                else{
                    $_SESSION['message']['text'] = 'Le champ \'Citation\' n\'a pas été rempli.';
                    $_SESSION['message']['type'] = 'warning';
                }
                header('Location: index.php?dest=blog');
                exit(0);
            }
            
            require_once 'view/blog/accueil.php';
        }
        
    }

    public function categories()
    {
        $blogModel = new blogModel;
        $categoriesModel = new CategoriesModel;
        $listeCategories = $categoriesModel->readCategories();

        if(isset($_GET['action'])){

            switch($_GET['action']){

                case 'ajouterCategorie':
                    $categoriesModel->createCategorie();
                    header('Location: index.php?dest=categories');
                    exit(0);
                    break;

                case 'deleteCategorie':
                    if(isset($_GET['id_categorie'])){
                        foreach($categoriesModel->readSousCategories($_GET['id_categorie']) as $sousCategorie){
                            $blogModel->deleteSousCategorieFromArticles($sousCategorie['id']);
                            $categoriesModel->deleteSousCategorie($sousCategorie['id']);
                        }
                        $blogModel->deleteCategorieFromArticles($_GET['id_categorie']);
                        $categoriesModel->deleteCategorie($_GET['id_categorie']);
                    }
                    header('Location: index.php?dest=categories');
                    exit(0);
                    break;

                case 'modifierCategorie':
                    if(isset($_POST['nom']) && isset($_GET['id_categorie'])) $categoriesModel->updateCategorie($_GET['id_categorie'], $_POST['nom']);
                    header('Location: index.php?dest=categories');
                    exit(0);
                    break;

                case 'ajouterSousCategorie':
                    if(isset($_GET['id_categorie'])) $categoriesModel->createSousCategorie($_GET['id_categorie']);
                    header('Location: index.php?dest=categories');
                    exit(0); 
                    break;
    
                case 'deleteSousCategorie':
                    if(isset($_GET['id_sous_categorie'])){
                        $blogModel->deleteSousCategorieFromArticles($_GET['id_sous_categorie']);
                         $categoriesModel->deleteSousCategorie($_GET['id_sous_categorie']);
                    }
                    header('Location: index.php?dest=categories');
                    exit(0);
                    break;
    
                case 'modifierSousCategorie':
                    if(isset($_POST['nom']) && isset($_GET['id_sous_categorie'])) $categoriesModel->updateSousCategorie($_GET['id_sous_categorie'], $_POST['nom']);
                    header('Location: index.php?dest=categories');
                    exit(0);
                    break;

                default:
                    break;
            }
        }

        require_once 'view/categories.php';
    }
    public function partenaires()
    {

        $modelPartenaires = new PartenairesModel;
        $liste_partenaires = $modelPartenaires->readPartenaires();

        if(isset($_GET['action'])){
            switch($_GET['action']){
                case 'ajouter':

                    if(isset($_POST['nom_partenaire'], $_POST['lien_partenaire'], $_FILES['logo_partenaire'])){

                        if(!empty($_POST['nom_partenaire']) && !empty($_POST['lien_partenaire']) && $_FILES['logo_partenaire']['size'] > 0){
                            if($_FILES['logo_partenaire']['type'] != 'image/png' && $_FILES['logo_partenaire']['type'] != 'image/jpg' && $_FILES['logo_partenaire']['type'] != 'image/jpeg'){
    
                                $_SESSION['message']['text'] = 'Le type du fichier n\'est pas accepté !';
                                $_SESSION['message']['type'] = 'warning';
    
                            }
                            else{

                                $uploaddir = '/public/img/logo/partenaires/';
                                $uploadname = Model::slugify($_POST['nom_partenaire']);
                                
                                if($_FILES['logo_partenaire']['type'] === 'image/png') $uploadname .= '.png';
                                if($_FILES['logo_partenaire']['type'] === 'image/jpeg') $uploadname .= '.jpeg';
                                if($_FILES['logo_partenaire']['type'] === 'image/jpg') $uploadname .= '.jpg';

                                $uploadfile = '..' . $uploaddir . basename($uploadname);

                                if(move_uploaded_file($_FILES['logo_partenaire']['tmp_name'], $uploadfile)){

                                    $modelPartenaires->createPartenaire($_POST['nom_partenaire'], $_POST['lien_partenaire'], $uploaddir . $uploadname);

                                    $_SESSION['message']['text'] = 'Le partenaire a bien été ajouté';
                                    $_SESSION['message']['type'] = 'success';
                                    header('Location: index.php?dest=partenaires');
                                    exit(0);
                                }
                                
                                $_SESSION['message']['text'] = 'Une erreur est survenu, le fichier n\'as pas pu être téléchargé.';
                                $_SESSION['message']['type'] = 'warning';

                            }
                            
                        }
                        else{
    
                            $_SESSION['message']['text'] = 'Tous les champs ne sont pas remplis !';
                            $_SESSION['message']['type'] = 'warning';
    
                        }

                    }
                    

                    require_once 'view/partenaires/ajouter.php';
                    break;
                case 'modifier':

                    if(isset($_GET['id_partenaire']) && $_GET['id_partenaire'] > 0){

                        $partenaire = $modelPartenaires->readPartenaires($_GET['id_partenaire']);

                        if(isset($_POST['nom_partenaire']) && isset($_POST['lien_partenaire'])){
                            if(!empty($_POST['nom_partenaire']) && !empty($_POST['lien_partenaire'])){

                                if($_FILES['logo_partenaire']['size'] > 0) {

                                    if($_FILES['logo_partenaire']['type'] != 'image/png' && $_FILES['logo_partenaire']['type'] != 'image/jpg' && $_FILES['logo_partenaire']['type'] != 'image/jpeg'){
    
                                        $_SESSION['message']['text'] = 'Le type du fichier n\'est pas accepté !';
                                        $_SESSION['message']['type'] = 'warning';
                                        header('Location: index.php?dest=partenaires');
                                        exit(0);
                                    }
                                    else{
        
                                        $uploaddir = '/public/img/logo/partenaires/';
                                        $uploadname = Model::slugify($_POST['nom_partenaire']);
                                        
                                        if($_FILES['logo_partenaire']['type'] === 'image/png') $uploadname .= '.png';
                                        if($_FILES['logo_partenaire']['type'] === 'image/jpeg') $uploadname .= '.jpeg';
                                        if($_FILES['logo_partenaire']['type'] === 'image/jpg') $uploadname .= '.jpg';
        
                                        $uploadfile = '..' . $uploaddir . basename($uploadname);
        
                                        if(move_uploaded_file($_FILES['logo_partenaire']['tmp_name'], $uploadfile)){

                                            unlink('..' . $partenaire['url_logo']);
        
                                            $modelPartenaires->updatePartenaire($_GET['id_partenaire'], $_POST['nom_partenaire'], $_POST['lien_partenaire'], $uploaddir . $uploadname);

                                            $_SESSION['message']['text'] = 'Le partenaire a bien été modifié';
                                            $_SESSION['message']['type'] = 'success';
                                            header('Location: index.php?dest=partenaires');
                                            exit(0);
                                        }
                                        
                                        $_SESSION['message']['text'] = 'Une erreur est survenu, le fichier n\'as pas pu être téléchargé.';
                                        $_SESSION['message']['type'] = 'warning';
        
                                    }
                                    
                                }
                                else{

                                    $uploaddir = '/public/img/logo/partenaires/';
                                    $uploadname = Model::slugify($_POST['nom_partenaire']);

                                    $nouveau_url = $uploaddir . $uploadname;

                                    $url_image = $modelPartenaires->readPartenaires($_GET['id_partenaire'])['url_logo'];

                                    if(Model::str_contains($url_image, '.jpeg')) $nouveau_url .= '.jpeg';
                                    if(Model::str_contains($url_image, '.jpg')) $nouveau_url .= '.jpg';
                                    if(Model::str_contains($url_image, '.png')) $nouveau_url .= '.png';

                                    rename('..' . $url_image, '..' . $nouveau_url);

                                    $modelPartenaires->updatePartenaire($_GET['id_partenaire'], $_POST['nom_partenaire'], $_POST['lien_partenaire'], $nouveau_url);                                    
                                }
                                
                                header('Location: index.php?dest=partenaires');
                                exit(0);

                            }else{
                                $_SESSION['message']['text'] = 'Un des deux premiers champs, ou les deux sont vide !';
                                $_SESSION['message']['type'] = 'warning';
                            }
                        }
                        
                    }
                    else{
                        header('Location: index.php?dest=partenaires');
                        exit(0);
                    }

                    require_once 'view/partenaires/modifier.php';
                    break;
                   
                case 'supprimer':

                    $partenaire = $modelPartenaires->readPartenaires($_GET['id_partenaire']);

                    if(isset($_GET['id_partenaire']) && $_GET['id_partenaire'] > 0){
                        unlink('..' . $partenaire['url_logo']);
                        $modelPartenaires->deletePartenaire($_GET['id_partenaire']);
                    }

                    $_SESSION['message']['text'] = 'Le partenaire a bien été supprimé';
                    $_SESSION['message']['type'] = 'success';

                    header('Location: index.php?dest=partenaires');
                    exit(0);
                    break;
                    
                default:
                    require_once 'view/partenaires/accueil.php';
                    break;
            }
        }
        else require_once 'view/partenaires/accueil.php';
    }
}