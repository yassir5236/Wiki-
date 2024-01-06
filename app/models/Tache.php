
<?php
class Tache {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getTachesByUserId($userId) {
        $this->db->query('SELECT t.*, p.nom_projet AS nom_projet, t.Nome_Tache, t.statut FROM taches t 
        INNER JOIN projets p ON t.Project_ID = p.id_Project 
        WHERE t.User_Id = :user_id AND t.Project_ID = p.id_Project');

        $this->db->bind(':user_id', $userId);

        $results = $this->db->resultSet();

        return $results;
    }



    public function addTaches($data)
    {
        $this->db->query('INSERT INTO taches (Nome_Tache, Date_debut, Date_fin, user_id, Project_ID) VALUES (:Nom_Tache, :Date_debut, :Date_fin, :user_id, :Project_ID)');
        $this->db->bind(':Nom_Tache', $data['Nom_Tache']);
        $this->db->bind(':Date_debut', $data['date_debut']);
        $this->db->bind(':Date_fin', $data['date_fin']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':Project_ID', $data['Project_ID']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateTache($data) {
        $this->db->query('UPDATE taches SET Nome_Tache = :nome_tache, Date_debut = :date_debut, Date_fin = :date_fin, statut = :statut, Project_ID = :project_id WHERE id_tache = :tache_id');
        $this->db->bind(':tache_id', $data['tache_id']);
        $this->db->bind(':nome_tache', $data['nome_tache']);
        $this->db->bind(':date_debut', $data['date_debut']);
        $this->db->bind(':date_fin', $data['date_fin']);
        $this->db->bind(':statut', $data['statut']);
        $this->db->bind(':project_id', $data['project_id']);

        return $this->db->execute();
    }

    public function deleteTache($id)
    {
        $this->db->query('DELETE FROM taches WHERE id_tache = :tache_id');
        $this->db->bind(':tache_id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateStatus($id, $newStatus)
    {
        $this->db->query('UPDATE taches SET statut = :new_status WHERE id_tache = :tache_id');
        $this->db->bind(':new_status', $newStatus);
        $this->db->bind(':tache_id', $id);

        return $this->db->execute();
    }

    public function searchTaches($userId, $searchQuery)
{
    $this->db->query('SELECT t.*, p.nom_projet AS nom_projet, t.Nome_Tache, t.statut 
                      FROM taches t 
                      INNER JOIN projets p ON t.Project_ID = p.id_Project 
                      WHERE t.User_Id = :user_id 
                      AND t.Project_ID = p.id_Project 
                      AND t.Nome_Tache LIKE :search_query');

    $this->db->bind(':user_id', $userId);
    $this->db->bind(':search_query', '%' . $searchQuery . '%');

    $results = $this->db->resultSet();

    return $results;
}

}
?>
