<?php
class Tags extends Controller
{
   public $tagModel;
    public $categoryModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->tagModel = $this->model('Tag');
        $this->categoryModel = $this->model('Category'); // Assurez-vous que 'Category' est correctement orthographié
    }

    public function index()
    {
        
        $tags = $this->tagModel->getTags();
        // var_dump($tags);
        
        $data = [
            'tags' => $tags
        ];

        $this->view('tags/index', $data);
        $this->categoryModel = $this->model('Category');
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'tag_name' => trim($_POST['tag_name']),
                'category_id' => $_POST['category_id'], // Changez cela en fonction de la manière dont vous obtenez la catégorie
                'title_err' => ''
            ];

            if (empty($data['tag_name'])) {
                $data['title_err'] = 'Please enter a name';
            }

            if (empty($data['title_err'])) {
                if ($this->tagModel->addTag($data)) {
                    flash('tag_message', 'Tag Added');
                    redirect('tags');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('tags/add', $data);
            }
        } else {
            $data = [
                'tag_name' => '',
                'categories' => $this->categoryModel->getCategories() // Ajoutez cette ligne
            ];

            $this->view('tags/add', $data);
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->tagModel->deleteTag($id)) {
                flash('tag_message', 'Tag Deleted');
                redirect('tags');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('tags');
        }
    }
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $data = [
                'id' => $id,
                'tag_name' => trim($_POST['tag_name']),
                'category_id' => $_SESSION['user_id'],
                'title_err' => ''
            ];
    
            if (empty($data['tag_name'])) {
                $data['title_err'] = 'Please enter a name';
            }
    
            if (empty($data['title_err'])) {
                if ($this->tagModel->updateTag($data)) {
                    flash('tag_message', 'Tag Updated');
                    redirect('tags');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('tags/edit', $data);
            }
        } else {
            $tag = $this->tagModel->getTagById($id);
    
            if (!$tag) {
                redirect('tags');
            }
    
            if ($tag->category_id != $_SESSION['user_id']) {
                redirect('tags');
            }
    
            $data = [
                'id' => $id,
                'tag_name' => $tag->tag_name,
                'title_err' => ''
            ];
    
            $this->view('tags/edit', $data);
        }
    }
}