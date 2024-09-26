<main id="main" class="main">
    <div class="pagetitle">
        <h1>Pemasok</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Pemasok</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Pemasok</h5>
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <a class="btn btn-primary btn-sm border-0" style="cursor: pointer;" href="<?= base_url('pemasok/add_view')?>"><b>Tambah Stok</b></a>
                        </div>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nama Usaha</th>
                                        <th>Nomor HP</th>
                                        <th>Berat</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>34</td>
                                        <td>Unity Pugh</td>
                                        <td>Curicó</td>
                                        <td>08126337443</td>
                                        <td>42 kg</td>
                                        <td><span class="badge border-secondary border-1 text-secondary">Belum diambil</span></td>
                                        <td>
                                            <button class="btn btn-success btn-sm border-0" type="button" style="cursor: pointer;" onclick="window.location.href='edit-link.php';">Edit</button>
                                            <button class="btn btn-danger btn-sm border-0" style="cursor: pointer;" onclick="window.location.href='delete-link.php';">Hapus</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>21</td>
                                        <td>Theodore Duran</td>
                                        <td>Dhanbad</td>
                                        <td>08126337443</td>
                                        <td>76 kg</td>
                                        <td><span class="badge border-primary border-1 text-primary">Sudah diambil</span></td>
                                        <td>
                                            <button class="btn btn-success btn-sm border-0" style="cursor: pointer;" onclick="window.location.href='edit-link.php';">Edit</button>
                                            <button class="btn btn-danger btn-sm border-0" style="cursor: pointer;" onclick="window.location.href='delete-link.php';">Hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>