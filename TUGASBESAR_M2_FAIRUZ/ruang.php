
<?php
session_start();
require_once 'konek.php';

function e($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$pesan = $_SESSION['pesan'] ?? '';
unset($_SESSION['pesan']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals(
        $_SESSION['csrf_token'],
        $_POST['csrf_token'] ?? ''
    )) {
        exit('Permintaan tidak valid. Muat ulang halaman.');
    }

    $aksi = $_POST['aksi'] ?? '';

    try {
        if (in_array($aksi, ['tambah', 'edit'], true)) {
            $nama = trim($_POST['nama_ruangan'] ?? '');
            $kapasitas = filter_var(
                $_POST['kapasitas'] ?? null,
                FILTER_VALIDATE_INT
            );
            $fasilitas = trim($_POST['fasilitas'] ?? '');
            $lokasi = trim($_POST['lokasi'] ?? '');
            $status = $_POST['status'] ?? 'aktif';

            if (
                $nama === '' ||
                mb_strlen($nama) > 100 ||
                $kapasitas === false ||
                $kapasitas === null ||
                $kapasitas < 1 ||
                !in_array($status, ['aktif', 'nonaktif'], true)
            ) {
                throw new InvalidArgumentException(
                    'Periksa kembali nama, kapasitas, dan status ruangan.'
                );
            }

            if ($aksi === 'tambah') {
                $stmt = $pdo->prepare(
                    'INSERT INTO ruangan
                    (nama_ruangan, kapasitas, fasilitas, lokasi, status)
                    VALUES (?, ?, ?, ?, ?)'
                );

                $stmt->execute([
                    $nama, $kapasitas, $fasilitas, $lokasi, $status
                ]);

                $pesan = 'Ruangan berhasil ditambahkan.';
            } else {
                $id = filter_var(
                    $_POST['id_ruangan'] ?? null,
                    FILTER_VALIDATE_INT
                );

                if (!$id || $id < 1) {
                    throw new InvalidArgumentException('ID tidak valid.');
                }

                $stmt = $pdo->prepare(
                    'UPDATE ruangan
                    SET nama_ruangan = ?, kapasitas = ?,
                        fasilitas = ?, lokasi = ?, status = ?
                    WHERE id_ruangan = ?'
                );

                $stmt->execute([
                    $nama, $kapasitas, $fasilitas,
                    $lokasi, $status, $id
                ]);

                $pesan = 'Ruangan berhasil diperbarui.';
            }
        } elseif ($aksi === 'hapus') {
            $id = filter_var(
                $_POST['id_ruangan'] ?? null,
                FILTER_VALIDATE_INT
            );

            if (!$id || $id < 1) {
                throw new InvalidArgumentException('ID tidak valid.');
            }

            $stmt = $pdo->prepare(
                'DELETE FROM ruangan WHERE id_ruangan = ?'
            );
            $stmt->execute([$id]);

            $pesan = $stmt->rowCount()
                ? 'Ruangan berhasil dihapus.'
                : 'Ruangan tidak ditemukan.';
        }

    } catch (InvalidArgumentException $ex) {
        $pesan = $ex->getMessage();
    } catch (PDOException $ex) {
        error_log($ex->getMessage());

        $pesan = $ex->getCode() === '23000'
            ? 'Ruangan masih memiliki relasi data booking dan tidak dapat dihapus.'
            : 'Terjadi kesalahan database.';
    }

    $_SESSION['pesan'] = $pesan;
    header('Location: ruangan.php');
    exit;
}

$edit = null;

if (isset($_GET['edit'])) {
    $id = filter_var($_GET['edit'], FILTER_VALIDATE_INT);

    if ($id && $id > 0) {
        $stmt = $pdo->prepare(
            'SELECT * FROM ruangan WHERE id_ruangan = ?'
        );
        $stmt->execute([$id]);
        $edit = $stmt->fetch();
    }
}

$stmt = $pdo->query(
    'SELECT * FROM ruangan ORDER BY id_ruangan DESC'
);
$ruangan = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Ruangan | LibrarySpace</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main class="container">
    <header class="header">
        <div>
            <p class="eyebrow">LIBRARYSPACE</p>
            <h1>Kelola Ruangan</h1>
            <p>Atur data ruangan perpustakaan dengan mudah.</p>
        </div>
    </header>

    <?php if ($pesan !== ''): ?>
        <div class="alert"><?= e($pesan) ?></div>
    <?php endif; ?>

    <section class="card">
        <h2><?= $edit ? 'Edit Ruangan' : 'Tambah Ruangan' ?></h2>

        <?php if (isset($_GET['edit']) && !$edit): ?>
            <p>Data ruangan tidak ditemukan.</p>
        <?php else: ?>
        <form method="POST">
            <input type="hidden" name="csrf_token"
                   value="<?= e($_SESSION['csrf_token']) ?>">
            <input type="hidden" name="aksi"
                   value="<?= $edit ? 'edit' : 'tambah' ?>">

            <?php if ($edit): ?>
                <input type="hidden" name="id_ruangan"
                       value="<?= e($edit['id_ruangan']) ?>">
            <?php endif; ?>

            <div class="form-grid">
                <div class="field">
                    <label for="nama_ruangan">Nama ruangan</label>
                    <input id="nama_ruangan" name="nama_ruangan"
                           maxlength="100" required
                           value="<?= e($edit['nama_ruangan'] ?? '') ?>">
                </div>

                <div class="field">
                    <label for="kapasitas">Kapasitas (orang)</label>
                    <input type="number" id="kapasitas" name="kapasitas"
                           min="1" required
                           value="<?= e($edit['kapasitas'] ?? 1) ?>">
                </div>

                <div class="field">
                    <label for="lokasi">Lokasi</label>
                    <input id="lokasi" name="lokasi"
                           value="<?= e($edit['lokasi'] ?? '') ?>">
                </div>

                <div class="field">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <?php foreach (['aktif', 'nonaktif'] as $s): ?>
                            <option value="<?= e($s) ?>"
                                <?= ($edit['status'] ?? 'aktif') === $s
                                    ? 'selected' : '' ?>>
                                <?= e(ucfirst($s)) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="field full">
                    <label for="fasilitas">Fasilitas</label>
                    <textarea id="fasilitas" name="fasilitas"
                              rows="3"><?= e($edit['fasilitas'] ?? '') ?></textarea>
                </div>
            </div>

            <div class="actions">
                <button class="btn" type="submit">
                    <?= $edit ? 'Simpan Perubahan' : 'Tambah Ruangan' ?>
                </button>

                <?php if ($edit): ?>
                    <a class="btn secondary" href="ruangan.php">Batal</a>
                <?php endif; ?>
            </div>
        </form>
        <?php endif; ?>
    </section>

    <section class="card">
        <h2>Daftar Ruangan</h2>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Ruangan</th>
                        <th>Kapasitas</th>
                        <th>Fasilitas</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!$ruangan): ?>
                    <tr>
                        <td colspan="7">Belum ada data ruangan.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($ruangan as $r): ?>
                    <tr>
                        <td><?= e($r['id_ruangan']) ?></td>
                        <td><?= e($r['nama_ruangan']) ?></td>
                        <td><?= e($r['kapasitas']) ?> orang</td>
                        <td><?= e($r['fasilitas'] ?? '') ?></td>
                        <td><?= e($r['lokasi'] ?? '') ?></td>
                        <td>
                            <span class="status <?= e($r['status']) ?>">
                                <?= e(ucfirst($r['status'])) ?>
                            </span>
                        </td>
                        <td>
                            <div class="actions">
                                <a class="btn small"
                                   href="?edit=<?= e($r['id_ruangan']) ?>">
                                    Edit
                                </a>

                                <form method="POST"
                                      onsubmit="return confirm('Hapus ruangan ini?')">
                                    <input type="hidden" name="csrf_token"
                                           value="<?= e($_SESSION['csrf_token']) ?>">
                                    <input type="hidden" name="aksi" value="hapus">
                                    <input type="hidden" name="id_ruangan"
                                           value="<?= e($r['id_ruangan']) ?>">
                                    <button class="btn danger small" type="submit">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>
</body>
</html>
