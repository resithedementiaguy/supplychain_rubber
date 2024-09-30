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
        return $this->db->delete('ambil');
    }

    public function add_ambil($data)
    {
        return $this->db->insert('ambil', $data);
    }

    public function get_all_ambil($id_pengelola)
    {
        $this->db->select('ambil.id, ambil.jumlah_stok, pemasok.nama, pemasok.nama_usaha, pemasok.no_hp');
        $this->db->from('ambil');
        $this->db->join('pemasok', 'ambil.id_pemasok = pemasok.id', 'left');
        $this->db->where('ambil.id_pengelola', $id_pengelola);
        $this->db->order_by('ambil.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    public function get_detail($id_ambil)
    {
        $this->db->select(
            'ambil.id, ambil.jumlah_stok, ambil.tanggal, ambil.keterangan, 
            pemasok.nama as nama_pemasok, pemasok.nama_usaha as nama_usaha_pemasok, pemasok.no_hp as no_hp_pemasok,
            mitra_pengelola.nama as nama_pengelola, mitra_pengelola.nama_usaha as nama_usaha_pengelola, mitra_pengelola.no_hp as no_hp_pengelola,
            olah.jumlah_stok as jumlah_produk_diolah, olah.jumlah_mentah as jumlah_mentah, olah.tanggal as tanggal_diolah'
        );
        $this->db->from('ambil');
        $this->db->join('pemasok', 'ambil.id_pemasok = pemasok.id', 'left');
        $this->db->join('mitra_pengelola', 'ambil.id_pengelola = mitra_pengelola.id', 'left');
        $this->db->join('olah', 'ambil.id_pengelola = olah.id_pengelola', 'left'); // Relasi ke tabel olah berdasarkan id_pengelola
        $this->db->where('ambil.id', $id_ambil); // Menggunakan ambil.id sebagai filter
        return $this->db->get()->row_array(); // Mengambil satu baris data
    }
}
