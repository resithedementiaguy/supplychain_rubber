<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ambil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_pemasok');
        $this->load->model('Mod_pengelola');
        $this->load->model('Mod_admin');
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

        $data['daftar_ambil'] = $this->Mod_admin->get_ambil();

        $this->load->view('backend/partials/header');
        $this->load->view('backend/admin/ambil/view', $data);
        $this->load->view('backend/partials/footer');
    }

    public function add_view()
    {
        $data['nama_usaha'] = $this->Mod_pengelola->get_mitra();
        $this->load->view('backend/partials/header');
        $this->load->view('backend/pemasok/add', $data);
        $this->load->view('backend/partials/footer');
    }

    public function add()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s', time());

        $data = array(
            'id_pemasok' => $this->input->post('id_pemasok'),
            'tanggal' => $tgl,
            'jumlah_stok' => $this->input->post('jumlah_stok')
        );

        $this->Mod_pemasok->add_stok($data);

        redirect('pemasok/add_view');
    }

    public function delete_stok($id)
    {
        $this->Mod_pemasok->delete_stok($id);
        redirect('pemasok');
    }

    public function delete($id)
    {
        if ($this->Mod_pemasok->delete_pemasok($id)) {
            redirect('pemasok', 'refresh');
        } else {
            show_error('Gagal menghapus data pemasok.', 500, 'Kesalahan Penghapusan');
        }
    }
}
