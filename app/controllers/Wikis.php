<?php

class Wikis extends Controller
{
    public $wikiModel;
    public $categoryModel;
    public $tagModel;
    public $totalWikis;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->wikiModel = $this->model('Wiki');
        $this->tagModel = $this->model('Tag');
        $this->categoryModel = $this->model('Category');
        
    }

    public function index() {
        $categories = $this->categoryModel->getCategories();
        $totalCategories = $this->categoryModel->getTotalCategories();
        $totalTags =  $this->tagModel->getTotalTags();
        $totalWikis = $this->wikiModel->getTotalWikisCount();

        $data = [
            'categories' => $categories,
            'totalCategories' => $totalCategories,
            'totalTags'=> $totalTags,
            'totalWikis' => $totalWikis,

        ];
       
        
        $this->view('dashboard/dashboard', $data);

    }

    public function index2(){
     
        $wikis = $this->wikiModel->getWikis();
        $data = [
            'wikis' => $wikis,
        ];
       

        // $this->view('category/index', $data);
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
                redirect('wikis/index2');
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



    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Call the model method to delete the wiki
            if ($this->wikiModel->deleteWiki($id)) {
                flash('wiki_message', 'Wiki Deleted');
                redirect('wikis');
            } else {
                die('Something went wrong');
            }
        } else {
            // Display confirmation form
            $wiki = $this->wikiModel->getWikiById($id);

            if (!$wiki) {
                flash('wiki_message', 'Wiki not found', 'alert alert-danger');
                redirect('wikis');
            }

            $data = [
                'wiki' => $wiki,
            ];

            $this->view('wikis/delete', $data); // Create a view for confirmation if needed
        }
    }



    public function statistics()
    {
        $totalWikis = $this->wikiModel->getTotalWikisCount();

        $data = [
            'totalWikis' => $totalWikis,
        ];

        $this->view('dashboard/dashboard', $data);

    }


    public function archive($id)
    {
        if ($this->wikiModel->archiveWiki($id)) {
            // Redirect or show success message
            flash('wiki_message', 'Wiki Archived');
            redirect('wikis/index2');
        } else {
            die('Something went wrong');
        }
    }
}