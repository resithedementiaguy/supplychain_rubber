<main id="main" class="main">
    <div class="pagetitle">
        <h1>Ambil Stok Pemasok</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Pengelola</li>
                <li class="breadcrumb-item active">Ambil</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Ambil Stok</h5>

            <form class="row g-3" method="post" action="<?= base_url('pengelola/add') ?>">
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Nama Usaha Pemasok</label>
                    <input type="hidden" name="id_pengelola" value="<?= $this->session->userdata('mitra_id') ?>">
                    <select class="form-control" name="id_pemasok" id="id_pemasok" data-live-search="true">
                        <option value="" selected hidden>Pilih Usaha Pemasok</option>
                        <?php foreach ($nama_usaha as $pemasok): ?>
                            <option value="<?= $pemasok->id ?>"><?= $pemasok->nama_usaha ?> - <?= $pemasok->no_hp ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Tanggal</label>
                    <?php
                    date_default_timezone_set('Asia/Jakarta');
                    $tgl = date('Y-m-d H:i:s', time());
                    ?>
                    <input type="text" class="form-control" id="tanggal" value="<?= $tgl ?>" placeholder="Tanggal" readonly>
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Jumlah Stok (kg)</label>
                    <input type="text" class="form-control" id="jumlah_stok" name="jumlah_stok" placeholder="Jumlah Stok (kg)" required readonly>
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Keterangan</label>
                    <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <a class="btn  btn-secondary" href="<?= base_url('pengelola'); ?>">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        $('#id_pemasok').change(function() {
            var selectedUsaha = $(this).val();
            if (selectedUsaha) {
                $.ajax({
                    url: '<?= base_url('pengelola/get_stok_by_id'); ?>',
                    type: 'POST',
                    data: {
                        id_pemasok: selectedUsaha
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#jumlah_stok').val(response ? response : 0);
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            } else {
                $('#jumlah_stok').val('');
            }
        });
    });
</script>