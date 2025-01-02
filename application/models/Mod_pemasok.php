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

    public function get_pemasok_by_id($id)
    {
        return $this->db->get_where('pemasok', ['id' => $id])->row();
    }

    public function get_status_stok_by_id($id_status_stok)
    {
        return $this->db->get_where('status_stok', ['id' => $id_status_stok])->row();
    }

    public function get_total_stok($status = null, $user_id = null)
    {
        $this->db->select_sum('jumlah_stok');

        if ($status !== null) {
            $this->db->where('status', $status);
        }

        if ($user_id !== null) {
            $this->db->where('id_pemasok', $user_id);
        }

        $query = $this->db->get('status_stok');
        return $query->row()->jumlah_stok;
    }

    public function get_stok_per_bulan($user_id)
    {
        $this->db->select('MONTH(tanggal) as bulan, SUM(jumlah_stok) as total_stok');
        $this->db->where('id_pemasok', $user_id);
        $this->db->group_by('MONTH(tanggal)');
        $this->db->order_by('MONTH(tanggal)', 'ASC');
        $query = $this->db->get('status_stok');
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

    public function get_harga_by_jenis($jenis_kendaraan)
    {
        $query = $this->db->select('harga')
            ->from('harga_ban_bekas')
            ->where('jenis', $jenis_kendaraan)
            ->get();
        return $query->row() ? $query->row()->harga : null;
    }

    public function add_stok($data)
    {
        return $this->db->insert('status_stok', $data);
    }

    public function get_stok_by_id($id)
    {
        $this->db->select('jumlah_stok, lokasi');
        $this->db->from('status_stok');
        $this->db->where('id_pemasok', $id);
        $this->db->order_by('tanggal', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->jumlah_stok;
        }
        return null;
    }

    public function get_all_stok($id_pemasok)
    {
        $this->db->select('status_stok.jumlah_stok, pemasok.id as id_pemasok, pemasok.nama, pemasok.nama_usaha, pemasok.no_hp, status_stok.jenis as jenis_kendaraan, status_stok.harga, status_stok.total_harga, status_stok.status, status_stok.tanggal, status_stok.id');
        $this->db->from('status_stok');
        $this->db->join('pemasok', 'status_stok.id_pemasok = pemasok.id', 'left');
        $this->db->where('status_stok.id_pemasok', $id_pemasok);
        $this->db->order_by('status_stok.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    public function get_harga_ban($jenis_kendaran)
    {
        $this->db->select('harga');
        $this->db->from('harga_ban_bekas');
        $this->db->where('jenis', $jenis_kendaran);
        $query = $this->db->get();

        return $query->row();
    }

    public function get_pemasok_belum_diambil()
    {
        $this->db->select('
        pemasok.id, 
        pemasok.nama_usaha, 
        MAX(status_stok.jenis) AS jenis, 
        SUM(status_stok.total_harga) AS total_harga, 
        pemasok.no_hp, 
        SUM(status_stok.jumlah_stok) AS jumlah_stok, 
        MAX(status_stok.lokasi) AS lokasi
    ');
        $this->db->from('pemasok');
        $this->db->join('status_stok', 'pemasok.id = status_stok.id_pemasok');
        $this->db->where('status_stok.status', 'Belum diambil');
        $this->db->group_by('pemasok.id');
        $this->db->order_by('pemasok.nama_usaha', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function delete_stok($id)
    {
        return $this->db->delete('status_stok', array('id' => $id));
    }
}
