<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Mod_auth');
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
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // Log the attempt
            log_message('debug', "Attempting login with email: $email");

            $user = $this->Mod_auth->validate_login($email, $password);

            if ($user) {
                $this->session->set_userdata(array(
                    'user_id' => $user['user_id'],
                    'nama' => $user['nama'],
                    'email' => $user['email'],
                    'level_name' => $user['level_name'],
                    'logged_in' => TRUE
                ));

                // Redirect to dashboard
                redirect('dashboard');
                exit; // Make sure no further code is executed
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
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/register');
        } else {
            $password = $this->input->post('password');
            $level = $this->input->post('level'); // Retrieve the level value from the form

            // Data for the user table
            $data_user = [
                'email'     => $this->input->post('email'),
                'password'  => sha1('jksdhf832746aiH{}{()&(*&(*' . MD5($password) . 'HdfevgyDDw{}{}{;;*766&*&*'),
                'nama'      => $this->input->post('nama'),
                'level'     => $level
            ];

            // Insert into user table and get the last inserted ID
            $this->Mod_auth->register($data_user);
            $user_id = $this->db->insert_id(); // Get the ID of the last inserted user

            // Check the level and insert accordingly
            if ($level == 'Pemasok') {
                $data_pemasok = [
                    'id_user'       => $user_id, // Assign user_id to id_user
                    'nama'          => $this->input->post('nama'),
                    'nama_usaha'    => $this->input->post('nama_usaha'),
                    'no_hp'         => $this->input->post('no_hp'),
                    'alamat'        => $this->input->post('alamat')
                ];

                // Insert into pemasok table
                $this->Mod_auth->pemasok($data_pemasok);
            } elseif ($level == 'Pengelola') {
                $data_pengelola = [
                    'id_user'       => $user_id, // Assign user_id to id_user
                    'nama'          => $this->input->post('nama'),
                    'nama_usaha'    => $this->input->post('nama_usaha'),
                    'no_hp'         => $this->input->post('no_hp'),
                    'alamat'        => $this->input->post('alamat')
                ];

                // Insert into mitra_pengelola table
                $this->Mod_auth->pengelola($data_pengelola);
            }

            // Set a success message and redirect
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
