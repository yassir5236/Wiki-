<?php

class Home extends Controller
{
   

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

    }

    public function index()
    {
        // $this->view('category/index', $data);
        // $this->view('category/index');
        // redirect('Categories');

        echo "HELLO VISITER you are in the home page";
    }
}