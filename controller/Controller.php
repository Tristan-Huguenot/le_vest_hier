<?php

use Vesthier\model\{CategoriesModel, PartenairesModel, Model, BlogModel, EvenementsModel};
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'administration_vesthier/PHPMailer-master/src/Exception.php';
require_once 'administration_vesthier/PHPMailer-master/src/PHPMailer.php';
require_once 'administration_vesthier/PHPMailer-master/src/SMTP.php';

class Controller
{
    public function accueil()
    {
        $evenementsModel = new EvenementsModel;
        
        $quatreProchEv = $evenementsModel->readFourNextEvenements();

        if(isset($_POST['nom'], $_POST['email'], $_POST['objet'], $_POST['ville'], $_POST['cp'], $_POST['message'])){
            if(!empty($_POST['nom']) || !empty($_POST['email']) || !empty($_POST['objet']) || !empty($_POST['ville']) || !empty($_POST['cp']) || !empty($_POST['message'])){

                // Envoie de mail
                /*
                $contenu_mail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns:v="urn:schemas-microsoft-com:vml">
                <head>
                    <meta http-equiv="content-type" content="text/html; charset=utf-8">
                    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
                </head>
                <body bgcolor="#FFFEF9" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
                
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td align="center">
                                Merci d\'avoir contacté le Vest\'hier Itinérant !
                            </td>
                        </tr>
                        <tr height="50px"></tr>
                        <tr>
                            <td align="center">
                                Votre message a bien été transmis, et nous vous répondrons dans les plus brefs délais.
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                </html>';
                $objet = 'Réponse à "' . $_POST['objet'] . '"';

                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPDebug = 0;
                $mail->Debugoutput = 'html';
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth = true;
                $mail->Username = //adresse expeditrice;
                $mail->Password = //Mot de passe;
                $mail->setFrom(EMAIL['sender']);
                $mail->addAddress($_POST['email']);
                $mail->isHTML(true);
                $mail->Subject = $objet;
                $mail->Body = $contenu_mail;
                $mail->AltBody = 'Merci d\'avoir contacté le Vest\'hier Itinérant ! Votre message a bien été transmis et nous vous repondrons dans les plus bref délais.';
                if (!$mail->send()) {
                    $_SESSION['message']['type'] = "warning";
                    $_SESSION['message']['text'] = "Une erreur est survenu, le message n'a pas pu être envoyé";
                    header("Location: index.php#formulaire");
                    exit(0);
                }

                $mailAdmin = new PHPMailer;
                $mailAdmin->isSMTP();
                $mailAdmin->SMTPDebug = 0;
                $mailAdmin->Debugoutput = 'html';
                $mailAdmin->Host = 'smtp.gmail.com';
                $mailAdmin->Port = 587;
                $mailAdmin->SMTPSecure = 'tls';
                $mailAdmin->SMTPAuth = true;
                $mailAdmin->Username = //adresse expeditive;
                $mailAdmin->Password = //mot de passe;
                $mailAdmin->setFrom(EMAIL['sender']);
                $mailAdmin->addAddress(EMAIL['reciever']);
                $mailAdmin->isHTML(true);
                $mailAdmin->Subject = '[Site] ' . $_POST['objet'];

                $contenu_mail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns:v="urn:schemas-microsoft-com:vml">
                <head>
                    <meta http-equiv="content-type" content="text/html; charset=utf-8">
                    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
                </head>
                <body bgcolor="#FFFEF9" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
                
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td align="center">
                                ' . htmlspecialchars($_POST['nom']) . ' vous a envoyé un message.
                            </td>
                        </tr>
                        <tr height="50px"></tr>
                        <tr>
                            <td align="center">
                                ' . htmlspecialchars($_POST['ville']) . ' ' . htmlspecialchars($_POST['cp']) . '
                            </td>
                        </tr>
                        <tr height="50px"></tr>
                        <tr>
                            <td align="center">
                                ' . htmlspecialchars($_POST['email']) . '
                            </td>
                        </tr>
                        <tr height="50px"></tr>
                        <tr>
                            <td align="center">
                                ' . htmlspecialchars($_POST['message']) . '
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                </html>';

                $mailAdmin->Body = $contenu_mail;

                if (!$mailAdmin->send()) {
                    $_SESSION['message']['type'] = "warning";
                    $_SESSION['message']['text'] = "Une erreur est survenu, le message n'a pas pu être envoyé";
                    header("Location: index.php#formulaire");
                    exit(0);
                }
                else{
                    $_SESSION['message']['type'] = "success";
                    $_SESSION['message']['text'] = "Votre message a bien été envoyé.";
                    header("Location: index.php");
                    exit(0);
                }
                */

            }
            else{
                $_SESSION['message']['type'] = "warning";
                $_SESSION['message']['text'] = "Tous les champs doivent être remplis !";
                header("Location: index.php#formulaire");
                exit(0);
            }
        }

        require_once 'view/accueil.php';
    }

    public function article()
    {
        if(!isset($_GET['id']) && $_GET['id'] <= 0){
            header('Location: index.php?dest=blog');
            exit(0);
        }
        
        $CategorieModel = new CategoriesModel;
        $BlogModel = new BlogModel;

        $article = $BlogModel->readArticles($_GET['id']);

        $images_secondaires = $BlogModel->readImagesFromArticle($_GET['id']);

        $sections = $BlogModel->readSectionsFromArticle($_GET['id']);

        if($article['categorie_articles_id']) $categorie = $CategorieModel->readCategories($article['categorie_articles_id'])['nom'];
        if($article['sous_categorie_articles_id']) $sous_categorie = $CategorieModel->readCategories($article['sous_categorie_articles_id'])['nom'];

        require_once 'view/article.php';
    }

    public function blog()
    {
        $CategorieModel = new CategoriesModel;
        $BlogModel = new BlogModel;

        $citation = $BlogModel->readCitation();

        $categories = $CategorieModel->readCategories();

        if(isset($_POST['categorie'], $_POST['ordre_trie'])){
            
            ($_POST['ordre_trie'] != 0 && $_POST['ordre_trie'] != 1)? $_SESSION['ordre_trie'] = 0 : $_SESSION['ordre_trie'] = $_POST['ordre_trie'];
                
            if($_POST['categorie'] > 0){
                if(!empty($CategorieModel->readCategories($_POST['categorie']))){
                    $_SESSION['categorie_trie'] = $_POST['categorie'];
                }
                else{
                    $_SESSION['categorie_trie'] = 0;
                }
            }
            else{
                $_SESSION['categorie_trie'] = 0;
            }
        }
        else{

            if(!isset($_SESSION['categorie_trie'])) $_SESSION['categorie_trie'] = 0;
            if(!isset($_SESSION['ordre_trie'])) $_SESSION['ordre_trie'] = 0;
        }

        $nbr_articles = $BlogModel->countArticles($_SESSION['categorie_trie']);

        $nbr_pages = ceil($nbr_articles / ARBYPAGE);

        if(isset($_GET['page']) && $_GET['page'] > $nbr_pages)
        {
            $_GET['page'] = $nbr_pages;
        }

        if(!isset($_GET['page']) || empty($_GET['page'])){
            $_GET['page'] = 1 ;
        }
        
        $precedant = ($_GET['page'] > 1) ? true : false;
        $suivant = ($_GET['page'] < $nbr_pages) ? true : false;

        $articles_page = $BlogModel->readXNextArticles(($_GET['page'] - 1) * ARBYPAGE, ARBYPAGE, $_SESSION['ordre_trie'], $_SESSION['categorie_trie']);
        require_once 'view/blog.php';
    }

    public function evenement()
    {
        if($_GET['id'] <= 0){
            header('Location: index.php?dest=evenements');
            exit(0);
        }

        $evenementsModel = new EvenementsModel;

        $evenement = $evenementsModel->readEvenements($_GET['id']);

        if(empty($evenement)){
            header('Location: index.php?dest=evenements');
            exit(0);
        }

        require_once 'view/evenement.php';
    }

    public function evenements()
    {

        $evenementsModel = new EvenementsModel;

        $nbr_evenements = $evenementsModel->countEvenements();

        $nbr_pages = ceil($nbr_evenements / EVBYPAGE);

        if(isset($_GET['page']) && $_GET['page'] > $nbr_pages)
        {
            $_GET['page'] = $nbr_pages;
        }

        if(!isset($_GET['page']) || empty($_GET['page'])){
            $_GET['page'] = 1 ;
        }
        
        $precedant = ($_GET['page'] > 1) ? true : false;
        $suivant = ($_GET['page'] < $nbr_pages) ? true : false;

        $evenements_page = $evenementsModel->readXNextEvenements(($_GET['page'] - 1) * EVBYPAGE, EVBYPAGE);

        require_once 'view/evenements.php';
    }

    public function une_recyclerie()
    {
        $modelPartenaires = new PartenairesModel;
        $liste_partenaires = $modelPartenaires->readPartenaires();

        require_once 'view/une_recyclerie.php';
    }

    public function mentions()
    {
        require_once 'view/mentions.php';
    }
}