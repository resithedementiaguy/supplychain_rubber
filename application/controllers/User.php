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

        // Set pesan error kustom untuk email unik
        $this->form_validation->set_message('is_unique', 'Email %s sudah digunakan. Silakan gunakan email lain.');

        // Atur rules validasi
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]', [
            'required' => 'Email wajib diisi',
            'valid_email' => 'Format email tidak valid'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]', [
            'required' => 'Password wajib diisi',
            'min_length' => 'Password minimal 6 karakter'
        ]);
        $this->form_validation->set_rules('level', 'Level', 'required|in_list[admin,pengelola,pemasok]', [
            'required' => 'Level wajib dipilih',
            'in_list' => 'Level tidak valid'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Pengguna';
            // Tambahkan status error jika ada
            if (form_error('email') && strpos(form_error('email'), 'sudah digunakan') !== false) {
                $this->session->set_flashdata('error', 'Email sudah terdaftar. Silakan gunakan email lain.');
                redirect('admin/user/add');
            }
            $this->load->view('backend/partials/header', $data);
            $this->load->view('backend/admin/user/add', $data);
            $this->load->view('backend/partials/footer');
        } else {
            // Cek ulang email untuk keamanan tambahan
            $existing_email = $this->db->get_where('user', ['email' => $this->input->post('email')])->row();
            if ($existing_email) {
                $this->session->set_flashdata('error', 'Email sudah terdaftar. Silakan gunakan email lain.');
                redirect('admin/user/add');
                return;
            }

            try {
                $this->db->trans_start(); // Mulai transaksi

                $data = [
                    'email' => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'level' => $this->input->post('level')
                ];

                $user_id = $this->Mod_user->insert_user($data);

                // Array untuk data detail user
                $detail_data = [
                    'id_user' => $user_id,
                    'nama' => $this->input->post('nama'),
                    'no_hp' => $this->input->post('no_hp'),
                    'alamat' => $this->input->post('alamat'),
                    'lokasi' => $this->input->post('lokasi')
                ];

                // Tambahkan nama_usaha jika level bukan admin
                if (in_array($this->input->post('level'), ['pengelola', 'pemasok'])) {
                    $detail_data['nama_usaha'] = $this->input->post('nama_usaha');
                }

                // Insert detail berdasarkan level
                switch ($this->input->post('level')) {
                    case 'admin':
                        $this->Mod_user->insert_admin_detail($detail_data);
                        break;
                    case 'pengelola':
                        $this->Mod_user->insert_pengelola_detail($detail_data);
                        break;
                    case 'pemasok':
                        $this->Mod_user->insert_pemasok_detail($detail_data);
                        break;
                }

                $this->db->trans_complete(); // Selesai transaksi

                if ($this->db->trans_status() === FALSE) {
                    // Rollback jika ada error
                    $this->session->set_flashdata('error', 'Terjadi kesalahan saat menambahkan pengguna.');
                    redirect('admin/user/add');
                } else {
                    $this->session->set_flashdata('success', 'Pengguna berhasil ditambahkan.');
                    redirect('admin/user');
                }
            } catch (Exception $e) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
                redirect('admin/user/add');
            }
        }
    }

    public function edit_user($id)
    {
        $data['user'] = $this->Mod_user->get_user_by_id($id);

        if (!$data['user']) {
            show_404();
        }

        switch ($data['user']->level) {
            case 'admin':
                $details = $this->db->get_where('admin', ['id_user' => $id])->row();
                break;
            case 'pengelola':
                $details = $this->db->get_where('mitra_pengelola', ['id_user' => $id])->row();
                break;
            case 'pemasok':
                $details = $this->db->get_where('pemasok', ['id_user' => $id])->row();
                break;
        }

        if (isset($details)) {
            foreach ($details as $key => $value) {
                $data['user']->$key = $value;
            }
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('level', 'Level', 'required|in_list[admin,pengelola,pemasok]');

        // Validasi berdasarkan level
        if ($this->input->post('level') == 'admin') {
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
        } elseif ($this->input->post('level') == 'pengelola') {
            $this->form_validation->set_rules('nama_usaha', 'Nama Usaha', 'required');
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
        } elseif ($this->input->post('level') == 'pemasok') {
            $this->form_validation->set_rules('nama_usaha', 'Nama Usaha', 'required');
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Pengguna';
            $this->load->view('backend/partials/header', $data);
            $this->load->view('backend/admin/user/edit', $data);
            $this->load->view('backend/partials/footer');
        } else {
            // Update data pengguna
            $update_data = [
                'email' => $this->input->post('email'),
                'level' => $this->input->post('level')
            ];

            if ($this->input->post('password')) {
                $update_data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }

            // Update data pengguna utama
            $this->Mod_user->update_user($id, $update_data);

            // Update detail pengguna berdasarkan level
            if ($this->input->post('level') === 'admin') {
                $this->Mod_user->update_admin_detail($id, [
                    'nama' => $this->input->post('nama'),
                    'no_hp' => $this->input->post('no_hp'),
                    'alamat' => $this->input->post('alamat'),
                    'lokasi' => $this->input->post('lokasi')
                ]);
            } elseif ($this->input->post('level') === 'pengelola') {
                $this->Mod_user->update_pengelola_detail($id, [
                    'nama' => $this->input->post('nama'),
                    'nama_usaha' => $this->input->post('nama_usaha'),
                    'no_hp' => $this->input->post('no_hp'),
                    'alamat' => $this->input->post('alamat'),
                    'lokasi' => $this->input->post('lokasi')
                ]);
            } elseif ($this->input->post('level') === 'pemasok') {
                $this->Mod_user->update_pemasok_detail($id, [
                    'nama' => $this->input->post('nama'),
                    'nama_usaha' => $this->input->post('nama_usaha'),
                    'no_hp' => $this->input->post('no_hp'),
                    'alamat' => $this->input->post('alamat'),
                    'lokasi' => $this->input->post('lokasi')
                ]);
            }

            $this->session->set_flashdata('success', 'Data pengguna berhasil diperbarui');
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
