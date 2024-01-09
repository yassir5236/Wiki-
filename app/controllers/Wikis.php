<?php

class Wikis extends Controller
{
    public $wikiModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->wikiModel = $this->model('Wiki');
    }

    public function index() {
        $wikis = $this->wikiModel->getWikis();
        $data = [
            'wikis' => $wikis,
        ];
        $this->view('wikis/index', $data);
    }

    public function add()
    {
        $categories = $this->wikiModel->getCategories();
        $tags = $this->wikiModel->getTags();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize and validate input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'category_id' => $_POST['category_id'],
                'tags' => $_POST['tags'],
                'categories' => $categories,
                // 'tags' => $tags,
            ];

            // Call the model method to add the wiki with category and tags
            if ($this->wikiModel->addWikiWithCategoryAndTags($data)) {
                // Redirect or show success message
                flash('wiki_message', 'Wiki Added');
                redirect('wikis');
            } else {
                die('Something went wrong');
            }
        } else {
            // Display the form
            $data = [
                'categories' => $categories,
                'tags' => $tags,
            ];
            $this->view('wikis/add', $data);
        }
    }

    public function edit($id)
    {
        $wiki = $this->wikiModel->getWikiById($id);

        if (!$wiki) {
            flash('wiki_message', 'Wiki not found', 'alert alert-danger');
            redirect('wikis');
        }

        $categories = $this->wikiModel->getCategories();
        $tags = $this->wikiModel->getTags();

        $data = [
            'wiki' => $wiki,
            'categories' => $categories,
            'tags' => $tags,
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize and validate input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'category_id' => $_POST['category_id'],
                'tags' => $_POST['tags'],
                'categories' => $categories,
                // 'tags' => $tags,
            ];

           
            if ($this->wikiModel->updateWiki($data)) {
                
                flash('wiki_message', 'Wiki Updated');
                redirect('wikis');
            } else {
                die('Something went wrong');
            }
        } else {
            $this->view('wikis/edit', $data);
        }
    }
}