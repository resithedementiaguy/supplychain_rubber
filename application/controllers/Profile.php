<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_profile'); // Pastikan model di-load
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->Mod_profile->get_user($user_id);

        $this->load->view('backend/partials/header');
        $this->load->view('backend/profile/view', $data);
        $this->load->view('backend/partials/footer');
    }

    public function update_pemasok()
    {
        $data = array(
            'pemasok_nama' => $this->input->post('pemasok_nama'),
            'pemasok_usaha' => $this->input->post('pemasok_usaha'),
            'pemasok_alamat' => $this->input->post('pemasok_alamat'),
            'pemasok_no_hp' => $this->input->post('pemasok_no_hp'),
            'email' => $this->input->post('email'),
        );

        // Update data pemasok berdasarkan user_id
        $user_id = $this->session->userdata('user_id');
        $this->Mod_profile->update_pemasok($user_id, $data);

        // Redirect setelah update
        redirect('profile');
    }

    public function update_mitra_pengelola()
    {
        $data = array(
            'nama' => $this->input->post('mitra_nama'),
            'nama_usaha' => $this->input->post('mitra_usaha'),
            'alamat' => $this->input->post('mitra_alamat'),
            'no_hp' => $this->input->post('mitra_no_hp'),
            'deskripsi_usaha' => $this->input->post('mitra_deskripsi')
        );

        // Update data mitra pengelola berdasarkan user_id
        $user_id = $this->session->userdata('user_id');
        $this->Mod_profile->update_mitra_pengelola($user_id, $data);

        // Redirect setelah update
        redirect('profile');
    }
}
