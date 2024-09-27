<main id="main" class="main">
    <div class="pagetitle">
        <h1>Detail Produk Pengelola</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Mitra Pengelola</li>
                <li class="breadcrumb-item">Detail</li>
                <li class="breadcrumb-item active">Sentosa Gaming</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Detail Barang</h5>
                        <button type="button" class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalDiolah">
                            Input Diolah
                        </button>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Nama Pemilik</th>
                                    <td>Sentosa</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nama Usaha</th>
                                    <td>Sentosa Gaming</td>
                                </tr>
                                <tr>
                                    <th scope="row">Diambil Dari</th>
                                    <td>Makmur Abadi</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Diambil</th>
                                    <td>20 Juni 2024</td>
                                </tr>
                                <tr>
                                    <th scope="row">Berat Produk</th>
                                    <td>83 kg</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Diolah</th>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <th scope="row">Berat Mentah</th>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="reset" class="btn btn-sm btn-secondary">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Modal -->
<div class="modal fade" id="modalDiolah" tabindex="-1" aria-labelledby="modalDiolahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDiolahLabel">Barang Diolah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formDiolah">
                    <div class="mb-3">
                        <?php 
                        date_default_timezone_set('Asia/Jakarta');
                        $tgl = date('Y-m-d H:i:s', time());
                        ?>
                        <label for="tanggalDiolah" class="form-label">Tanggal Diolah</label>
                        <input type="text" class="form-control" id="tanggalDiolah" value="<?= $tgl?>" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="beratMentah" class="form-label">Berat Mentah</label>
                        <input type="number" class="form-control" id="beratMentah" placeholder="Masukkan berat mentah (kg)" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    function submitForm() {
        // Ambil nilai dari form
        const tanggalDiolah = document.getElementById('tanggalDiolah').value;
        const beratMentah = document.getElementById('beratMentah').value;

        // Lakukan sesuatu dengan data ini, misalnya mengirim ke server
        console.log("Tanggal Diolah: ", tanggalDiolah);
        console.log("Berat Mentah: ", beratMentah);

        // Setelah menyimpan data, tutup modal
        $('#modalDiolah').modal('hide');
    }
</script>