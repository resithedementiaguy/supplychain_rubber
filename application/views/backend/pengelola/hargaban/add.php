<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Pengelola</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Pengelola</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <p class="h5 pt-1">Tambah Data Harga Ban</p>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary">
                            Silahkan untuk menambahkan dan mengecek stok ban bekas
                        </div>

                        <form class="row g-3" method="post" action="<?= site_url('HargaBanController/create') ?>">
                            <div class="col-12">
                                <label for="jenis" class="form-label">Jenis Kendaraan</label>
                                <select class="form-select" id="jenis" name="jenis" required>
                                    <option value="">- Pilih Jenis Kendaraan -</option>
                                    <option value="Mobil">Mobil</option>
                                    <option value="Motor">Motor</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="harga" class="form-label">Harga Ban Bekas</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="harga"
                                    name="harga"
                                    placeholder="Masukkan Harga Ban Bekas"
                                    required>
                            </div>
                            <div class="col-12 mt-5 d-flex justify-content-between align-items-center">
                                <a class="btn btn-secondary" href="<?= site_url('HargaBanController'); ?>">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>