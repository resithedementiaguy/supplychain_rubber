<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_auth extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function register($data)
    {
        return $this->db->insert('user', $data);
    }

    public function pemasok($data)
    {
        return $this->db->insert('pemasok', $data);
    }

    public function pengelola($data)
    {
        return $this->db->insert('mitra_pengelola', $data);
    }

    public function get_user_by_id($user_id)
    {
        $query = $this->db->get_where('user', array('id' => $user_id));
        return $query->row_array(); // Mengembalikan satu baris sebagai array
    }

    // Function to validate login credentials
    public function validate_login($email, $password)
    {
        // Ambil data dari tabel user
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $user = $query->row();

            // Log password hash dari database
            error_log("Password hash from database: " . $user->password);

            // Verifikasi password menggunakan password_verify
            if (password_verify($password, $user->password)) {
                // Set session data dasar
                $this->session->set_userdata([
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'level_name' => $user->level,
                    'logged_in' => TRUE
                ]);

                $mitra_id = null;
                $nama = null;

                if ($user->level == 'pemasok') {
                    $this->db->select('*');
                    $this->db->from('pemasok');
                    $this->db->where('id_user', $user->id);
                    $mitra_id_query = $this->db->get();

                    if ($mitra_id_query->num_rows() == 1) {
                        $row = $mitra_id_query->row();
                        $mitra_id = $row->id;
                        $nama = $row->nama;
                    }
                } elseif ($user->level == 'pengelola') {
                    $this->db->select('*');
                    $this->db->from('mitra_pengelola');
                    $this->db->where('id_user', $user->id);
                    $mitra_id_query = $this->db->get();

                    if ($mitra_id_query->num_rows() == 1) {
                        $row = $mitra_id_query->row();
                        $mitra_id = $row->id;
                        $nama = $row->nama;
                    }
                } elseif ($user->level == 'admin') {
                    $this->db->select('*');
                    $this->db->from('admin');
                    $this->db->where('id_user', $user->id);
                    $admin_query = $this->db->get();

                    if ($admin_query->num_rows() == 1) {
                        $row = $admin_query->row();
                        $mitra_id = $row->id;
                        $nama = $row->nama;
                    }
                }

                return [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'nama' => $nama,
                    'level_name' => $user->level,
                    'mitra_id' => $mitra_id
                ];
            }
        }

        return false;
    }
}
