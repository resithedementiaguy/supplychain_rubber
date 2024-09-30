<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('backend/partials/header');
        $this->load->view('backend/profile/view');
        $this->load->view('backend/partials/footer');
    }
}
