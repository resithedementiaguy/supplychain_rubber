<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengelola extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_pengelola');
        $this->load->model('Mod_pemasok');
    }

    public function index()
    {
        $id_pengelola = $this->session->userdata('mitra_id');
        $data['daftar_ambil'] = $this->Mod_pengelola->get_all_ambil($id_pengelola);

        $this->load->view('partials/header');
        $this->load->view('frontend/pengelola/view', $data);
        $this->load->view('partials/footer');
    }

    public function add_view()
    {
        $data['nama_usaha'] = $this->Mod_pemasok->get_pemasok();
        $this->load->view('partials/header');
        $this->load->view('frontend/pengelola/add', $data);
        $this->load->view('partials/footer');
    }

    public function detail($id)
    {
        $data['detail_produk'] = $this->Mod_pengelola->get_detail($id);

        $this->load->view('partials/header');
        $this->load->view('frontend/pengelola/detail', $data);
        $this->load->view('partials/footer');
    }

    public function insert_olah()
    {
        // Ambil data dari request AJAX
        $data = [
            'id_pengelola' => $this->input->post('id_pengelola'),
            'tanggal' => $this->input->post('tanggal'),
            'jumlah_mentah' => $this->input->post('jumlah_mentah')
        ];

        // Insert ke tabel olah
        $this->db->insert('olah', $data);

        // Cek apakah data berhasil disimpan
        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function get_stok_by_id()
    {
        $id_pemasok = $this->input->post('id_pemasok');
        $stok = $this->Mod_pemasok->get_stok_by_id($id_pemasok);
        echo json_encode($stok);
    }

    public function add()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s', time());

        $data = array(
            'id_pengelola' => $this->input->post('id_pengelola'),
            'id_pemasok' => $this->input->post('id_pemasok'),
            'tanggal' => $tgl,
            'jumlah_stok' => $this->input->post('jumlah_stok'),
            'keterangan' => $this->input->post('keterangan')
        );

        $this->Mod_pengelola->add_ambil($data);
        redirect('pengelola/add_view');
    }
}
