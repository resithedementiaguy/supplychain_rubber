<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Edit User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/user'); ?>">User</a></li>
                <li class="breadcrumb-item active">Edit User</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-header text-white bg-info">
            <p class="h5 pt-1">Daftar Edit User</p>
        </div>
        <form action="<?php echo current_url(); ?>" method="post">
            <div class="card-body">
                <?php
                if ($this->session->flashdata('success')) {
                    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                }
                ?>
                <div class="alert alert-info">
                    Silahkan untuk mengedit data pengguna.
                </div>

                <!-- Basic User Info -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?php echo set_value('email', $user->email); ?>" required>
                    <?php echo form_error('email'); ?>
                </div>

                <div class="form-group">
                    <label for="level">Level</label>
                    <select class="form-control" id="level" name="level" required>
                        <?php
                        $levels = ['admin' => 'Admin', 'pengelola' => 'Pengelola', 'pemasok' => 'Pemasok'];
                        foreach ($levels as $value => $label): ?>
                            <option value="<?php echo $value; ?>"
                                <?php echo set_select('level', $value, ($user->level == $value)); ?>>
                                <?php echo $label; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('level'); ?>
                </div>

                <div class="form-group">
                    <label for="password">Password (Kosongkan jika tidak diubah)</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <?php echo form_error('password'); ?>
                </div>

                <!-- Common Fields for All Levels -->
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama"
                        value="<?php echo set_value('nama', isset($user->nama) ? $user->nama : ''); ?>" required>
                    <?php echo form_error('nama'); ?>
                </div>

                <!-- Conditional Field for Business Name -->
                <?php if (in_array($user->level, ['pengelola', 'pemasok'])): ?>
                    <div class="form-group">
                        <label for="nama_usaha">Nama Usaha</label>
                        <input type="text" class="form-control" id="nama_usaha" name="nama_usaha"
                            value="<?php echo set_value('nama_usaha', isset($user->nama_usaha) ? $user->nama_usaha : ''); ?>" required>
                        <?php echo form_error('nama_usaha'); ?>
                    </div>
                <?php endif; ?>

                <!-- Common Fields for All Levels -->
                <?php
                $common_fields = [
                    'no_hp' => ['label' => 'Nomor HP', 'type' => 'text'],
                    'alamat' => ['label' => 'Alamat', 'type' => 'textarea']
                ];

                foreach ($common_fields as $field => $config): ?>
                    <div class="form-group">
                        <label for="<?php echo $field; ?>"><?php echo $config['label']; ?></label>
                        <?php if ($config['type'] == 'textarea'): ?>
                            <textarea class="form-control" id="<?php echo $field; ?>"
                                name="<?php echo $field; ?>" required><?php echo set_value($field, isset($user->$field) ? $user->$field : ''); ?></textarea>
                        <?php else: ?>
                            <input type="<?php echo $config['type']; ?>" class="form-control"
                                id="<?php echo $field; ?>" name="<?php echo $field; ?>"
                                value="<?php echo set_value($field, isset($user->$field) ? $user->$field : ''); ?>" required>
                        <?php endif; ?>
                        <?php echo form_error($field); ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="<?php echo site_url('admin/user'); ?>" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</main>

<!-- Pastikan Bootstrap JS dimuat -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- Modal untuk pesan berhasil -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="successModalLabel">Berhasil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Data pengguna berhasil diperbarui!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Okey</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Debug di console
        console.log('Flash Message:', '<?php echo $this->session->flashdata('success'); ?>');

        <?php if ($this->session->flashdata('success')): ?>
            console.log('Flash message exists, attempting to show modal');
            setTimeout(function() {
                try {
                    var myModal = new bootstrap.Modal(document.getElementById('successModal'));
                    myModal.show();
                    console.log('Modal shown successfully');

                    document.getElementById('successModal').addEventListener('hidden.bs.modal', function() {
                        console.log('Modal hidden, redirecting...');
                        window.location.href = '<?php echo site_url('admin/user'); ?>';
                    });
                } catch (e) {
                    console.error('Error showing modal:', e);
                    alert('<?php echo $this->session->flashdata('success'); ?>');
                    window.location.href = '<?php echo site_url('admin/user'); ?>';
                }
            }, 500);
        <?php else: ?>
            console.log('No flash message found');
        <?php endif; ?>
    });
</script>