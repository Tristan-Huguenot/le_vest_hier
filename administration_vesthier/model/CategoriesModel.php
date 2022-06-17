<?php

namespace Vesthier\model;

class CategoriesModel extends Model
{
    /**
     * Permet de recuperer une ou toutes les catégorie
     * @param int $id identifiant de la catégorie, NULL par default (toutes les catégories)
     * @return array Tableau associatif de la ou des catégorie
     */
    public function readCategories(int $id = NULL)
    {

        $sql = "SELECT * 
        FROM categorie_articles";

        if($id != NULL && $id > 0) $sql .= ' WHERE categorie_articles.id = :id';

        $q = $this->_bdd->prepare($sql);

        if($id != NULL && $id > 0) {
            $q->bindParam('id', $id);
            $q->execute();
            return $q->fetch(\PDO::FETCH_ASSOC);
        }
        $q->execute();
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createCategorie()
    {

        $lipsum = simplexml_load_file('http://www.lipsum.com/feed/xml?amount=3&what=words&start=0')->lipsum;

        $slug = Model::slugify($lipsum);

        $sql = 'INSERT INTO categorie_articles(nom, slug) 
        VALUE(:lipsum, :slug)';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('lipsum', $lipsum);
        $q->bindParam('slug', $slug);
        return $q->execute();
    }

    public function updateCategorie(int $id, string $nom)
    {
        $sql = 'UPDATE categorie_articles 
        SET categorie_articles.nom = :nom, categorie_articles.slug = :slug
        WHERE categorie_articles.id = :id';

        $slug = Model::slugify($nom);

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('nom', $nom);
        $q->bindParam('id', $id);
        $q->bindParam('slug', $slug);

        return $q->execute();
    }

    public function deleteCategorie(int $id)
    {

        $sql = 'DELETE 
        FROM categorie_articles 
        WHERE categorie_articles.id = :id';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id', $id);

        return $q->execute();
    }

    /**
     * Permet de recuperer une ou toutes les sous-catégorie
     * @param int $id_categorie identifiant de la catégorie a laquelle les sous-catégorie sont liées.
     * @param int $id identifiant de la sous-catégorie, NULL par default (toutes les sous-catégories)
     * @return array Tableau associatif de la ou des sous-catégorie d'un catégorie
     */
    public function readSousCategories(int $id_categorie, int $id = NULL)
    {

        $sql = 'SELECT * 
        FROM sous_categorie_articles
        WHERE sous_categorie_articles.categorie_articles_id = :id_categorie';

        if($id != NULL && $id > 0) $sql .= ' AND sous_categorie_articles.id = :id';
        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id_categorie', $id_categorie);

        if($id != NULL && $id > 0) {
            $q->bindParam('id', $id);
            $q->execute();
            return $q->fetch(\PDO::FETCH_ASSOC);
        }
        $q->execute();
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createSousCategorie(int $id_categorie)
    {

        $lipsum = simplexml_load_file('http://www.lipsum.com/feed/xml?amount=3&what=words&start=0')->lipsum;

        $slug = Model::slugify($lipsum);

        $sql = 'INSERT INTO sous_categorie_articles(nom, categorie_articles_id, slug) 
        VALUE(:ipsum, :id_categorie, :slug) ';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('ipsum', $lipsum);
        $q->bindParam('id_categorie', $id_categorie);
        $q->bindParam('slug', $slug);
        return $q->execute();
    }

    public function updateSousCategorie(int $id, string $nom)
    {
        $sql = 'UPDATE sous_categorie_articles 
        SET sous_categorie_articles.nom = :nom, sous_categorie_articles.slug = :slug
        WHERE sous_categorie_articles.id = :id';

        $slug = Model::slugify($nom);

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('nom', $nom);
        $q->bindParam('id', $id);
        $q->bindParam('slug', $slug);

        return $q->execute();
    }

    public function deleteSousCategorie(int $id)
    {

        $sql = 'DELETE 
        FROM sous_categorie_articles 
        WHERE sous_categorie_articles.id = :id';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id', $id);

        return $q->execute();
    }
}