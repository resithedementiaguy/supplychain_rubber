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
        $this->db->group_by('ambil.id_pemasok'); // Menampilkan hanya 1 data per id_pemasok
        $this->db->order_by('ambil.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    public function get_detail($id_ambil)
    {
        $this->db->select(
            'ambil.id, ambil.jumlah_stok, ambil.tanggal, ambil.keterangan, 
        pemasok.id as id_pemasok, pemasok.nama as nama_pemasok, pemasok.nama_usaha as nama_usaha_pemasok, pemasok.no_hp as no_hp_pemasok,
        mitra_pengelola.nama as nama_pengelola, mitra_pengelola.nama_usaha as nama_usaha_pengelola, mitra_pengelola.no_hp as no_hp_pengelola,
        olah.jumlah_stok as jumlah_produk_diolah, olah.jumlah_mentah as jumlah_mentah, olah.tanggal as tanggal_diolah'
        );
        $this->db->from('ambil');
        $this->db->join('pemasok', 'ambil.id_pemasok = pemasok.id', 'left');
        $this->db->join('mitra_pengelola', 'ambil.id_pengelola = mitra_pengelola.id', 'left');
        $this->db->join('olah', 'ambil.id = olah.id', 'left');
        $this->db->where('ambil.id', $id_ambil);
        return $this->db->get()->row_array();
    }

    public function get_riwayat_pemasok($id_pemasok)
    {
        $this->db->select(
            'ambil.id as id_ambil, ambil.jumlah_stok, ambil.tanggal, ambil.keterangan, 
        pemasok.nama as nama_pemasok, pemasok.nama_usaha as nama_usaha_pemasok, 
        pemasok.no_hp as no_hp_pemasok,
        mitra_pengelola.nama as nama_pengelola, mitra_pengelola.nama_usaha as nama_usaha_pengelola, 
        mitra_pengelola.no_hp as no_hp_pengelola,
        olah.tanggal as tanggal_diolah, olah.jumlah_mentah'
        );
        $this->db->from('ambil');
        $this->db->join('pemasok', 'ambil.id_pemasok = pemasok.id', 'left');
        $this->db->join('mitra_pengelola', 'ambil.id_pengelola = mitra_pengelola.id', 'left');
        $this->db->join('olah', 'ambil.id = olah.id_ambil', 'left');
        $this->db->where('ambil.id_pemasok', $id_pemasok);
        return $this->db->get()->result();
    }
}
