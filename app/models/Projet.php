<?php
class Projet
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getProjets()
    {
        $this->db->query('SELECT *,
                            projets.id_project as projetId,
                            users.id as userId,
                            projets.creation_date as projetCreated,
                            users.created_at as userCreated
                            FROM projets
                            INNER JOIN users
                            ON projets.user_id = users.id
                            ORDER BY projets.creation_date DESC
                            ');

        $results = $this->db->resultSet();

        return $results;
    }

    public function addProjets($data)
    {
        $this->db->query('INSERT INTO projets (nom_projet, user_id) VALUES(:nom_projet, :user_id)');
        $this->db->bind(':nom_projet', $data['nom_projet']);
        $this->db->bind(':user_id', $data['user_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteProjet($id)
    {
        $this->db->query('DELETE FROM projets WHERE id_project = :projet_id');
        $this->db->bind(':projet_id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProjet($data)
    {
        $this->db->query('UPDATE projets SET nom_projet = :nom_projet WHERE id_project = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nom_projet', $data['nom_projet']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getProjetById($id)
    {
        $this->db->query('SELECT * FROM projets WHERE id_project = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }
}
