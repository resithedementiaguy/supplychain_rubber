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
        return $this->db->insert('admin', $data);
    }

    public function insert_pengelola_detail($data)
    {
        return $this->db->insert('mitra_pengelola', $data);
    }

    public function insert_pemasok_detail($data)
    {
        return $this->db->insert('pemasok', $data);
    }

    public function get_user_by_id($id)
    {
        $query = $this->db->get_where('user', ['id' => $id]);
        return $query->row();
    }

    public function get_user_details($id, $level)
    {
        switch ($level) {
            case 'admin':
                return $this->db->get_where('admin', ['id_user' => $id])->row();
            case 'pengelola':
                return $this->db->get_where('mitra_pengelola', ['id_user' => $id])->row();
            case 'pemasok':
                return $this->db->get_where('pemasok', ['id_user' => $id])->row();
            default:
                return null;
        }
    }

    public function update_admin_detail($id_user, $data)
    {
        return $this->db->update('admin', $data, ['id_user' => $id_user]);
    }

    public function update_pengelola_detail($id_user, $data)
    {
        return $this->db->update('mitra_pengelola', $data, ['id_user' => $id_user]);
    }

    public function update_pemasok_detail($id_user, $data)
    {
        return $this->db->update('pemasok', $data, ['id_user' => $id_user]);
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
