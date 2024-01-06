<?php
class Projets extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->projetModel = $this->model('Projet');
    }

    public function index()
    {
        $projets = $this->projetModel->getProjets();

        $data = [
            'projets' => $projets
        ];

        $this->view('projets/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'nom_projet' => trim($_POST['nom_projet']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => ''
            ];

            if (empty($data['nom_projet'])) {
                $data['title_err'] = 'Please enter a name';
            }

            if (empty($data['title_err'])) {
                if ($this->projetModel->addProjets($data)) {
                    flash('projet_message', 'Projet Added');
                    redirect('projets');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('projets/add', $data);
            }
        } else {
            $data = [
                'nom_projet' => ''
            ];

            $this->view('projets/add', $data);
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->projetModel->deleteProjet($id)) {
                flash('projet_message', 'Projet Deleted');
                redirect('projets');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('projets');
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                'nom_projet' => trim($_POST['nom_projet']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => ''
            ];

            if (empty($data['nom_projet'])) {
                $data['title_err'] = 'Please enter a name';
            }

            if (empty($data['title_err'])) {
                if ($this->projetModel->updateProjet($data)) {
                    flash('projet_message', 'Projet Updated');
                    redirect('projets');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('projets/edit', $data);
            }
        } else {
            $projet = $this->projetModel->getProjetById($id);

            if (!$projet) {
                redirect('projets');
            }

            if ($projet->user_id != $_SESSION['user_id']) {
                redirect('projets');
            }

            $data = [
                'id' => $id,
                'nom_projet' => $projet->nom_projet
            ];

            $this->view('projets/edit', $data);
        }
    }

   
}
