<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Pemasok Edit Lokasi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('pemasok'); ?>">Pemasok</a></li>
                <li class="breadcrumb-item active">Edit Lokasi</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header text-white bg-info">
                <p class="h5 pt-1">Edit Lokasi</p>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    Silahkan untuk mengedit titik lokasi stok ban bekas.
                </div>

                <body onload="initMap()">
                    <form action="<?= base_url('lokasi/update') ?>" method="post">
                        <input type="hidden" name="id" value="<?= $id ?>">

                        <!-- Map Section -->
                        <div id="map" style="width: 100%; height: 400px;"></div>

                        <div class="form-group mt-3">
                            <label for="latitude">Latitude:</label>
                            <input type="text" id="latitude" name="latitude" class="form-control" value="<?= $lokasi['latitude'] ?>" readonly>
                        </div>

                        <div class="form-group mt-3">
                            <label for="longitude">Longitude:</label>
                            <input type="text" id="longitude" name="longitude" class="form-control" value="<?= $lokasi['longitude'] ?>" readonly>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    </form>
                </body>
            </div>
        </div>
    </section>
</main>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB55Np3_WsZwUQ9NS7DP-HnneleZLYZDNw"></script>
<script>
    let map, marker;

    function initMap() {
        const initialLocation = {
            lat: parseFloat("<?= $lokasi['latitude'] ?>"),
            lng: parseFloat("<?= $lokasi['longitude'] ?>")
        };

        // Inisialisasi peta
        map = new google.maps.Map(document.getElementById('map'), {
            center: initialLocation,
            zoom: 15
        });

        // Tambahkan marker yang dapat digeser
        marker = new google.maps.Marker({
            position: initialLocation,
            map: map,
            draggable: true
        });

        // Update koordinat di form saat marker digeser
        google.maps.event.addListener(marker, 'dragend', function() {
            document.getElementById('latitude').value = marker.getPosition().lat();
            document.getElementById('longitude').value = marker.getPosition().lng();
        });
    }
</script>