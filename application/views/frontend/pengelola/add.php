<main id="main" class="main">
    <div class="pagetitle">
        <h1>Ambil Stok Pengelola</h1>
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
            <form class="row g-3">
                <div class="col-12">
                    <label for="inputState" class="form-label">Nama Usaha</label>
                    <select id="inputState" class="form-select">
                        <option selected>Pilih Nama Usaha</option>
                        <option>Jaya Abadi</option>
                        <option>Sentosa Makmur</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Nama Pemilik</label>
                    <input type="text" class="form-control" id="inputEmail4" placeholder="Nama Pemilik">
                </div>
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Tanggal Ditambahkan Stok</label>
                    <input type="text" class="form-control" id="inputEmail4" placeholder="Tanggal Ditambahkan Stok">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Jumlah Stok (kg)</label>
                    <input type="number" class="form-control" id="inputAddress" placeholder="Jumlah Stok (kg)">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="inputAddress" placeholder="Masukkan keterangan di sini" rows="3"></textarea>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <button type="reset" class="btn btn-secondary">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</main>