<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengelola extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_pengelola');
        $this->load->model('Mod_pemasok');
        $this->check_login(); // Ensure user is logged in
    }

    private function check_login()
    {
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            // Redirect to login page if not logged in
            redirect('auth');
        }
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
        // Mengambil hanya pemasok yang status stoknya belum diambil
        $data['nama_usaha'] = $this->Mod_pemasok->get_pemasok_belum_diambil();
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
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s', time());
        // Ambil data dari POST
        $data = [
            'id_pengelola' => $this->input->post('id_pengelola'),
            'tanggal' => $tgl,
            'jumlah_stok' => $this->input->post('jumlah_stok'),
            'jumlah_mentah' => $this->input->post('jumlah_mentah')
        ];

        $this->db->insert('olah', $data);

        // Cek apakah data berhasil disimpan
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan data');
        }

        // Redirect kembali ke halaman detail produk
        redirect('pengelola/detail/' . $data['id_pengelola']);
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

    public function delete($id)
    {
        if ($this->Mod_pengelola->delete_mitra($id)) {
            redirect('pemasok', 'refresh');
        } else {
            show_error('Gagal menghapus data pemasok.', 500, 'Kesalahan Penghapusan');
        }
    }
}
