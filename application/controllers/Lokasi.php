<?php
class Lokasi extends CI_Controller
{
    public function edit($id)
    {
        $this->load->model('Mod_lokasi');
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

        $this->load->model('Mod_lokasi');
        $this->Mod_lokasi->updateLokasi($id, $latitude, $longitude);

        redirect('pemasok');
    }
}
