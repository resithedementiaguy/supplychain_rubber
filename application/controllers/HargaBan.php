<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hargaban extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mod_hargaban');
        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');
    }

    // READ - Tampilkan data
    public function index()
    {
        $data['harga_ban'] = $this->mod_hargaban->get_all();
        $this->load->view('backend/partials/header');
        $this->load->view('backend/pengelola/hargaban/view', $data);
        $this->load->view('backend/partials/footer');
    }

    // CREATE - Form tambah data
    public function create()
    {
        $this->form_validation->set_rules('jenis', 'Jenis', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('backend/partials/header');
            $this->load->view('backend/pengelola/hargaban/add');
            $this->load->view('backend/partials/footer');
        } else {
            $data = [
                'jenis' => $this->input->post('jenis'),
                'harga' => $this->input->post('harga'),
                'ins_time' => date('Y-m-d H:i:s')
            ];
            $this->mod_hargaban->insert($data);
            redirect('HargaBan');
        }
    }

    // UPDATE - Form edit data
    public function edit($id)
    {
        $data['harga_ban'] = $this->mod_hargaban->get_by_id($id);

        $this->form_validation->set_rules('jenis', 'Jenis', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('harga_ban/edit', $data);
        } else {
            $data = [
                'jenis' => $this->input->post('jenis'),
                'harga' => $this->input->post('harga')
            ];
            $this->mod_hargaban->update($id, $data);
            redirect('HargaBan');
        }
    }

    // DELETE - Hapus data
    public function delete($id)
    {
        $this->mod_hargaban->delete($id);
        redirect('HargaBan');
    }
}
