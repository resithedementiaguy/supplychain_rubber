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
            'nama' => $this->input->post('pemasok_nama'),
            'nama_usaha' => $this->input->post('pemasok_usaha'),
            'alamat' => $this->input->post('pemasok_alamat'),
            'no_hp' => $this->input->post('pemasok_no_hp'),
        );

        // Get the user_id from session
        $user_id = $this->session->userdata('user_id');

        // Update pemasok data if user has a corresponding pemasok record
        $this->Mod_profile->update_pemasok($user_id, $data);

        // Redirect to profile after update
        redirect('profile');
    }

    public function update_user_email()
    {
        $data = array(
            'email' => $this->input->post('email'),
        );

        // Get the user_id from session
        $user_id = $this->session->userdata('user_id');

        // Update user email
        $this->Mod_profile->update_user_email($user_id, $data);

        // Redirect to profile after update
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

        // Get the user_id from session
        $user_id = $this->session->userdata('user_id');

        // Update mitra pengelola data if user has a corresponding mitra_pengelola record
        $this->Mod_profile->update_mitra_pengelola($user_id, $data);

        // Redirect to profile after update
        redirect('profile');
    }
}
