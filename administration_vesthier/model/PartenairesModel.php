<?php

namespace Vesthier\model;

class PartenairesModel extends Model
{
    public function readPartenaires(int $id = NULL)
    {
        $sql = 'SELECT *
        FROM partenaires';

        if($id != NULL && $id > 0){

            $sql .= ' WHERE partenaires.id = :id';
            $q = $this->_bdd->prepare($sql);
            $q->bindParam('id', $id);
            $q->execute();
            return $q->fetch(\PDO::FETCH_ASSOC);
        }

        $q = $this->_bdd->prepare($sql);
        $q->execute();
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createPartenaire(string $nom, string $lien, string $url_logo){

        $sql = 'INSERT INTO partenaires(nom, lien, url_logo)
        VALUE(:nom, :lien, :url_logo)';

        $q = $this->_bdd->prepare($sql);

        $q->bindParam('nom', $nom);
        $q->bindParam('lien', $lien);
        $q->bindParam('url_logo', $url_logo);
        
        return $q->execute();
    }

    public function updatePartenaire(int $id, string $nom, string $lien, string $url_logo = NULL)
    {
        if(!($url_logo === NULL)){
            $sql = 'UPDATE partenaires 
            SET partenaires.nom = :nom, partenaires.lien = :lien, partenaires.url_logo = :url_logo
            WHERE partenaires.id = :id';
        }
        else{
            $sql = 'UPDATE partenaires 
            SET partenaires.nom = :nom, partenaires.lien = :lien
            WHERE partenaires.id = :id';
        }
        

        $q = $this->_bdd->prepare($sql);
        var_dump($sql);
        $q->bindParam('id', $id);
        $q->bindParam('nom', $nom);
        $q->bindParam('lien', $lien);

        if(!($url_logo === NULL)) $q->bindParam('url_logo', $url_logo);

        return $q->execute();
    }

    public function deletePartenaire(int $id)
    {
        $sql = 'DELETE
        FROM partenaires
        WHERE partenaires.id = :id';

        $q = $this->_bdd->prepare($sql);
        $q->bindParam('id', $id);

        return $q->execute();
    }
}