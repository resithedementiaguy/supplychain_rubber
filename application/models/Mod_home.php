<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_home extends CI_Model
{

    public function get_umur()
    {
        // Ambil data umur web dari database
        $this->db->select('est_time, current_time');
        $this->db->from('umur_web');
        $result = $this->db->get()->row();

        if ($result) {
            // Hitung selisih waktu
            $est_time = new DateTime($result->est_time);
            $current_time = new DateTime($result->current_time);
            $interval = $current_time->diff($est_time);

            // Tentukan format waktu yang lebih spesifik
            $umur = '';
            if ($interval->y > 0) {
                $umur .= $interval->y . ' tahun ';
            }
            if ($interval->m > 0) {
                $umur .= $interval->m . ' bulan ';
            }
            if ($interval->d > 0) {
                $umur .= $interval->d . ' hari ';
            }

            // Jika tidak ada perbedaan (web baru saja dimulai)
            if ($umur === '') {
                $umur = 'Baru saja dimulai';
            }

            return trim($umur); // Menghilangkan spasi berlebih di akhir
        }

        return 'Data tidak ditemukan';
    }


    public function update_umur_web()
    {
        date_default_timezone_set('Asia/Jakarta');
        // Ambil tanggal dan waktu saat ini
        $current_datetime = date('Y-m-d H:i:s');

        // Periksa apakah ada konten yang kedaluwarsa
        $query = $this->db->where('current_time <', $current_datetime)
                        ->get('umur_web');

        if ($query->num_rows() > 0) {
            log_message('info', 'Ditemukan konten yang kedaluwarsa');

            // Update status konten yang kedaluwarsa
            $this->db->set('current_time', $current_datetime)
                    ->where('id', 1)
                    ->update('umur_web');
        } else {
            log_message('info', 'Tidak ada konten yang kedaluwarsa');
        }
    }


}