<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_pemasok');
        $this->load->model('Mod_pengelola');
        $this->check_login();
    }

    private function check_login()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $user_id = $this->session->userdata('mitra_id');
        $level_name = $this->session->userdata('level_name');

        // Default bulan
        $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        // Jika pengguna pemasok
        if ($level_name == 'pemasok') {
            $data['total_stok_belum_diambil'] = $this->Mod_pemasok->get_total_stok('Belum diambil', $user_id);
            $data['total_stok_sudah_diambil'] = $this->Mod_pemasok->get_total_stok('Sudah diambil', $user_id);

            // Ambil stok per bulan untuk pemasok
            $stok_data = $this->Mod_pemasok->get_stok_per_bulan($user_id);

            // Inisialisasi array untuk menyimpan per bulan
            $stok = array_fill(0, 12, 0);

            // Proses stok per bulan
            foreach ($stok_data as $item) {
                $stok[$item->bulan - 1] = $item->total_stok;
            }

            // Kirim ke view dalam bentuk JSON
            $data['stok'] = json_encode($stok);
            $data['bulan'] = json_encode($bulan);
        }

        // Jika pengguna pengelola
        elseif ($level_name == 'pengelola') {
            $data['total_ambil'] = $this->Mod_pengelola->get_total_ambil($user_id);
            $data['total_diolah'] = $this->Mod_pengelola->get_total_diolah($user_id);

            // Ambil stok per bulan untuk pengelola
            $stok_diambil_data = $this->Mod_pengelola->get_stok_diambil_per_bulan($user_id);
            $stok_diolah_data = $this->Mod_pengelola->get_stok_diolah_per_bulan($user_id);

            // Inisialisasi array untuk menyimpan per bulan
            $stok_diambil = array_fill(0, 12, 0);
            $stok_diolah = array_fill(0, 12, 0);

            // Proses stok diambil per bulan
            foreach ($stok_diambil_data as $item) {
                $stok_diambil[$item->bulan - 1] = $item->total_stok;
            }

            // Proses stok diolah per bulan
            foreach ($stok_diolah_data as $item) {
                $stok_diolah[$item->bulan - 1] = $item->total_stok;
            }

            // Kirim ke view dalam bentuk JSON
            $data['stok_diambil'] = json_encode($stok_diambil);
            $data['stok_diolah'] = json_encode($stok_diolah);
            $data['bulan'] = json_encode($bulan);
        }

        // Jika pengguna admin
        elseif ($level_name == 'admin') {
            $data['total_stok_belum_diambil'] = $this->Mod_pemasok->get_total_stok('Belum diambil', $user_id);
            $data['total_stok_sudah_diambil'] = $this->Mod_pemasok->get_total_stok('Sudah diambil', $user_id);
            $data['total_ambil'] = $this->Mod_pengelola->get_total_ambil($user_id);
            $data['total_diolah'] = $this->Mod_pengelola->get_total_diolah($user_id);
        }

        $data['level_name'] = $level_name;  // Kirim level_name ke view

        // Load views
        $this->load->view('backend/partials/header');
        $this->load->view('backend/dashboard', $data);
        $this->load->view('backend/partials/footer');
    }
}
