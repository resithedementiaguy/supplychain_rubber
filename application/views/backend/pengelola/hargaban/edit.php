<h1>Edit Data Harga Ban</h1>
<form action="<?= site_url('HargaBanController/edit/' . $harga_ban->id) ?>" method="post">
    <label>Jenis</label>
    <select name="jenis">
        <option value="Mobil" <?= $harga_ban->jenis == 'Mobil' ? 'selected' : '' ?>>Mobil</option>
        <option value="Motor" <?= $harga_ban->jenis == 'Motor' ? 'selected' : '' ?>>Motor</option>
    </select>
    <br>
    <label>Harga</label>
    <input type="number" name="harga" value="<?= $harga_ban->harga ?>" required>
    <br>
    <button type="submit">Update</button>
</form>