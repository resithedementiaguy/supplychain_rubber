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

            // Log password hash comparison
            error_log("Password from database (MD5): " . $user->password);

            // Hashing password dengan metode yang digunakan
            $enc_psw = sha1('jksdhf832746aiH{}{()&(*&(*' . MD5($password) . 'HdfevgyDDw{}{}{;;*766&*&*');

            // Verifikasi password
            if ($enc_psw === $user->password) {
                // Set session data dasar
                $this->session->set_userdata([
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'level_name' => $user->level,
                    'logged_in' => TRUE
                ]);

                // Ambil informasi tambahan dari tabel pemasok dan mitra_pengelola berdasarkan level
                $mitra_id = null;

                if ($user->level == 'pemasok') {
                    $this->db->select('*');
                    $this->db->from('pemasok');
                    $this->db->where('id_user', $user->id); // gunakan id_user untuk menghubungkan dengan user
                    $mitra_id_query = $this->db->get();

                    if ($mitra_id_query->num_rows() == 1) {
                        $mitra_id = $mitra_id_query->row()->id; // Mengambil ID
                    }
                } elseif ($user->level == 'pengelola') {
                    $this->db->select('*');
                    $this->db->from('mitra_pengelola');
                    $this->db->where('id_user', $user->id); // gunakan id_user untuk menghubungkan dengan user
                    $mitra_id_query = $this->db->get();

                    if ($mitra_id_query->num_rows() == 1) {
                        $mitra_id = $mitra_id_query->row()->id; // Mengambil ID
                    }
                }

                // Return data user dan informasi tambahan
                return [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'nama' => $user->nama,
                    'level_name' => $user->level,
                    'mitra_id' => $mitra_id // Data tambahan dari pemasok atau pengelola
                ];
            }
        }

        return false;
    }

    // Update the location for a pemasok
    public function update_pemasok_location($user_id, $location)
    {
        $this->db->set('lokasi', $location);
        $this->db->where('id_user', $user_id);
        $this->db->update('pemasok');
    }

    // Update the location for a pengelola
    public function update_pengelola_location($user_id, $location)
    {
        $this->db->set('lokasi', $location);
        $this->db->where('id_user', $user_id);
        $this->db->update('mitra_pengelola');
    }

}
