<!-- jujur pusing bikin pesan ini yhhhh -->
<!-- sementara ini ga kepake!!!!!!! -->













<?php
require 'konek.php';
$id = filter_input(INPUT_GET, 'id_ruangan', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    exit('ID ruangan tidak valid.');
}

$stmt = $pdo->prepare(
    "SELECT * FROM ruangan
        WHERE id_ruangan = ? AND status = 'aktif'"
);
$stmt->execute([$id]);
$dt_ruang = $stmt->fetch();

if (!$dt_ruang) {
    http_response_code(404);
    exit('Ruangan tidak ditemukan atau sedang tidak aktif.');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="style-fasilitas.css"> -->
    <link href="fasilitas.php">
    <title>Perpustakaan digital</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">Perpustakaan Digital</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="katalog.php">Katalog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="anggota.php">Anggota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="penerbit.php">Penerbit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="fasilitas.php">Fasilitas</a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> -->
            </div>
        </div>
    </nav>
    ```html
    <div class="content">

        <div class="judul">
            <h3>
                Pesan <?= htmlspecialchars($dt_ruang['nama_ruangan']) ?>
                (ID Ruangan: <?= (int) $dt_ruang['id_ruangan'] ?>)
            </h3>

            <p class="deskripsi-ruangan">
                Silakan isi formulir di bawah untuk memesan ruangan ini.
                Periksa informasi ruangan sebelum melakukan pemesanan.
            </p>
        </div>

        <div class="info-ruangan">
            <h4>Informasi Ruangan</h4>

            <p>
                <strong>Nama Ruangan:</strong>
                <?= htmlspecialchars($dt_ruang['nama_ruangan']) ?>
            </p>

            <p>
                <strong>Kapasitas:</strong>
                <?= (int) $dt_ruang['kapasitas'] ?> orang
            </p>

            <p>
                <strong>Fasilitas:</strong>
                <?= htmlspecialchars($dt_ruang['fasilitas'] ?? '-') ?>
            </p>

            <p>
                <strong>Lantai / Lokasi:</strong>
                <?= htmlspecialchars($dt_ruang['lokasi'] ?? '-') ?>
            </p>
        </div>
        <div class="kotak">
            <form action="" method="post">
                <input type="hidden" name="id_ruangan"
                    value="<?= (int) $dt_ruang['id_ruangan'] ?>">

                <ul>
                    <li>
                        <h3>Nama</h3>
                        <input class="isi" type="text"
                            name="nama" placeholder="Masukkan nama"
                            maxlength="100" required>
                    </li>

                    <li>
                        <h3>ID Card (NIM / NIK KTP)</h3>
                        <input class="isi" type="text"
                            name="id_card"
                            placeholder="Masukkan nomor ID Card"
                            required>
                    </li>

                    <li>
                        <h3>No. Telepon</h3>
                        <input class="isi" type="tel"
                            name="no_hp"
                            placeholder="Masukkan nomor telepon"
                            maxlength="20" required>
                    </li>

                    <li>
                        <h3>Tanggal Booking</h3>
                        <input class="isi" type="date"
                            name="tanggal_booking"
                            min="<?= date('Y-m-d') ?>" required>
                    </li>

                    <li>
                        <h3>Jam Masuk Ruangan</h3>

                        <div class="jam-container">
                            <select name="jam_mulai" id="startTime" required>
                                <option value="">Pilih jam</option>
                                <option value="08:00">08:00</option>
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                            </select>

                            <select name="durasi" required>
                                <option value="">Pilih durasi</option>
                                <option value="1">1 Jam</option>
                                <option value="2">2 Jam</option>
                                <option value="3">3 Jam</option>
                            </select>
                        </div>
                    </li>

                    <li>
                        <button type="submit" name="submit"
                            class="btn-pesan">
                            Pesan Ruangan
                        </button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>