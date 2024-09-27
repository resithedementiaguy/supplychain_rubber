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
        $data['daftar_ambil']=$this->Mod_pengelola->get_all_ambil();
        $this->load->view('partials/header');
        $this->load->view('frontend/pengelola/view');
        $this->load->view('partials/footer');
    }
    

    public function add_view()
    {
        $data['nama_usaha']=$this->Mod_pemasok->get_pemasok();
        $this->load->view('partials/header');
        $this->load->view('frontend/pengelola/add',$data);
        $this->load->view('partials/footer');
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
            'id_pengelola'=> $this->input->post('id_pengelola'),
            'id_pemasok'=> $this->input->post('id_pemasok'),
            'tanggal'=> $tgl,
            'jumlah_stok'=> $this->input->post('jumlah_stok'),
            'keterangan' => $this->input->post('keterangan')
        );

        // Add the new resident to the database
        $this->Mod_pengelola->add_ambil($data);

        redirect('pengelola/add_view');
    }
}
