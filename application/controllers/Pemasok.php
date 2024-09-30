<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemasok extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_pemasok');
        $this->load->model('Mod_pengelola');
    }

    public function index()
    {
        $id_pemasok = $this->session->userdata('mitra_id');

        $data['daftar_stok'] = $this->Mod_pemasok->get_all_stok($id_pemasok);

        $data['pemasok_baru'] = empty($data['daftar_stok']);

        $this->load->view('partials/header');
        $this->load->view('frontend/pemasok/view', $data);
        $this->load->view('partials/footer');
    }

    public function add_view()
    {
        $data['nama_usaha'] = $this->Mod_pengelola->get_mitra();
        $this->load->view('partials/header');
        $this->load->view('frontend/pemasok/add', $data);
        $this->load->view('partials/footer');
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

    public function delete($id)
    {
        if ($this->Mod_pemasok->delete_pemasok($id)) {
            redirect('pemasok', 'refresh');
        } else {
            show_error('Gagal menghapus data pemasok.', 500, 'Kesalahan Penghapusan');
        }
    }
}
