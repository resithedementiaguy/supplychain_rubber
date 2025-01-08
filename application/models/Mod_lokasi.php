<?php
class Mod_lokasi extends CI_Model
{
    public function updateLokasi($id, $latitude, $longitude)
    {
        $lokasi = $latitude . ',' . $longitude;
        $this->db->where('id', $id);
        $this->db->update('status_stok', ['lokasi' => $lokasi]);
    }

    public function getLokasiById($id)
    {
        $lokasi = $this->db->get_where('status_stok', ['id' => $id])->row_array()['lokasi'];
        if ($lokasi) {
            list($latitude, $longitude) = explode(',', $lokasi);
            return ['latitude' => $latitude, 'longitude' => $longitude];
        }
        return ['latitude' => null, 'longitude' => null];
    }
}
