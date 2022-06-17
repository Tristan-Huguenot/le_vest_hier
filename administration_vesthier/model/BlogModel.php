<?php

namespace Vesthier\model;

class BlogModel extends Model
{
    public function readCitation()
    {

        $sql = "SELECT options.valeur
        FROM options
        WHERE options.nom LIKE 'citation'";

        $q = $this->_bdd->prepare($sql);
        $q->execute();
        return $q->fetchColumn();
    }

    public function updateCitation(string $citation)
    {

        $sql = "UPDATE options
        SET valeur = :citation
        WHERE options.nom LIKE 'citation'";

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('citation', $citation);
        return $q->execute();
    }

    public function countImagesSecondaires(int $id)
    {
        $sql = 'SELECT COUNT(*)
        FROM images_secondaires
        WHERE images_secondaires.articles_id = :id';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id', $id);

        return $q->fetch();
    }

    public function createImageSecondaire(int $id, string $url)
    {
        $sql = 'INSERT INTO images_secondaires( articles_id, url_image)
        VALUE( :id, :url_image)';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id', $id);
        $q->bindParam('url_image', $url);

        return $q->execute();
    }

    public function readImagesFromArticle(int $id)
    {
        $sql = 'SELECT *
        FROM images_secondaires
        WHERE articles_id = :id';

        $q = $this->_bdd->prepare($sql);

        $q->bindParam('id', $id);
        $q->execute();
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function readImage(int $id)
    {
        $sql = 'SELECT *
        FROM images_secondaires
        WHERE id = :id';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id', $id);
        $q->execute();

        return $q->fetch(\PDO::FETCH_ASSOC);
    }

    public function readImagesArticle(int $id)
    {
        $sql = 'SELECT *
        FROM images_secondaires
        WHERE articles_id = :id';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id', $id);
        $q->execute();

        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateUrlImage(int $id, string $url_image)
    {
        $sql = 'UPDATE images_secondaires
        SET url_image = :url_image
        WHERE id = :id';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id', $id);
        $q->bindParam('url_image', $url_image);

        return $q->execute();
    }

    public function deleteImageArticle(int $id = NULL)
    {
        $sql = 'DELETE
        FROM images_secondaires
        WHERE images_secondaires.id = :id';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id', $id);

        return $q->execute();
    }

    public function deleteAllImageFromArticle(int $id)
    {
        $sql = 'DELETE
        FROM images_secondaires
        WHERE images_secondaires.articles_id = :id';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id', $id);

        return $q->execute();
    }

    public function deleteCategorieFromArticles(int $id)
    {
        $sql = 'UPDATE articles
        SET categorie_articles_id = NULL
        WHERE categorie_articles_id = :id';

        $q = $this->_bdd->prepare($sql);

        $q->bindParam('id', $id);
        return $q->execute();
    }

    public function deleteSousCategorieFromArticles(int $id)
    {
        $sql = 'UPDATE articles
        SET sous_categorie_articles_id = NULL
        WHERE sous_categorie_articles_id = :id';

        $q = $this->_bdd->prepare($sql);

        $q->bindParam('id', $id);
        return $q->execute();
    }

    public function createArticle(string $titre, string $texte_chapeau, string $url_image, string $slug, $categorie, $sousCategorie)
    {

        if($categorie === NULL){
            $sql = 'INSERT INTO articles( titre, texte_chapeau, url_image_principale, slug_titre)
            VALUE( :titre, :texte_chapeau, :url_image, :slug)';

            $q = $this->_bdd->prepare($sql);

            $q->bindParam('titre', $titre);
            $q->bindParam('texte_chapeau', $texte_chapeau);
            $q->bindParam('url_image', $url_image);
            $q->bindParam('slug', $slug);

            return $q->execute();
        }

        if($sousCategorie === NULL){
            $sql = 'INSERT INTO articles( titre, texte_chapeau, url_image_principale, categorie_articles_id, slug_titre)
            VALUE( :titre, :texte_chapeau, :url_image, :categorie, :slug)';

            $q = $this->_bdd->prepare($sql);

            $q->bindParam('titre', $titre);
            $q->bindParam('texte_chapeau', $texte_chapeau);
            $q->bindParam('url_image', $url_image);
            $q->bindParam('categorie', $categorie);
            $q->bindParam('slug', $slug);

            return $q->execute();
        }

        $sql = 'INSERT INTO articles( titre, texte_chapeau, url_image_principale, categorie_articles_id, sous_categorie_articles_id, slug_titre)
        VALUE( :titre, :texte_chapeau, :url_image, :categorie, :sousCategorie, :slug)';

        $q = $this->_bdd->prepare($sql);

        $q->bindParam('titre', $titre);
        $q->bindParam('texte_chapeau', $texte_chapeau);
        $q->bindParam('url_image', $url_image);
        $q->bindParam('categorie', $categorie);
        $q->bindParam('sousCategorie', $sousCategorie);
        $q->bindParam('slug', $slug);
        
        return $q->execute();
    }

    public function readLastArticle()
    {
        $sql = 'SELECT *
        FROM articles
        ORDER BY date_upload DESC LIMIT 0, 1';

        $q = $this->_bdd->prepare($sql);

        $q->execute();

        return $q->fetch(\PDO::FETCH_ASSOC);
    }

    public function readArticles(int $id = NULL)
    {
        $sql = 'SELECT articles.titre, articles.texte_chapeau, articles.id, articles.url_image_principale, articles.slug_titre, articles.categorie_articles_id, articles.sous_categorie_articles_id, DATE_FORMAT(articles.date_upload, "Le %d/%m à %Hh%i") as date_upload
        FROM articles';

        if($id != NULL && $id > 0){

            $sql .= ' WHERE articles.id = :id';
            $q = $this->_bdd->prepare($sql);
            $q->bindParam('id', $id);
            $q->execute();
            return $q->fetch(\PDO::FETCH_ASSOC);
        }
        $sql .= ' ORDER BY articles.date_upload DESC';
        $q = $this->_bdd->prepare($sql);
        $q->execute();
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function countArticles(int $categorie)
    {
        $sql = 'SELECT COUNT(*)
        FROM articles';

        if($categorie) $sql .= ' WHERE categorie_articles_id = :id';

        $q = $this->_bdd->prepare($sql);

        if($categorie) $q->bindParam('id', $categorie);

        $q->execute();
        return $q->fetchColumn();
    }

    public function readXNextArticles(int $nbr_page, int $nbr_per_page, int $order, int $categorie)
    {

        switch($order){
            case '0':
                $order_str = 'date_upload DESC';
                break;
            case '1':
                $order_str = 'date_upload';
                break;
            default:
                $order_str = 'date_upload';
                break;     
        }
        if($categorie){
            $where_str = ' WHERE categorie_articles_id = :id ';
        }
        else $where_str = '';

        $sql = 'SELECT *
        FROM articles' . $where_str . '
        ORDER BY ' . $order_str . ' LIMIT :nbr_page, :nbr_per_page';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('nbr_page', $nbr_page, \PDO::PARAM_INT);
        $q->bindParam('nbr_per_page', $nbr_per_page, \PDO::PARAM_INT);
        if($categorie) $q->bindParam('id', $categorie);
        $q->execute();

        return $q->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function updateArticle(int $id, string $titre, string $texte_chapeau, string $slug, $categorie, $sousCategorie)
    {
        $sql = 'UPDATE articles
        SET articles.titre = :titre, articles.texte_chapeau = :texte_chapeau, articles.slug_titre = :slug, articles.categorie_articles_id = :categorie, articles.sous_categorie_articles_id = :sousCategorie
        WHERE articles.id = :id';

        $q = $this->_bdd->prepare($sql);

        $q->bindParam('id', $id);
        $q->bindParam('titre', $titre);
        $q->bindParam('texte_chapeau', $texte_chapeau);
        $q->bindParam('slug', $slug);
        $q->bindParam('categorie', $categorie);
        $q->bindParam('sousCategorie', $sousCategorie);

        return $q->execute();
    }

    public function updateUrlArticle(int $id, string $url_image)
    {
        $sql = 'UPDATE articles
        SET url_image_principale = :url_image
        WHERE id = :id';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id', $id);
        $q->bindParam('url_image', $url_image);

        return $q->execute();
    }

    public function deleteArticle(int $id)
    {
        $sql = 'DELETE
        FROM articles
        WHERE id = :id';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id', $id);

        return $q->execute();
    }

    public function createSection(int $id, $titre, $description, $url_image, $slug_titre)
    {
        $sql = 'INSERT INTO sections(titre, url_image, texte, articles_id, slug_titre)
        VALUE(:titre, :url_image, :texte, :id, :slug)';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('titre', $titre);
        $q->bindParam('url_image', $url_image);
        $q->bindParam('texte', $description);
        $q->bindParam('id', $id);
        $q->bindParam('slug', $slug_titre);

        return $q->execute();
    }

    public function readSections(int $id = NULL)
    {
        $sql = 'SELECT *
        FROM sections';

        if($id != NULL && $id > 0){

            $sql .= ' WHERE sections.id = :id';
            $q = $this->_bdd->prepare($sql);
            $q->bindParam('id', $id);
            $q->execute();
            return $q->fetch(\PDO::FETCH_ASSOC);
        }

        $q = $this->_bdd->prepare($sql);
        $q->execute();
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function readSectionsFromArticle(int $id)
    {
        $sql = 'SELECT *
        FROM sections
        WHERE articles_id = :id';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id', $id);
        $q->execute();
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function readUrlFromSection(int $id)
    {
        $sql = 'SELECT url_image
        FROM sections
        WHERE id = :id';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id', $id);
        $q->execute();

        return $q->fetchColumn();
    }

    public function updateSection(int $id, $titre, $description, $url_image, $slug_titre)
    {
        $sql = 'UPDATE sections
        SET titre = :titre, texte = :texte, url_image = :url_image, slug_titre = :slug
        WHERE id = :id';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id', $id);
        $q->bindParam('titre', $titre);
        $q->bindParam('texte', $description);
        $q->bindParam('url_image', $url_image);
        $q->bindParam('slug', $slug_titre);

        return $q->execute();
    }

    public function updateUrlSection(int $id, string $url_image)
    {
        $sql = 'UPDATE sections
        SET url_image = :url_image
        WHERE id = :id';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id', $id);
        $q->bindParam('url_image', $url_image);

        return $q->execute();
    }

    public function deleteSection(int $id)
    {
        $sql = 'DELETE
        FROM sections
        WHERE id = :id';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id', $id);

        $q->execute();
    }

    public function deleteSectionsFromArticle(int $id)
    {
        $sql = 'DELETE
        FROM sections
        WHERE articles_id = :id';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id', $id);

        $q->execute();
    }
}