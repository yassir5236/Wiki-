<?php

class Categories extends Controller
{
    public $categoryModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->categoryModel = $this->model('Category');
    }

    public function index()
    {
        $categories = $this->categoryModel->getCategories();
        $data = [
            'categories' => $categories
        ];
        $this->view('category/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'category_name' => trim($_POST['category_name']),
                'category_id' => $_SESSION['user_id'], // Replace this with the appropriate category_id
                'category_name_err' => ''
            ];

            if (empty($data['category_name'])) {
                $data['category_name_err'] = 'Please enter a category name';
            }

            if (empty($data['category_name_err'])) {
                if ($this->categoryModel->addCategory($data)) {
                    flash('category_message', 'Category Added');
                    redirect('categories');
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
        if ($_SERVER['REQUEST_METHOD'] == 'post') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                'category_name' => trim($_POST['category_name']),
                'category_id' => $_SESSION['user_id'], // Replace this with the appropriate category_id
                'category_name_err' => ''
            ];

            if (empty($data['category_name'])) {
                $data['category_name_err'] = 'Please enter a category name';
            }

            if (empty($data['category_name_err'])) {
                if ($this->categoryModel->updateCategory($data)) {
                    flash('category_message', 'Category Updated');
                    redirect('categories');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('categories/edit', $data);
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

            $this->view('categories/edit', $data);
        }
    }
}
