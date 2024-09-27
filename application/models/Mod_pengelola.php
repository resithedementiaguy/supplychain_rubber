<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_pengelola extends CI_Model
{
    public function add_mitra($data)
    {
        return $this->db->insert('mitra_pengelola', $data);
    }

    public function get_mitra()
    {
        $this->db->select('*');
        $this->db->from('mitra_pengelola');
        $this->db->order_by('id', 'ASC');
        return $this->db->get()->result();
    }

    public function update_mitra($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('mitra_pengelola', $data);
    }

    public function delete_mitra($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('mitra_pengelola');
    }

    public function add_ambil($data)
    {
        return $this->db->insert('ambil', $data);
    }

    public function get_all_ambil($id_pengelola) {
        $this->db->select('ambil.jumlah_stok, pemasok.nama, pemasok.nama_usaha, pemasok.no_hp');
        $this->db->from('ambil');
        $this->db->join('pemasok', 'ambil.id_pemasok = pemasok.id', 'left');
        $this->db->where('ambil.id_pengelola', $id_pengelola);
        return $this->db->get()->result();
    }
}
