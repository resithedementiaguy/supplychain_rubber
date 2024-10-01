<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_home');
        $this->Mod_home->update_umur_web();
    }

    public function index()
    {
        
        $data['umur']=$this->Mod_home->get_umur();
        $this->load->view('frontend/partials/header');
        $this->load->view('frontend/home');
        $this->load->view('frontend/partials/footer', $data);
    }
}
