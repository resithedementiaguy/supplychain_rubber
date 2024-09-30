<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_pemasok extends CI_Model
{

    public function add_pemasok($data)
    {
        return $this->db->insert('pemasok', $data);
    }

    public function get_pemasok()
    {
        $this->db->select('*');
        $this->db->from('pemasok');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function update_pemasok($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('pemasok', $data);
    }

    public function delete_pemasok($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('status_stok');
    }

    public function add_stok($data)
    {
        return $this->db->insert('status_stok', $data);
    }

    public function get_stok_by_id($id)
    {
        $this->db->select('jumlah_stok');
        $this->db->from('status_stok');
        $this->db->where('id_pemasok', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->jumlah_stok;
        }
        return null;
    }

    public function get_all_stok($id_pemasok)
    {
        $this->db->select('status_stok.jumlah_stok, status_stok.id, pemasok.nama, pemasok.nama_usaha, pemasok.no_hp, status_stok.status');
        $this->db->from('status_stok');
        $this->db->join('pemasok', 'status_stok.id_pemasok = pemasok.id', 'left');
        $this->db->where('status_stok.id_pemasok', $id_pemasok);
        $this->db->order_by('status_stok.tanggal', 'DESC');
        return $this->db->get()->result();
    }
}
