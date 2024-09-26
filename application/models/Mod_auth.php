<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_auth extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); // Ensure session library is loaded
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
        return $this->db->insert('pengelola', $data);
    }

    // Function to validate login credentials
    public function validate_login($email, $password)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $user = $query->row();

            // Log password hash comparison
            error_log("Password from database (MD5): " . $user->password);

            $enc_psw = sha1('jksdhf832746aiH{}{()&(*&(*' . MD5($password) . 'HdfevgyDDw{}{}{;;*766&*&*');

            // Verify password using MD5
            if ($enc_psw === $user->password) {
                // Set session data
                $this->session->set_userdata([
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'level_name' => $user->level,
                    'logged_in' => TRUE
                ]);

                return [
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'level_name' => $user->level
                ];
            }
        }

        return false;
    }
}
