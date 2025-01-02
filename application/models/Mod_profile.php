<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_profile extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function get_user($user_id)
    {
        // Query dengan JOIN untuk menggabungkan data user, pemasok, dan mitra_pengelola
        $this->db->select('u.*, p.nama as pemasok_nama, p.nama_usaha as pemasok_usaha, p.no_hp as pemasok_no_hp, p.alamat as pemasok_alamat, 
                           m.nama as mitra_nama, m.nama_usaha as mitra_usaha, m.no_hp as mitra_no_hp, m.alamat as mitra_alamat');
        $this->db->from('user u');
        $this->db->join('pemasok p', 'u.id = p.id_user', 'left');
        $this->db->join('mitra_pengelola m', 'u.id = m.id_user', 'left');
        $this->db->where('u.id', $user_id);

        $query = $this->db->get();
        return $query->row_array();
    }


    public function update_pemasok($user_id, $data)
    {
        $this->db->where('id_user', $user_id);
        $this->db->update('pemasok', $data);
    }

    public function update_mitra_pengelola($user_id, $data)
    {
        $this->db->where('id_user', $user_id);
        $this->db->update('mitra_pengelola', $data);
    }
}
