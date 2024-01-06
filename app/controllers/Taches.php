<?php
class Taches extends Controller
{
    private $tacheModel;
    private $projetModel;

    public function __construct()
    {
        $this->tacheModel = $this->model('Tache');
        $this->projetModel = $this->model('Projet');
    }

    public function index()
    {
        $user_id = $_SESSION['user_id'];
        $taches = $this->tacheModel->getTachesByUserId($user_id);

        $data = [
            'taches' => $taches
        ];

        $this->view('taches/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            // Check if the required keys are set in the $_POST array
            $nomTache = isset($_POST['Nom_Tache']) ? trim($_POST['Nom_Tache']) : '';
            $dateDebut = isset($_POST['Date_debut']) ? trim($_POST['Date_debut']) : '';
            $dateFin = isset($_POST['Date_fin']) ? trim($_POST['Date_fin']) : '';
            $projectID = isset($_POST['Project_ID']) ? $_POST['Project_ID'] : '';
    
            $projets = $this->projetModel->getProjets();
    
            $data = [
                'Nom_Tache' => $nomTache,
                'date_debut' => $dateDebut,
                'date_fin' => $dateFin,
                'user_id' => $_SESSION['user_id'],
                'Nom_Tache_err' => '',
                'date_debut_err' => '',
                'date_fin_err' => '',
                'project_err' => '',
                'projets' => $projets
            ];
    
            if (empty($data['Nom_Tache'])) {
                $data['Nom_Tache_err'] = 'Please enter a task name';
            }
    
            if (empty($data['date_debut'])) {
                $data['date_debut_err'] = 'Please enter a start date';
            }
    
            if (empty($data['date_fin'])) {
                $data['date_fin_err'] = 'Please enter an end date';
            }
    
            if (empty($projectID)) {
                $data['project_err'] = 'Please select a project';
            }
    
            if (empty($data['Nom_Tache_err']) && empty($data['date_debut_err']) && empty($data['date_fin_err']) && empty($data['project_err'])) {
                $tacheData = [
                    'Nom_Tache' => $data['Nom_Tache'],
                    'date_debut' => $data['date_debut'],
                    'date_fin' => $data['date_fin'],
                    'user_id' => $data['user_id'],
                    'Project_ID' => $projectID
                ];
    
                if ($this->tacheModel->addTaches($tacheData)) {
                    flash('tache_message', 'Task Added');
                    redirect('taches');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('taches/add', $data);
            }
        } else {
            // Clear validation errors when loading the add page initially
            unset($_SESSION['Nom_Tache_err']);
            unset($_SESSION['date_debut_err']);
            unset($_SESSION['date_fin_err']);
            unset($_SESSION['project_err']);
    
            $data = [
                'Nom_Tache' => '',
                'date_debut' => '',
                'date_fin' => '',
                'projets' => $this->projetModel->getProjets()
            ];
    
            $this->view('taches/add', $data);
        }
    }
    
    
    
    public function changeStatus($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newStatus = $_POST['new_status'];

            if ($this->tacheModel->updateStatus($id, $newStatus)) {
                flash('tache_message', 'Statut de la tâche mis à jour');
                redirect('taches');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('taches');
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->tacheModel->deleteTache($id)) {
                flash('tache_message', 'Task Deleted');
                redirect('taches');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('taches');
        }
    }

    public function search()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $user_id = $_SESSION['user_id'];
        $search_query = trim($_POST['search_query']);

        $taches = $this->tacheModel->searchTaches($user_id, $search_query);

        $data = [
            'taches' => $taches,
        ];

        $this->view('taches/index', $data);
    } else {
        redirect('taches');
    }
}

public function edit($id)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'id' => $id,
            'Nom_Tache' => trim($_POST['Nom_Tache']),
            'date_debut' => trim($_POST['Date_debut']),
            'date_fin' => trim($_POST['Date_fin']),
            'user_id' => $_SESSION['user_id'],
            'Nom_Tache_err' => '',
            'date_debut_err' => '',
            'date_fin_err' => ''
        ];

        if (empty($data['Nom_Tache'])) {
            $data['Nom_Tache_err'] = 'Please enter a task name';
        }

        if (empty($data['date_debut'])) {
            $data['date_debut_err'] = 'Please enter a start date';
        }

        if (empty($data['date_fin'])) {
            $data['date_fin_err'] = 'Please enter an end date';
        }

        if (empty($data['Nom_Tache_err']) && empty($data['date_debut_err']) && empty($data['date_fin_err'])) {
            if ($this->tacheModel->updateTache($data)) {
                flash('tache_message', 'Task Updated');
                redirect('taches');
            } else {
                die('Something went wrong');
            }
        } else {
            $this->view('taches/edit', $data);
        }
    } else {
        $tache = $this->tacheModel->getTacheById($id);

        if (!$tache) {
            redirect('taches');
        }

        if ($tache->user_id != $_SESSION['user_id']) {
            redirect('taches');
        }

        $data = [
            'id' => $id,
            'Nom_Tache' => $tache->Nome_Tache ?? '',
            'date_debut' => $tache->Date_debut ?? '',
            'date_fin' => $tache->Date_fin ?? ''
        ];

        $this->view('taches/edit', $data);
    }
}



}
