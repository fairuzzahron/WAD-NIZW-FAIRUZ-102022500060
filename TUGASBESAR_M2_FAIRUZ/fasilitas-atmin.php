<?php
require 'konek.php';
$dt_ruang = query("SELECT * FROM ruangan");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/style-fasilitas.css"> -->
    <link rel="stylesheet" href="css/style.css">
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
                        <a class="nav-link active" href="fasilitas.php">Fasilitas</a>
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
    <div class="content-wrapper">
        <div class="judul">
            <h3>Fasilitas & Area</h3>
            <h3>Kelola fasilitas dan area Perpustakaan</h3>
        </div>
        <div class="tabel">
            <table border="">
                <tr>
                    <th style="text-align: center;padding:5px;">No</th>
                    <th>Img</th>
                    <th>Meja/Bilik</th>
                    <th>Kapasitas</th>
                    <th>Lantai</th>
                    <th>Fasilitas</th>
                    <th>Tombol</th>
                </tr>
                <?php
                $i = 1;
                foreach ($dt_ruang as $dr) :
                ?>
                    <tr class="warna-kolom">
                        <td style="text-align: center;"><?= $i ?></td>
                        <td><img src="img/<?= $dr["gambar"]; ?>" alt="meja" style="height: 100px;"></td>
                        <td><b><?= $dr["nama_ruangan"]; ?></b></td>
                        <td><?= $dr["kapasitas"]; ?> orang</td>
                        <td><?= $dr["lantai"]; ?></td>
                        <td><?= $dr["fasilitas"]; ?></td>
                        <td><a href="update.php?id_ruangan=<?= (int) $dr['id_ruangan'] ?>"><button type="button" class="btn btn-outline-dark">Update</button></a>  <a href="hapus.php?id_ruangan=<?= (int) $dr['id_ruangan'] ?>" onclick="return confirm('Yakin dihapus nih!?');"><button type="button" class="btn btn-outline-dark">Delete</button></a></td>
                    </tr>
                <?php
                    $i++;
                endforeach;
                ?>
                <!-- <tr>
                    <td style="text-align: center;">02</td>
                    <td><img src="img/meja.jpeg" alt="meja" style="height: 100px;"></td>
                    <td style="color: chocolate;">Meja 02</td>
                    <td>Lt. 2</td>
                    <td>Wifi, Stop Kontak 2</td>
                    <td><span class="tersedia">Tersedia</span></td>
                    <td><a href="form.php"><button type="button" class="btn btn-outline-dark">Pesan</button></a></td>
                </tr>
                <tr class="warna-kolom">
                    <td style="text-align: center;">03</td>
                    <td><img src="img/bilik.jpeg" alt="meja" style="height: 100px;margin: 0 13px;"></td>
                    <td style="color: chocolate;">Bilik 01</td>
                    <td>Lt. 3</td>
                    <td>Wifi, Stop Kontak 3</td>
                    <td><span class="tersedia">Tersedia</span></td>
                    <td><a href="form.php"><button type="button" class="btn btn-outline-dark">Pesan</button></a></td>
                </tr>
                <tr>
                    <td style="text-align: center;">04</td>
                    <td><img src="img/bilik.jpeg" alt="meja" style="height: 100px;margin: 0 13px;"></td>
                    <td style="color: chocolate;">Bilik 02</td>
                    <td>Lt. 3</td>
                    <td>Wifi, Stop Kontak 3</td>
                    <td><span class="tersedia">Tersedia</span></td>
                    <td><a href="form.php"><button type="button" class="btn btn-outline-dark">Pesan</button></a></td>
                </tr> -->
            </table>
        </div>
        <label for="">*Hanya Admin</label>
        <a href="tambah.php">Tambah Ruang</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>