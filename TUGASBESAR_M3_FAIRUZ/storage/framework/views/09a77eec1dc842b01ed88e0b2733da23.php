<div>
    <!-- It is never too late to be what you might have been. - George Eliot -->
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
            <h3>Tambah Ruangan Perpustakaan</h3>
            <p class="deskripsi-ruangan">Penambahan tempat meja/bilik di perpustakaan</p>
        </div>
        <div class="kotak">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal Menyimpan Data!</strong>
                <ul class="mb-0 mt-1">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         <?php endif; ?>

        <form action="<?php echo e(route('fasilitas.store')); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
                <ul>
                    <li>
                        <h3>Nama Meja / Bilik</h3>
                        <input class="isi" type="text" name="nama_ruangan" placeholder="Masukkan nama tempat.." maxlength="100" required>
                    </li>
                    <li>
                        <h3>Kapasitas</h3>
                        <input class="isi" type="text" name="kapasitas" placeholder="Masukkan kapasitas orang.." required>
                    </li>
                    <li>
                        <h3>Fasilitas</h3>
                        <input class="isi" type="text" name="fasilitas" placeholder="Masukkan fasilitas tempat.." required>
                    </li>
                    <li>
                        <h3>Lantai</h3>
                        <select class="isi" name="lantai" id="floor">
                            <option value="Lt. 1">Lt. 1</option>
                            <option value="Lt. 2">Lt. 2</option>
                            <option value="Lt. 3">Lt. 3</option>
                        </select>
                    </li>
                    <li>
                        <h3>Foto</h3>
                        <input type="file" name="gambar" required>
                    </li>
                    <li>
                        <button type="submit" name="submit" class="btn-pesan" onclick="return confirm('Yakin lanjut?!');">
                            Simpan Ruangan
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
<?php /**PATH C:\xampp\htdocs\PAWsemester3\Tubes-laravel\tubes-102022500060\resources\views/create.blade.php ENDPATH**/ ?>