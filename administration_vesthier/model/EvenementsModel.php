<?php

namespace Vesthier\model;

class EvenementsModel extends Model
{
    public function createEvenement(string $titre, string $adresse, string $date_evenement, string $heure_debut, string $heure_fin, string $description_evenement, string $url_image, string $slug)
    {
        $sql = 'INSERT INTO evenements( titre, adresse, date_evenement, heure_debut, heure_fin, description_evenement, url_image, slug_titre)
        VALUEs( :titre, :adresse, :date_evenement, :heure_debut, :heure_fin, :description_evenement, :url_image, :slug_titre)';

        $q = $this->_bdd->prepare($sql);

        $q->bindParam('titre', $titre);
        $q->bindParam('adresse', $adresse);
        $q->bindParam('date_evenement', $date_evenement);
        $q->bindParam('heure_debut', $heure_debut);
        $q->bindParam('heure_fin', $heure_fin);
        $q->bindParam('description_evenement',$description_evenement);
        $q->bindParam('url_image', $url_image);
        $q->bindParam('slug_titre', $slug);

        return $q->execute();
    }
    
    public function dateDiff(int $id)
    {
        $sql = 'SELECT DATEDIFF( NOW() ,date_evenement) AS nbr_jour
        FROM evenements
        WHERE id = :id';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id', $id);
        $q->execute();

        return $q->fetch();
    }

    public function readEvenements(int $id = NULL)
    {
        $sql = 'SELECT id, adresse, titre, DATE_FORMAT(date_evenement, "%d/%m/%Y") as date_evenement, DATE_FORMAT(date_evenement, "%Y-%m-%d") as date_formulaire, heure_debut, heure_fin, description_evenement, url_image, slug_titre
        FROM evenements';

        if($id != NULL && $id > 0){

            $sql .= ' WHERE id = :id';
            $q = $this->_bdd->prepare($sql);
            $q->bindParam('id', $id);
            $q->execute();
            return $q->fetch(\PDO::FETCH_ASSOC);
        }
        $sql .= ' ORDER BY date_evenement';
        $q = $this->_bdd->prepare($sql);
        $q->execute();
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function countEvenements()
    {
        $sql = 'SELECT COUNT(*)
        FROM evenements';

        $q = $this->_bdd->prepare($sql);
        $q->execute();
        return $q->fetchColumn();
    }

    public function readXNextEvenements(int $nbr_page, int $nbr_per_page)
    {
        $sql = 'SELECT url_image, titre, description_evenement, id, DATE_FORMAT(date_evenement, "%w") as jour, DATE_FORMAT(date_evenement, "%d/%m/%Y") as date_entiere
        FROM evenements
        ORDER BY date_evenement LIMIT :nbr_page, :nbr_per_page';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('nbr_page', $nbr_page, \PDO::PARAM_INT);
        $q->bindParam('nbr_per_page', $nbr_per_page, \PDO::PARAM_INT);

        $q->execute();

        return $q->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function readFourNextEvenements()
    {
        $sql = 'SELECT url_image, titre, description_evenement, id, DATE_FORMAT(date_evenement, "%w") as jour, DATE_FORMAT(date_evenement, "%d/%m/%Y") as date_entiere
        FROM evenements
        ORDER BY date_evenement LIMIT 0, 4';

        $q = $this->_bdd->prepare($sql);

        $q->execute();

        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function readLastEvenement()
    {
        $sql = 'SELECT *
        FROM evenements
        ORDER BY date_evenement DESC LIMIT 0, 1';

        $q = $this->_bdd->prepare($sql);

        $q->execute();

        return $q->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateEvenement(int $id, string $titre, string $adresse, string $date_evenement, string $heure_debut, string $heure_fin, string $description_evenement, string $url_image, string $slug)
    {
        $sql = 'UPDATE evenements
        SET titre = :titre, adresse = :adresse, date_evenement = :date_evenement, heure_debut = :heure_debut, heure_fin = :heure_fin, description_evenement = :description_evenement, url_image = :url_image, slug_titre = :slug_titre
        WHERE id = :id';

        $q = $this->_bdd->prepare($sql);

        $q->bindParam('id', $id);
        $q->bindParam('titre', $titre);
        $q->bindParam('adresse', $adresse);
        $q->bindParam('date_evenement', $date_evenement);
        $q->bindParam('heure_debut', $heure_debut);
        $q->bindParam('heure_fin', $heure_fin);
        $q->bindParam('description_evenement',$description_evenement);
        $q->bindParam('url_image', $url_image);
        $q->bindParam('slug_titre', $slug);

        return $q->execute();
    }

    public function deleteEvenements(int $id)
    {
        $sql = 'DELETE
        FROM evenements
        WHERE id = :id';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id', $id);

        return $q->execute();
    }

}