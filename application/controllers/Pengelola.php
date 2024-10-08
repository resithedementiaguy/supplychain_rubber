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

        $this->load->view('backend/partials/header');
        $this->load->view('backend/pengelola/view', $data);
        $this->load->view('backend/partials/footer');
    }

    public function add_view()
    {
        $data['nama_usaha'] = $this->Mod_pemasok->get_pemasok_belum_diambil();
        $this->load->view('backend/partials/header');
        $this->load->view('backend/pengelola/add', $data);
        $this->load->view('backend/partials/footer');
    }

    public function detail($id)
    {
        $data['detail_produk'] = $this->Mod_pengelola->get_detail($id);
        $data['riwayat_pemasok'] = $this->Mod_pengelola->get_riwayat_pemasok($data['detail_produk']['id_pemasok']);

        $this->load->view('backend/partials/header');
        $this->load->view('backend/pengelola/detail', $data);
        $this->load->view('backend/partials/footer');
    }

    public function insert_olah()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s', time());

        $id_ambil = $this->input->post('id_ambil');
        $jumlah_stok = $this->input->post('jumlah_stok');
        $jumlah_mentah = $this->input->post('jumlah_mentah');

        if (empty($id_ambil) || empty($jumlah_stok) || empty($jumlah_mentah)) {
            echo json_encode(['success' => false, 'message' => 'Data input tidak lengkap.']);
            return;
        }

        $data = [
            'id_ambil' => $id_ambil,
            'tanggal' => $tgl,
            'jumlah_stok' => $jumlah_stok,
            'jumlah_mentah' => $jumlah_mentah
        ];

        try {
            $this->db->insert('olah', $data);
            log_message('debug', 'Query Insert: ' . $this->db->last_query());
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['success' => true, 'message' => 'Data berhasil disimpan!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Tidak ada perubahan data yang disimpan.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
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

    public function delete($id)
    {
        if ($this->Mod_pengelola->delete_mitra($id)) {
            redirect('pemasok', 'refresh');
        } else {
            show_error('Gagal menghapus data pemasok.', 500, 'Kesalahan Penghapusan');
        }
    }
}
