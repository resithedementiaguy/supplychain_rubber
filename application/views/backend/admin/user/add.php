<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Tambah Pengguna</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>">Pengguna</a></li>
                <li class="breadcrumb-item active">Tambah Pengguna</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-header text-white bg-info">
            <p class="h5 pt-1">Form Tambah Pengguna</p>
        </div>
        <form method="post" action="<?= base_url('user/add_user') ?>">
            <div class="card-body">
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center py-3" role="alert">
                        <?php echo $this->session->flashdata('error'); ?>
                        <button type="button" class="btn-close m-0" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Email -->
                <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email" required>
                </div>

                <!-- Password -->
                <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password" required>
                </div>

                <!-- Nama -->
                <div class="col-12">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Lengkap" required>
                </div>

                <!-- No HP -->
                <div class="col-12">
                    <label for="no_hp" class="form-label">No HP</label>
                    <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="Masukkan Nomor HP" required>
                </div>

                <!-- Alamat -->
                <div class="col-12">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" id="alamat" rows="2" placeholder="Masukkan Alamat Lengkap" required></textarea>
                </div>

                <!-- Level -->
                <div class="col-12">
                    <label for="level" class="form-label">Level</label>
                    <select name="level" id="level" class="form-select" required>
                        <option value="">- Pilih Level -</option>
                        <option value="admin">Admin</option>
                        <option value="pengelola">Pengelola</option>
                        <option value="pemasok">Pemasok</option>
                    </select>
                </div>

                <!-- Lokasi -->
                <input type="hidden" name="lokasi" id="lokasi">

                <!-- Nama Usaha (Tampil Jika Level Pengelola atau Pemasok) -->
                <div class="col-12 d-none" id="nama_usaha_container">
                    <label for="nama_usaha" class="form-label">Nama Usaha</label>
                    <input type="text" name="nama_usaha" class="form-control" id="nama_usaha" placeholder="Masukkan Nama Usaha">
                </div>

            </div>

            <!-- Submit -->
            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="<?= base_url('user'); ?>" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <!-- JavaScript to show "Nama Usaha" field based on level selection -->
    <script>
        document.getElementById('level').addEventListener('change', function() {
            var level = this.value;
            var namaUsahaContainer = document.getElementById('nama_usaha_container');

            if (level === 'pengelola' || level === 'pemasok') {
                namaUsahaContainer.classList.remove('d-none');
            } else {
                namaUsahaContainer.classList.add('d-none');
            }
        });
    </script>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Show/Hide Nama Usaha based on Level Selection
        const levelField = document.getElementById('level');
        const namaUsahaContainer = document.getElementById('nama_usaha_container');

        levelField.addEventListener('change', function() {
            if (levelField.value === 'pengelola' || levelField.value === 'pemasok') {
                namaUsahaContainer.classList.remove('d-none');
            } else {
                namaUsahaContainer.classList.add('d-none');
                document.getElementById('nama_usaha').value = '';
            }
        });

        // Get Location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const locationValue = position.coords.latitude + ',' + position.coords.longitude;
                document.getElementById('lokasi').value = locationValue;
            }, function() {
                console.error("Unable to retrieve your location");
            });
        } else {
            console.error("Geolocation is not supported by this browser.");
        }
    });
</script>