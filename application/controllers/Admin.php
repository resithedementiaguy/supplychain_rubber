<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_pemasok');
        $this->load->model('Mod_pengelola');
        $this->load->model('Mod_admin');
        $this->check_login();
    }

    private function check_login()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function pemasok()
    {

        $data['daftar_pemasok'] = $this->Mod_admin->get_pemasok();

        $this->load->view('backend/partials/header');
        $this->load->view('backend/admin/pemasok/view', $data);
        $this->load->view('backend/partials/footer');
    }

    public function delete_stok($id)
    {
        $this->Mod_pemasok->delete_stok($id);
        redirect('pemasok');
    }

    public function delete_pemasok($id)
    {
        if ($this->Mod_pemasok->delete_pemasok($id)) {
            redirect('pemasok', 'refresh');
        } else {
            show_error('Gagal menghapus data pemasok.', 500, 'Kesalahan Penghapusan');
        }
    }

    public function pengelola()
    {
        $id_pengelola = $this->session->userdata('mitra_id');
        $data['daftar_ambil'] = $this->Mod_pengelola->get_all_ambil($id_pengelola);

        $this->load->view('backend/partials/header');
        $this->load->view('backend/admin/pengelola/view', $data);
        $this->load->view('backend/partials/footer');
    }

    public function add_view()
    {
        // Mengambil hanya pemasok yang status stoknya belum diambil
        $data['nama_usaha'] = $this->Mod_pemasok->get_pemasok_belum_diambil();
        $this->load->view('backend/partials/header');
        $this->load->view('backend/pengelola/add', $data);
        $this->load->view('backend/partials/footer');
    }

    public function pengelola_detail($id)
    {
        $data['detail_produk'] = $this->Mod_pengelola->get_detail($id);
        $data['riwayat_pemasok'] = $this->Mod_pengelola->get_riwayat_pemasok($data['detail_produk']['id_pemasok']);

        $this->load->view('backend/partials/header');
        $this->load->view('backend/pengelola/detail', $data);
        $this->load->view('backend/partials/footer');
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

    public function delete_pengelola($id)
    {
        if ($this->Mod_pengelola->delete_mitra($id)) {
            redirect('pemasok', 'refresh');
        } else {
            show_error('Gagal menghapus data pemasok.', 500, 'Kesalahan Penghapusan');
        }
    }
}
