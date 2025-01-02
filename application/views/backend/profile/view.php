<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div>

    <section class="section profile">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button
                                    class="nav-link active"
                                    data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">
                                    Overview
                                </button>
                            </li>

                            <li class="nav-item">
                                <button
                                    class="nav-link"
                                    data-bs-toggle="tab"
                                    data-bs-target="#profile-edit">
                                    Edit Profile
                                </button>
                            </li>

                            <li class="nav-item">
                                <button
                                    class="nav-link"
                                    data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">
                                    Ganti Password
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <div class="row d-flex align-items-center">
                                    <div class="col-lg-3 col-md-4">
                                        <div
                                            class="profile-card pt-4 d-flex flex-column align-items-center">
                                            <img
                                                src="assets/img/profile-img.jpg"
                                                alt="Profile"
                                                class="rounded-circle" />
                                            <h2><?php echo $this->session->userdata('nama'); ?></h2>
                                            <h3><?php echo $this->session->userdata('level_name'); ?></h3>
                                            <button class="btn btn-sm btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editProfileImageModal">
                                                <i class="bi bi-pencil-square"></i> Edit Gambar
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Modal for editing profile image -->
                                    <div class="modal fade" id="editProfileImageModal" tabindex="-1" aria-labelledby="editProfileImageModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editProfileImageModalLabel">Edit Gambar Profil</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="<?php echo base_url('profile/update_image'); ?>" enctype="multipart/form-data">
                                                        <div class="mb-3">
                                                            <label for="profileImage" class="form-label">Pilih Gambar Baru</label>
                                                            <input class="form-control" type="file" id="profileImage" name="profile_image">
                                                            <div id="imagePreview" class="mt-3"></div>
                                                        </div>
                                                        <div class="text-end">
                                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        document.getElementById('profileImage').onchange = function(evt) {
                                            const [file] = this.files;
                                            if (file) {
                                                const preview = document.createElement('img');
                                                preview.src = URL.createObjectURL(file);
                                                preview.classList.add('img-thumbnail', 'mt-3');
                                                preview.style.maxWidth = '200px';
                                                const imagePreview = document.getElementById('imagePreview');
                                                imagePreview.innerHTML = '';
                                                imagePreview.appendChild(preview);
                                            }
                                        };
                                    </script>
                                    <div class="col-lg-9 col-md-8">
                                        <!-- Jika data pemasok ada -->
                                        <?php if ($user['pemasok_nama']): ?>
                                            <h5 class="card-title">Detail Profil Pemasok</h5>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Nama Pemasok</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $user['pemasok_nama']; ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Nama Usaha</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $user['pemasok_usaha']; ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Kategori</div>
                                                <div class="col-lg-9 col-md-8"><?php echo ucfirst($user['level']); ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Email</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $user['email']; ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Nomor HP</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $user['pemasok_no_hp']; ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Alamat</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $user['pemasok_alamat']; ?></div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Jika data mitra pengelola ada -->
                                        <?php if ($user['mitra_nama']): ?>
                                            <h5 class="card-title">Detail Profil Mitra Pengelola</h5>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Nama Mitra</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $user['mitra_nama']; ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Nama Usaha</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $user['mitra_usaha']; ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Kategori</div>
                                                <div class="col-lg-9 col-md-8"><?php echo ucfirst($user['level']); ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Email</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $user['email']; ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Nomor HP</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $user['mitra_no_hp']; ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Alamat</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $user['mitra_alamat']; ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Deskripsi Usaha</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $user['mitra_deskripsi']; ?></div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="tab-pane fade profile-edit pt-3"
                                id="profile-edit">
                                <!-- Profile Edit Form -->
                                <!-- Form untuk edit data pemasok -->
                                <?php if ($user['pemasok_nama']): ?>
                                    <h5 class="card-title">Edit Profil Pemasok</h5>
                                    <form method="post" action="<?php echo base_url('profile/update_pemasok'); ?>">

                                        <div class="row mb-3">
                                            <label for="pemasok_nama" class="col-md-4 col-lg-3 col-form-label">Nama Pemasok</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="pemasok_nama" type="text" class="form-control" id="pemasok_nama" value="<?php echo $user['pemasok_nama']; ?>" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="pemasok_usaha" class="col-md-4 col-lg-3 col-form-label">Nama Usaha</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="pemasok_usaha" type="text" class="form-control" id="pemasok_usaha" value="<?php echo $user['pemasok_usaha']; ?>" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="pemasok_alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="pemasok_alamat" type="text" class="form-control" id="pemasok_alamat" value="<?php echo $user['pemasok_alamat']; ?>" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="pemasok_no_hp" class="col-md-4 col-lg-3 col-form-label">Nomor HP</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="pemasok_no_hp" type="text" class="form-control" id="pemasok_no_hp" value="<?php echo $user['pemasok_no_hp']; ?>" />
                                            </div>
                                        </div>

                                        <!-- <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="email" value="<?php echo $user['email']; ?>" />
                                            </div>
                                        </div> -->

                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>

                                    </form>
                                <?php endif; ?>

                                <!-- Form untuk edit data mitra pengelola -->
                                <?php if ($user['mitra_nama']): ?>
                                    <h5 class="card-title">Edit Profil Mitra Pengelola</h5>
                                    <form method="post" action="<?php echo base_url('profile/update_mitra_pengelola'); ?>">

                                        <div class="row mb-3">
                                            <label for="mitra_nama" class="col-md-4 col-lg-3 col-form-label">Nama Mitra</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="mitra_nama" type="text" class="form-control" id="mitra_nama" value="<?php echo $user['mitra_nama']; ?>" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="mitra_usaha" class="col-md-4 col-lg-3 col-form-label">Nama Usaha</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="mitra_usaha" type="text" class="form-control" id="mitra_usaha" value="<?php echo $user['mitra_usaha']; ?>" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="mitra_alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="mitra_alamat" type="text" class="form-control" id="mitra_alamat" value="<?php echo $user['mitra_alamat']; ?>" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="mitra_no_hp" class="col-md-4 col-lg-3 col-form-label">Nomor HP</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="mitra_no_hp" type="text" class="form-control" id="mitra_no_hp" value="<?php echo $user['mitra_no_hp']; ?>" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="mitra_deskripsi" class="col-md-4 col-lg-3 col-form-label">Deskripsi Usaha</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="mitra_deskripsi" class="form-control" id="mitra_deskripsi"><?php echo $user['mitra_deskripsi']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="email" value="<?php echo $user['email']; ?>" />
                                            </div>
                                        </div>

                                        <div class="text-start">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>

                                    </form>
                                <?php endif; ?>

                                <!-- End Profile Edit Form -->
                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form>
                                    <div class="row mb-3">
                                        <label
                                            for="newPassword"
                                            class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input
                                                name="newpassword"
                                                type="password"
                                                class="form-control"
                                                id="newPassword"
                                                placeholder="Masukkan Password Baru" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label
                                            for="renewPassword"
                                            class="col-md-4 col-lg-3 col-form-label">Konfirmasi Password Baru</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input
                                                name="renewpassword"
                                                type="password"
                                                class="form-control"
                                                id="renewPassword"
                                                placeholder="Konfirmasi Password Baru" />
                                        </div>
                                    </div>

                                    <div class="text-start">
                                        <button type="submit" class="btn btn-primary">
                                            Change Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>