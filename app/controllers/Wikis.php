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

    // public function add()
    // {
    //     $categories = $this->wikiModel->getCategories();
    //     $tags = $this->wikiModel->getTags();

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         // Sanitize and validate input
    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    //         $data = [
    //             'title' => trim($_POST['title']),
    //             'content' => trim($_POST['content']),
    //             'category_id' => $_POST['category_id'],
    //             'tags' => $_POST['tags'],
    //             'categories' => $categories,
    //             // 'tags' => $tags,
    //         ];

    //         // Call the model method to add the wiki with category and tags
    //         if ($this->wikiModel->addWikiWithCategoryAndTags($data)) {
    //             // Redirect or show success message
    //             flash('wiki_message', 'Wiki Added');
    //             redirect('wikis/index2');
    //         } else {
    //             die('Something went wrong');
    //         }
    //     } else {
    //         // Display the form
    //         $data = [
    //             'categories' => $categories,
    //             'tags' => $tags,
    //         ];
    //         $this->view('wikis/add', $data);
    //     }
    // }




    public function add()
    {
        // var_dump($_SESSION['user_id']);
        
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize and validate input
            $title = htmlspecialchars(trim($_POST['title']));
            $content = htmlspecialchars(trim($_POST['content']));
            $category_id = $_POST['category_id'];
            $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

            // Assurez-vous que $_POST['tags'] existe et est une chaîne avant d'utiliser explode
            $tags = isset($_POST['tags']) ? (is_array($_POST['tags']) ? $_POST['tags'] : explode(',', $_POST['tags'])) : [];


            // Traiter les données du formulaire (ex: enregistrer dans la base de données)...
            $data = [
                'title' => $title,
                'content' => $content,
                'category_id' => $category_id,
                'author_id'=> $user_id,
                'tags' => $tags,
            ];

            if ($this->wikiModel->addWiki($data)) {
                flash('wiki_message', 'Wiki ajouté avec succès');
                redirect('wikis/index2');
            } else {
                die('Quelque chose s\'est mal passé');
            }
        }

        // Charger la vue avec les données nécessaires (y compris la liste des tags)
        $wikis = $this->wikiModel->getWikis();

        // Initialize CategoryModel before using it
        $this->categoryModel = $this->model('Category');
        $categories = $this->categoryModel->getCategories();

        $this->tagModel = $this->model('tag');

        $categoryTags = [];
        foreach ($categories as $category) {
            $tags = $this->tagModel->getTagsByCategory($category->category_id);
            $categoryTags[$category->category_id] = $tags;
        }

        $data = [
            'categories' => $categories,
            'tagsList' => $this->wikiModel->getTags(), // Assuming you want to get tags from wikiModel
            'categoryTags' => $categoryTags,
            'wikis' => $wikis,
        ];

        $this->view('wikis/add', $data);
        echo "<script> console.log(" . json_encode($data) . ")</script>";
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
                redirect('wikis/index2');
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
                redirect('wikis/index2');
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