<?php

class Categories extends Controller
{
    public $categoryModel;
    public $tagModel;
    public $wikiModel;

    public function __construct()
    {
        // if (!isLoggedIn()) {
        //     redirect('users/login');
        // }

        $this->categoryModel = $this->model('Category');
        $this->tagModel = $this->model('Tag');
        $this->wikiModel = $this->model('Wiki'); // Assurez-vous que 'Category' est correctement orthographié

    }

    public function index()
    {
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
       

        // $this->view('category/index', $data);
        $this->view('dashboard/dashboard', $data);
    }

    public function index2()
    {
        $categories = $this->categoryModel->getCategories();
        $totalCategories = $this->categoryModel->getTotalCategories();
        $data = [
            'categories' => $categories,
            'totalCategories' => $totalCategories,
        ];
       

         $this->view('category/index', $data);
        
    }


    public function index3()
    {
        $categories = $this->categoryModel->getCategories();
       
        $data = [
            'categories' => $categories,
            
        ];
       

         $this->view('category/showCategories', $data);
        
    }






    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'category_name' => trim($_POST['category_name']),
                'category_id' => $_SESSION['user_id'], 
                'category_name_err' => ''
            ];

            if (empty($data['category_name'])) {
                $data['category_name_err'] = 'Please enter a category name';
            }

            if (empty($data['category_name_err'])) {
                if ($this->categoryModel->addCategory($data)) {
                    flash('category_message', 'Category Added');
                    redirect('categories/index2');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('category/add', $data);
            }
        } else {
            $data = [
                'category_name' => ''
            ];

            $this->view('category/add', $data);
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->categoryModel->deleteCategory($id)) {
                flash('category_message', 'Category Deleted');
                redirect('categories');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('categories');
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                'category_name' => trim($_POST['category_name']),
                'category_name_err' => ''
            ];

            if (empty($data['category_name'])) {
                $data['category_name_err'] = 'Please enter a category name';
            }

            if (empty($data['category_name_err'])) {
                if ($this->categoryModel->updateCategory($data)) {
                    flash('category_message', 'Category Updated');
                    redirect('categories/index2');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('category/edit', $data);
            }
        } else {
            $category = $this->categoryModel->getCategoryById($id);

            if (!$category) {
                redirect('categories');
            }

            if ($category->category_id != $_SESSION['user_id']) {
                redirect('categories');
            }

            $data = [
                'id' => $id,
                'category_name' => $category->category_name
            ];

            $this->view('category/edit', $data);
        }
    }
}