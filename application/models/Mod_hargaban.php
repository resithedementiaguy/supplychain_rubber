<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_hargaban extends CI_Model
{

    public function get_all()
    {
        return $this->db->get('harga_ban_bekas')->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('harga_ban_bekas', ['id' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert('harga_ban_bekas', $data);
    }

    public function update($id, $data)
    {
        return $this->db->update('harga_ban_bekas', $data, ['id' => $id]);
    }

    public function delete($id)
    {
        return $this->db->delete('harga_ban_bekas', ['id' => $id]);
    }
}
