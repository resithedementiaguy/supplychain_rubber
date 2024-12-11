<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemasok extends CI_Controller
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
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            // Redirect to login page if not logged in
            redirect('auth');
        }
    }

    public function index()
    {
        $id_pemasok = $this->session->userdata('mitra_id');

        $data['daftar_stok'] = $this->Mod_pemasok->get_all_stok($id_pemasok);

        $data['pemasok_baru'] = empty($data['daftar_stok']);

        $this->load->view('backend/partials/header');
        $this->load->view('backend/pemasok/view', $data);
        $this->load->view('backend/partials/footer');
    }

    public function detail($id_status_stok)
    {
        // Ambil data status_stok berdasarkan ID status_stok
        $data['status_stok'] = $this->Mod_pemasok->get_status_stok_by_id($id_status_stok);

        // Jika data status_stok ditemukan, ambil data pemasok berdasarkan id_pemasok yang ada pada status_stok
        if ($data['status_stok']) {
            $data['pemasok'] = $this->Mod_pemasok->get_pemasok_by_id($data['status_stok']->id_pemasok);

            // Validasi jika status stok sudah diambil
            if ($data['status_stok']->status === 'Sudah diambil') {
                $ambil_data = $this->Mod_pengelola->get_ambil_by_pemasok($id_status_stok);
                if (!empty($ambil_data)) {
                    // Mengambil pengelola dan data terkait
                    $data['pengelola'] = $ambil_data[0]; // Jika hanya ada satu data yang diambil
                } else {
                    $data['pengelola'] = null;
                }
            } else {
                $data['pengelola'] = null;
            }
        } else {
            $data['pemasok'] = null;
            $data['pengelola'] = null;
        }

        // Load view
        $this->load->view('backend/partials/header');
        $this->load->view('backend/pemasok/detail', $data);
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
        $this->form_validation->set_rules('jenis_kendaraan', 'Jenis Kendaraan', 'required|trim');
        $this->form_validation->set_rules('jumlah_stok', 'Jumlah Stok', 'required|trim|numeric');

        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s', time());

        if ($this->form_validation->run() == FALSE) {
            redirect('pemasok/add_view');
        } else {
            $jenis_kendaraan = $this->input->post('jenis_kendaraan');
            $jumlah_stok = $this->input->post('jumlah_stok');

            // Ambil harga dari model
            $harga_per_kg = $this->Mod_pemasok->get_harga_by_jenis($jenis_kendaraan);

            if (!$harga_per_kg) {
                $this->session->set_flashdata('error', 'Harga untuk jenis kendaraan ini belum tersedia.');
                redirect('pemasok/add_view');
            }

            // Hitung total harga
            $total_harga = $jumlah_stok * $harga_per_kg;

            $data = array(
                'id_pemasok' => $this->input->post('id_pemasok'),
                'tanggal' => $tgl,
                'jumlah_stok' => $jumlah_stok,
                'jenis' => $jenis_kendaraan,
                'harga' => $harga_per_kg,
                'total_harga' => $total_harga,
                'lokasi' => $this->input->post('location')
            );

            $this->Mod_pemasok->add_stok($data);

            $this->session->set_flashdata('success', 'Data berhasil disimpan.');
            redirect('pemasok');
        }
    }

    public function get_harga($jenis)
    {
        // Ambil harga dari model
        $harga = $this->Mod_pemasok->get_harga_by_jenis($jenis);

        echo json_encode(['harga' => $harga ? $harga : 0]);
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
