<?php
require 'konek.php';


$id = $_GET["id_ruangan"];

$data_ruang = query("SELECT * FROM ruangan WHERE id_ruangan = $id")[0];

if (isset($_POST["submit"])) {
    if (update($_POST) > 0) {
        echo '<script>
            alert("Data update masuk database yh!");
        document.location.href = "fasilitas-atmin.php";
    </script>';
    } else {
        echo '<script>
            alert("Data update gagal!!!!");
        document.location.href = "fasilitas-atmin.php";
    </script>';
    }
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
    <div class="content">

        <div class="judul">
            <h3>
                Tambah Ruangan Perpustakaan
            </h3>

            <p class="deskripsi-ruangan">
                Perubahan tempat meja/bilik di perpustakaan
            </p>
        </div>

        <!-- <div class="info-ruangan">
            <h4>Informasi Ruangan</h4>
            <p>
                <strong>Nama Ruangan:</strong>
                 // htmlspecialchars($dt_ruang['nama_ruangan']) ?>
            </p>
            <p>
                <strong>Kapasitas:</strong>
                 //(int) $dt_ruang['kapasitas'] ?> orang
            </p>
            <p>
                <strong>Fasilitas:</strong>
                 //htmlspecialchars($dt_ruang['fasilitas'] ?? '-') ?>
            </p>
            <p>
                <strong>Lantai / Lokasi:</strong>
                 //htmlspecialchars($dt_ruang['lokasi'] ?? '-') ?>
            </p>
        </div> -->
        <div class="kotak">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_ruangan" value="<?= (int) $data_ruang['id_ruangan'] ?>">
                <input type="hidden" name="gambarold" value="<?= (int) $data_ruang['gambar'] ?>">
                <ul>
                    <li>
                        <h3>Nama Meja / Bilik</h3>
                        <input class="isi" type="text" name="nama_ruangan" value="<?= $data_ruang["nama_ruangan"]; ?>" placeholder="Masukkan nama tempat.."
                            maxlength="100" required>
                    </li>
                    <li>
                        <h3>Kapasitas</h3>
                        <input class="isi" type="text" name="kapasitas" value="<?= $data_ruang["kapasitas"]; ?>" placeholder="Masukkan kapasitas orang.." required>
                    </li>
                    <li>
                        <h3>Fasilitas</h3>
                        <input class="isi" type="text" name="fasilitas" value="<?= $data_ruang["fasilitas"]; ?>" placeholder="Masukkan fasilitas tempat.." required>
                    </li>
                    
                    <li>
                        <h3>Lantai</h3>
                        <select class="isi" name="lantai" id="floor">
                            <option value="Lt. 1">Lt 1</option>
                            <option value="Lt. 2">Lt. 2</option>
                            <option value="Lt. 3">Lt. 3</option>
                        </select>
                        <!-- <input type="radio" name="floor_level" value="Lt. 2" id="lt1">
                        <label for="lt1">Lt. 1</label>
                        <input type="radio" name="floor_level" value="Lt. 3" id="lt2">
                        <label for="lt2">Lt. 2</label>
                        <input type="radio" name="floor_level" value="Lt. 4" id="lt3">
                        <label for="lt3">Lt. 3</label> -->
                    </li>
                    <li>
                        <h3>Foto</h3>
                        <input type="file" name="gambar">
                    </li>
                    <li>
                        <button type="submit" name="submit"
                            class="btn-pesan" onclick="return confirm('Yakin lanjut?!');">
                            Pesan Ruangan
                        </button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
</body>

</html>