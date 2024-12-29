<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_user extends CI_Model
{
    public function get_all_users()
    {
        $this->db->select('user.*, 
                           admin.nama AS admin_nama, admin.no_hp AS admin_no_hp, 
                           mitra_pengelola.nama AS pengelola_nama, mitra_pengelola.nama_usaha AS pengelola_usaha, 
                           pemasok.nama AS pemasok_nama, pemasok.nama_usaha AS pemasok_usaha');
        $this->db->from('user');
        $this->db->join('admin', 'admin.id_user = user.id', 'left');
        $this->db->join('mitra_pengelola', 'mitra_pengelola.id_user = user.id', 'left');
        $this->db->join('pemasok', 'pemasok.id_user = user.id', 'left');
        return $this->db->get()->result();
    }

    public function insert_user($data)
    {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    public function insert_admin_detail($data)
    {
        $this->db->insert('admin', $data);
    }

    public function insert_pemasok_detail($data)
    {
        $this->db->insert('pemasok', $data);
    }

    public function insert_mitra_pengelola_detail($data)
    {
        $this->db->insert('mitra_pengelola', $data);
    }

    public function get_user_by_id($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row();
    }

    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }

    public function delete_user($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
    }
}
