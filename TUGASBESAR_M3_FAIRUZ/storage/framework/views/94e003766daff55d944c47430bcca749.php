<div>
    <!-- Very little is needed to make a happy life. - Marcus Aurelius -->
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <title>Perpustakaan digital</title>
</head>
<body>
    <div class="content">
        <div class="judul">
            <h3>Ubah Ruangan Perpustakaan</h3>
            <p class="deskripsi-ruangan">Perubahan tempat meja/bilik di perpustakaan</p>
        </div>
        <div class="kotak">
            <form action="<?php echo e(route('fasilitas.update', $data_ruang->id_ruangan)); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <ul>
                    <li>
                        <h3>Nama Meja / Bilik</h3>
                        <input class="isi" type="text" name="nama_ruangan" value="<?php echo e($data_ruang->nama_ruangan); ?>" placeholder="Masukkan nama tempat.." maxlength="100" required>
                    </li>
                    <li>
                        <h3>Kapasitas</h3>
                        <input class="isi" type="text" name="kapasitas" value="<?php echo e($data_ruang->kapasitas); ?>" placeholder="Masukkan kapasitas orang.." required>
                    </li>
                    <li>
                        <h3>Fasilitas</h3>
                        <input class="isi" type="text" name="fasilitas" value="<?php echo e($data_ruang->fasilitas); ?>" placeholder="Masukkan fasilitas tempat.." required>
                    </li>
                    <li>
                        <h3>Lantai</h3>
                        <select class="isi" name="lantai" id="floor">
                            <option value="Lt. 1" <?php echo e($data_ruang->lantai == 'Lt. 1' ? 'selected' : ''); ?>>Lt. 1</option>
                            <option value="Lt. 2" <?php echo e($data_ruang->lantai == 'Lt. 2' ? 'selected' : ''); ?>>Lt. 2</option>
                            <option value="Lt. 3" <?php echo e($data_ruang->lantai == 'Lt. 3' ? 'selected' : ''); ?>>Lt. 3</option>
                        </select>
                    </li>
                    <li>
                        <h3>Foto Saat Ini</h3>
                        <div class="mb-2">
                            <img src="<?php echo e(asset('img/' . $data_ruang->gambar)); ?>" alt="gambar" style="height: 80px;">
                        </div>
                        <h3>Ganti Foto (Opsional)</h3>
                        <input type="file" name="gambar">
                    </li>
                    <li>
                        <button type="submit" name="submit" class="btn-pesan" onclick="return confirm('Yakin lanjut?!');">
                            Update Ruangan
                        </button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</div>
<?php /**PATH C:\xampp\htdocs\PAWsemester3\Tubes-laravel\tubes-102022500060\resources\views/update.blade.php ENDPATH**/ ?>