<main id="main" class="main">
    <div class="pagetitle">
        <h1>Tambah Stok Pemasok</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Pemasok</li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tambah Stok</h5>

            <form class="row g-3" method="post" action="<?= base_url('pemasok/add')?>">
                <div class="col-12">
                    <input type="hidden" name="id_pemasok" id="id_pemasok" value="<?= $this->session->userdata('mitra_id')?>">
                </div>
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Tanggal</label>
                    <?php 
                    date_default_timezone_set('Asia/Jakarta');
                    $tgl = date('Y-m-d H:i:s', time());
                    ?>
                    <input type="text" class="form-control" id="tanggal" value="<?= $tgl?>" placeholder="Tanggal" readonly>
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Jumlah Stok (kg)</label>
                    <input type="number" class="form-control" id="jumlah_stok" name="jumlah_stok" placeholder="Jumlah Stok (kg)" required>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <button type="reset" class="btn btn-secondary">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</main>