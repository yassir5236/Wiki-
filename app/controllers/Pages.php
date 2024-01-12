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



    public function dashboard()
    {
        $this->view('dashboard/dashboard');
    }

  

  }