<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Detail Riwayat Pemasok</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Pemasok</li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-header text-white bg-success">
            <p class="h5 pt-1">Detail Riwayat Pemasok</p>
        </div>
        <div class="card-body">
            <div class="alert alert-success">
                Di bawah ini detail riwayat dari pemasok
            </div>

            <!-- Tabel untuk detail riwayat -->
            <table class="table" style="border-collapse: collapse; width: 100%;">
                <tbody>
                    <tr>
                        <th scope="row" style="width: 25%; border: none;">Nama</th>
                        <td style="border: none;">John Doe</td>
                    </tr>
                    <tr>
                        <th scope="row" style="border: none;">Nama Usaha</th>
                        <td style="border: none;">Crumb Supplies</td>
                    </tr>
                    <tr>
                        <th scope="row" style="border: none;">Tanggal Tambah</th>
                        <td style="border: none;">2024-11-30</td>
                    </tr>
                    <tr>
                        <th scope="row" style="border: none;">Jenis</th>
                        <td style="border: none;">Karet Mentah</td>
                    </tr>
                    <tr>
                        <th scope="row" style="border: none;">Berat (kg)</th>
                        <td style="border: none;">500kg</td>
                    </tr>
                    <tr>
                        <th scope="row" style="border: none;">Harga (Rp)</th>
                        <td style="border: none;">Rp5,000,000</td>
                    </tr>
                    <tr>
                        <th scope="row" style="border: none;">Status</th>
                        <td style="border: none;">Sudah Diambil</td>
                    </tr>
                    <tr>
                        <th scope="row" style="border: none;">Diambil oleh</th>
                        <td style="border: none;">Mike Tyson</td>
                    </tr>
                    <tr>
                        <th scope="row" style="border: none;">Tanggal Diambil</th>
                        <td style="border: none;">2024-12-02</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="col-12 py-2 d-flex justify-content-between align-items-center">
                <a class="btn btn-secondary" href="<?= base_url('pemasok'); ?>">Kembali</a>
            </div>
        </div>
    </div>
</main>