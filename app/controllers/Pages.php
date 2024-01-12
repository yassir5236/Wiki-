<?php
  class Pages extends Controller {
    public function __construct(){
     
    }
    
    public function index(){
      $wikiModel = $this->model('Wiki');

      $wikis = $wikiModel->getWikis();
      $data = [
          'wikis' => $wikis,
      ];
     

      $this->view('wikis/visiteur', $data);
      
  }

    public function about(){
      $data = [
        'title' => 'About Us',
        'description' => 'App to share posts with other users'
      ];

      $this->view('pages/about', $data);
    }

    public function dashboard()
    {
        $this->view('dashboard/dashboard');
    }

   


  }