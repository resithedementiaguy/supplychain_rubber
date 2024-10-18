<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_pemasok');
        $this->check_login();
    }

    private function check_login()
    {
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $user_id = $this->session->userdata('mitra_id');

        $data['total_stok_belum_diambil'] = $this->Mod_pemasok->get_total_stok('Belum diambil', $user_id);
        $data['total_stok_sudah_diambil'] = $this->Mod_pemasok->get_total_stok('Sudah diambil', $user_id);

        $stok_data = $this->Mod_pemasok->get_stok_per_bulan($user_id);

        $stok = array_fill(0, 12, 0);
        $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        foreach ($stok_data as $item) {
            $stok[$item->bulan - 1] = $item->total_stok;
        }

        $data['stok'] = json_encode($stok);
        $data['bulan'] = json_encode($bulan);

        $this->load->view('backend/partials/header');
        $this->load->view('backend/dashboard', $data);
        $this->load->view('backend/partials/footer');
    }
}
