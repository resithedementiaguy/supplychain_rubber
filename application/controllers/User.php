<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_user');
        $this->check_login();
    }

    private function check_login()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $this->load->model('Mod_user');
        $data['users'] = $this->Mod_user->get_all_users();

        $data['title'] = 'Master User';
        $this->load->view('backend/partials/header', $data);
        $this->load->view('backend/admin/user/view', $data);
        $this->load->view('backend/partials/footer');
    }

    public function add_user()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('level', 'Level', 'required|in_list[admin,pengelola,pemasok]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Pengguna';
            $this->load->view('backend/partials/header', $data);
            $this->load->view('backend/admin/user/add', $data);
            $this->load->view('backend/partials/footer');
        } else {
            $data = [
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'level' => $this->input->post('level')
            ];

            $user_id = $this->Mod_user->insert_user($data);

            if ($this->input->post('level') === 'admin') {
                $this->Mod_user->insert_admin_detail([
                    'id_user' => $user_id,
                    'nama' => $this->input->post('nama'),
                    'no_hp' => $this->input->post('no_hp'),
                    'alamat' => $this->input->post('alamat'),
                    'lokasi' => $this->input->post('lokasi')
                ]);
            } elseif ($this->input->post('level') === 'pengelola') {
                $this->Mod_user->insert_pengelola_detail([
                    'id_user' => $user_id,
                    'nama' => $this->input->post('nama'),
                    'nama_usaha' => $this->input->post('nama_usaha'),
                    'no_hp' => $this->input->post('no_hp'),
                    'alamat' => $this->input->post('alamat'),
                    'lokasi' => $this->input->post('lokasi')
                ]);
            } elseif ($this->input->post('level') === 'pemasok') {
                $this->Mod_user->insert_pemasok_detail([
                    'id_user' => $user_id,
                    'nama' => $this->input->post('nama'),
                    'nama_usaha' => $this->input->post('nama_usaha'),
                    'no_hp' => $this->input->post('no_hp'),
                    'alamat' => $this->input->post('alamat'),
                    'lokasi' => $this->input->post('lokasi')
                ]);
            }

            $this->session->set_flashdata('success', 'Pengguna berhasil ditambahkan.');
            redirect('admin/user');
        }
    }

    public function edit_user($id)
    {
        $data['user'] = $this->Mod_user->get_user_by_id($id);

        if (!$data['user']) {
            show_404();
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('level', 'Level', 'required|in_list[admin,pengelola,pemasok]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Pengguna';
            $this->load->view('backend/partials/header', $data);
            $this->load->view('backend/user/edit_user', $data);
            $this->load->view('backend/partials/footer');
        } else {
            $update_data = [
                'email' => $this->input->post('email'),
                'level' => $this->input->post('level')
            ];

            if ($this->input->post('password')) {
                $update_data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }

            $this->Mod_user->update_user($id, $update_data);

            $this->session->set_flashdata('success', 'Pengguna berhasil diperbarui.');
            redirect('admin/user');
        }
    }

    public function delete_user($id)
    {
        $user = $this->Mod_user->get_user_by_id($id);

        if (!$user) {
            show_404();
        }

        $this->Mod_user->delete_user($id);
        $this->session->set_flashdata('success', 'Pengguna berhasil dihapus.');
        redirect('admin/user');
    }
}
