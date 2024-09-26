<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        } else {
            $this->load->view('auth/login');
        }
    }

    public function login()
    {
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Log the attempt
            log_message('debug', "Attempting login with username: $username");

            $user = $this->Mod_auth->validate_login($username, $password);

            if ($user) {
                $this->session->set_userdata(array(
                    'user_id' => $user['user_id'],
                    'username' => $user['username'],
                    'level_name' => $user['level_name'],
                    'logged_in' => TRUE
                ));

                redirect('dashboard');

                echo json_encode(['status' => 'success', 'username' => $username]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid username or password.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No data provided.']);
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/register');
        } else {
            date_default_timezone_set('Asia/Jakarta');
            $ins_time = date('Y-m-d H:i:s', time());
            $password = $this->input->post('password1');
            $data = [
                'username'          => $this->input->post('username'),
                'password'          => sha1('jksdhf832746aiH{}{()&(*&(*' . MD5($password) . 'HdfevgyDDw{}{}{;;*766&*&*'),
                'nama'              => $this->input->post('nama'),
                'ins_time'          => $ins_time
            ];

            $this->Mod_auth->register($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Well done! your account has been created. Please Login</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        You have been logged out!</div>');
        redirect('auth');
    }
}
