<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengelola extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_pengelola');
        $this->load->model('Mod_pemasok');
        $this->check_login(); // Ensure user is logged in
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
        $id_pengelola = $this->session->userdata('mitra_id');
        $data['daftar_ambil'] = $this->Mod_pengelola->get_all_ambil($id_pengelola);

        // Load view
        $this->load->view('backend/partials/header');
        $this->load->view('backend/pengelola/view', $data);
        $this->load->view('backend/partials/footer');
    }

    public function detail($id)
    {
        $data['detail_produk'] = $this->Mod_pengelola->get_detail($id);
        $data['riwayat_pemasok'] = $this->Mod_pengelola->get_riwayat_pemasok($data['detail_produk']['id_pemasok']);

        $this->load->view('backend/partials/header');
        $this->load->view('backend/pengelola/detail', $data);
        $this->load->view('backend/partials/footer');
    }

    public function insert_olah()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s', time());

        $id_ambil = $this->input->post('id_ambil');
        $jumlah_stok = $this->input->post('jumlah_stok');
        $jumlah_mentah = $this->input->post('jumlah_mentah');

        if (empty($id_ambil) || empty($jumlah_stok) || empty($jumlah_mentah)) {
            echo json_encode(['success' => false, 'message' => 'Data input tidak lengkap.']);
            return;
        }

        $data = [
            'id_ambil' => $id_ambil,
            'tanggal' => $tgl,
            'jumlah_stok' => $jumlah_stok,
            'jumlah_mentah' => $jumlah_mentah
        ];

        try {
            $this->db->insert('olah', $data);
            log_message('debug', 'Query Insert: ' . $this->db->last_query());
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['success' => true, 'message' => 'Data berhasil disimpan!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Tidak ada perubahan data yang disimpan.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        if ($this->Mod_pengelola->delete_mitra($id)) {
            redirect('pemasok', 'refresh');
        } else {
            show_error('Gagal menghapus data pemasok.', 500, 'Kesalahan Penghapusan');
        }
    }

    public function update_location()
    {
        $lat = $this->input->post('lat');
        $long = $this->input->post('long');

        if (empty($lat) || empty($long)) {
            log_message('error', 'Lokasi tidak ditemukan: lat=' . $lat . ' long=' . $long);
            show_error('Lokasi tidak valid.', 400);
            return;
        }

        // Simpan koordinat di session
        $this->session->set_userdata('pengelola_lat', $lat);
        $this->session->set_userdata('pengelola_long', $long);

        echo json_encode(['status' => 'success']);
    }

    public function add_view()
    {
        // Lihat apakah session berisi koordinat
        $pengelola_lat = $this->session->userdata('pengelola_lat');
        $pengelola_long = $this->session->userdata('pengelola_long');

        if (empty($pengelola_lat) || empty($pengelola_long)) {
            // Cek session saat ini
            log_message('error', 'Session pengelola_lat: ' . $pengelola_lat);
            log_message('error', 'Session pengelola_long: ' . $pengelola_long);

            // Tampilkan error jika koordinat tidak ditemukan
            show_error('Lokasi pengelola tidak ditemukan. Silakan aktifkan lokasi pada perangkat Anda.', 400);
            return;
        }

        // Ambil data pemasok dari model
        $nama_usaha = $this->Mod_pemasok->get_pemasok_belum_diambil();

        // Hitung matriks jarak antara pengelola dan semua pemasok
        $distanceMatrix = $this->calculateDistanceMatrix($pengelola_lat, $pengelola_long, $nama_usaha);

        // Terapkan algoritma Nearest Neighbor untuk TSP
        $tspResult = $this->nearestNeighborTSP($distanceMatrix);

        // Urutkan nama usaha berdasarkan hasil TSP
        $sortedPemasok = [];
        foreach ($tspResult['tour'] as $index) {
            if ($index != 0) { // Skip index 0 (pengelola)
                $nama_usaha[$index - 1]->distance = $distanceMatrix[0][$index]; // Tambahkan properti distance
                $sortedPemasok[] = $nama_usaha[$index - 1]; // -1 karena index 0 untuk pengelola
            }
        }

        // Tambahkan alamat berdasarkan koordinat dari pemasok
        foreach ($sortedPemasok as $pemasok) {
            list($lat, $long) = explode(',', $pemasok->lokasi);
            $pemasok->alamat = $this->getAddressFromCoordinates($lat, $long);
        }

        // Kirim data ke view
        $data['nama_usaha'] = $sortedPemasok;
        $data['total_distance'] = $tspResult['total_distance'];

        // Ambil data session
        $pengelola_lat = $this->session->userdata('pengelola_lat');
        $pengelola_long = $this->session->userdata('pengelola_long');

        // Kirim data session ke view
        $data['pengelola_lat'] = $pengelola_lat;
        $data['pengelola_long'] = $pengelola_long;

        // Muat view
        $this->load->view('backend/partials/header');
        $this->load->view('backend/pengelola/add', $data);
        $this->load->view('backend/partials/footer');
    }

    public function getAddressFromCoordinates($latitude, $longitude)
    {
        // Menghapus spasi yang tidak perlu
        $latitude = trim($latitude);
        $longitude = trim($longitude);

        // Membuat URL untuk mendapatkan alamat berdasarkan koordinat
        $url = "https://nominatim.openstreetmap.org/reverse?lat=$latitude&lon=$longitude&format=json";

        // Debug: Cek URL yang dibuat
        error_log("Requesting URL: " . $url);

        // Menyiapkan context dengan header User-Agent
        $options = [
            'http' => [
                'header' => "User-Agent: MyApplication/1.0\r\n"
            ]
        ];
        $context = stream_context_create($options);

        // Mengambil data dari URL dengan context yang disiapkan
        $response = file_get_contents($url, false, $context);

        // Cek jika permintaan berhasil
        if ($response === FALSE) {
            $error = error_get_last();
            // Log kesalahan
            error_log("Error fetching address: " . $error['message']);
            return "Gagal mengambil data alamat: " . $error['message'];
        }

        // Mengdecode data JSON
        $responseData = json_decode($response);

        // Cek apakah data berhasil diambil
        if (isset($responseData->display_name)) {
            return $responseData->display_name;
        } else {
            return "Alamat tidak ditemukan.";
        }
    }

    public function calculateDistanceMatrix($pengelola_lat, $pengelola_long, $pemasok_list)
    {
        // Masukkan pengelola sebagai titik awal
        $locations = [['lat' => $pengelola_lat, 'long' => $pengelola_long]];

        // Masukkan semua pemasok ke dalam array lokasi
        foreach ($pemasok_list as $pemasok) {
            $koordinat = explode(',', $pemasok->lokasi);
            $lat = isset($koordinat[0]) ? trim($koordinat[0]) : 0;
            $long = isset($koordinat[1]) ? trim($koordinat[1]) : 0;
            $locations[] = ['lat' => $lat, 'long' => $long];
        }

        // Matriks jarak
        $distanceMatrix = [];

        // Hitung jarak antara setiap pasang titik
        for ($i = 0; $i < count($locations); $i++) {
            for ($j = 0; $j < count($locations); $j++) {
                if ($i == $j) {
                    $distanceMatrix[$i][$j] = 0; // Jarak ke diri sendiri = 0
                } else {
                    $distanceMatrix[$i][$j] = $this->haversineDistance(
                        $locations[$i]['lat'],
                        $locations[$i]['long'],
                        $locations[$j]['lat'],
                        $locations[$j]['long']
                    );
                }
            }
        }

        return $distanceMatrix;
    }

    public function nearestNeighborTSP($distanceMatrix)
    {
        $numLocations = count($distanceMatrix);
        $visited = array_fill(0, $numLocations, false);
        $tour = []; // Menyimpan urutan kunjungan
        $totalDistance = 0;

        // Mulai dari pengelola (titik 0)
        $currentLocation = 0;
        $visited[0] = true;
        $tour[] = $currentLocation;

        for ($step = 1; $step < $numLocations; $step++) {
            $nearestDistance = PHP_FLOAT_MAX;
            $nearestNeighbor = -1;

            // Cari titik terdekat yang belum dikunjungi
            for ($i = 0; $i < $numLocations; $i++) {
                if (!$visited[$i] && $distanceMatrix[$currentLocation][$i] < $nearestDistance) {
                    $nearestDistance = $distanceMatrix[$currentLocation][$i];
                    $nearestNeighbor = $i;
                }
            }

            // Pergi ke titik terdekat
            $tour[] = $nearestNeighbor;
            $totalDistance += $nearestDistance;
            $visited[$nearestNeighbor] = true;
            $currentLocation = $nearestNeighbor;
        }

        // Kembali ke titik awal (pengelola)
        $totalDistance += $distanceMatrix[$currentLocation][0];
        $tour[] = 0; // Tambahkan pengelola sebagai titik akhir

        return [
            'tour' => $tour,
            'total_distance' => $totalDistance
        ];
    }

    public function haversineDistance($lat1, $long1, $lat2, $long2)
    {
        $earthRadius = 6371;
        $latDelta = deg2rad($lat2 - $lat1);
        $longDelta = deg2rad($long2 - $long1);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($longDelta / 2) * sin($longDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        return $distance;
    }

    public function get_stok_by_id()
    {
        $id_pemasok = $this->input->post('id_pemasok');
        $stok = $this->Mod_pemasok->get_stok_by_id($id_pemasok);
        echo json_encode($stok);
    }

    public function add()
    {
        $id_pengelola = $this->session->userdata('mitra_id');
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s', time());

        // Mengambil data yang dikirim
        $id_pemasok = $this->input->post('id_pemasok');
        $jumlah_stok = $this->input->post('jumlah_stok');
        $keterangan = $this->input->post('keterangan');

        // Loop untuk memproses setiap pemasok
        foreach ($id_pemasok as $index => $id) {
            $data = array(
                'id_pengelola' => $id_pengelola,
                'id_pemasok' => $id,
                'tanggal' => $tgl,
                'jumlah_stok' => isset($jumlah_stok[$id]) ? $jumlah_stok[$id] : 0,
                'keterangan' => isset($keterangan[$id]) ? $keterangan[$id] : ''
            );

            // Simpan data ke database
            $this->Mod_pengelola->add_ambil($data);
        }

        // Redirect setelah berhasil
        redirect('pengelola/add_view');
    }
}
