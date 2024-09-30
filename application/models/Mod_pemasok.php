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
        $this->db->order_by('id', 'DESC');
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
        return $this->db->delete('pemasok');
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
        $this->db->order_by('tanggal','DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->jumlah_stok;
        }
        return null;
    }

    public function get_all_stok($id_pemasok) {
        $this->db->select('status_stok.jumlah_stok, pemasok.nama, pemasok.nama_usaha, pemasok.no_hp, status_stok.status, status_stok.tanggal, status_stok.id');
        $this->db->from('status_stok');
        $this->db->join('pemasok', 'status_stok.id_pemasok = pemasok.id', 'left');
        $this->db->where('status_stok.id_pemasok', $id_pemasok);
        $this->db->order_by('status_stok.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    public function get_pemasok_belum_diambil()
    {
        $this->db->select('pemasok.id, pemasok.nama_usaha, pemasok.no_hp');
        $this->db->from('pemasok');
        $this->db->join('status_stok', 'pemasok.id = status_stok.id_pemasok');
        $this->db->where('status_stok.status', 'Belum diambil');
        $this->db->group_by('pemasok.id'); // Pastikan hanya menampilkan pemasok yang unik
        $this->db->order_by('pemasok.nama_usaha', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function delete_stok($id)
    {
        return $this->db->delete('status_stok', array('id' => $id));
    }
}
