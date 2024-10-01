<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_admin extends CI_Model
{
    public function get_pengelola()
    {
        $this->db->select('*');
        $this->db->from('mitra_pengelola');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pemasok()
    {
        $this->db->select('*');
        $this->db->from('pemasok');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_stok()
    {
        $this->db->select('status_stok.jumlah_stok, pemasok.nama, pemasok.nama_usaha, pemasok.no_hp, status_stok.status, status_stok.tanggal, status_stok.id');
        $this->db->from('status_stok');
        $this->db->join('pemasok', 'status_stok.id_pemasok = pemasok.id', 'left');
        $this->db->order_by('status_stok.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    public function get_ambil()
    {
        $this->db->select('ambil.id, ambil.jumlah_stok, pemasok.nama, pemasok.nama_usaha, pemasok.no_hp');
        $this->db->from('ambil');
        $this->db->join('pemasok', 'ambil.id_pemasok = pemasok.id', 'left');
        $this->db->order_by('ambil.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    public function get_olah()
    {
        $this->db->select('*');
        $this->db->from('olah');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }


}