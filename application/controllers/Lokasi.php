<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_lokasi');
        $this->load->library('session');
        $this->check_login();
    }

    private function check_login()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }
    public function edit($id)
    {

        $data['lokasi'] = $this->Mod_lokasi->getLokasiById($id);
        $data['id'] = $id;
        $this->load->view('backend/partials/header');
        $this->load->view('backend/pemasok/edit', $data);
        $this->load->view('backend/partials/footer');
    }

    public function update()
    {
        $id = $this->input->post('id');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');

        $this->Mod_lokasi->updateLokasi($id, $latitude, $longitude);

        $this->session->set_flashdata('success', 'Lokasi berhasil diperbarui.');
        redirect('pemasok');
    }
}
