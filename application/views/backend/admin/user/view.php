<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Master User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Master User</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <p class="h5 pt-1">Daftar Master User</p>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <a class="btn btn-primary border-0" href="<?= base_url('admin/user/add') ?>"><b>Tambah User</b></a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Email</th>
                                        <th>Level</th>
                                        <th>Nama</th>
                                        <th>Usaha</th>
                                        <th>No. HP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($users)) : ?>
                                        <?php foreach ($users as $key => $user) : ?>
                                            <tr>
                                                <td><?= $key + 1; ?></td>
                                                <td><?= $user->email; ?></td>
                                                <td><?= ucfirst($user->level); ?></td>
                                                <td>
                                                    <?= $user->admin_nama ?? $user->pengelola_nama ?? $user->pemasok_nama ?? '-'; ?>
                                                </td>
                                                <td>
                                                    <?= $user->pengelola_usaha ?? $user->pemasok_usaha ?? '-'; ?>
                                                </td>
                                                <td>
                                                    <?= $user->admin_no_hp ?? $user->no_hp ?? '-'; ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('admin/user/edit/' . $user->id); ?>" class="btn btn-warning btn-sm">Edit</a>
                                                    <a href="<?= base_url('admin/user/delete/' . $user->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>