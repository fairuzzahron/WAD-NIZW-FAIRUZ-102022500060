<div>
    <!-- Be present above all else. - Naval Ravikant -->
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Perpustakaan Digital</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">Perpustakaan Digital</a>
        </div>
    </nav>
    <div class="content-wrapper">
        <div class="judul">
            <h3>Fasilitas & Area</h3>
            <h3>Kelola fasilitas dan area Perpustakaan</h3>
        </div>

        @if(session('success'))
            <script>alert("{{ session('success') }}");</script>
        @endif

        <div class="tabel">
            <table>
                <tr>
                    <th style="text-align: center;padding:5px;">No</th>
                    <th>Img</th>
                    <th>Meja/Bilik</th>
                    <th>Kapasitas</th>
                    <th>Lantai</th>
                    <th>Fasilitas</th>
                    <th>Tombol</th>
                </tr>
                @foreach ($dt_ruang as $index => $dr)
                    <tr class="warna-kolom">
                        <td style="text-align: center;"><?= $index + 1 ?></td>
                        <td><img src="{{ asset('img/' . $dr->gambar) }}" alt="meja" style="height: 100px;"></td>
                        <td><b>{{ $dr->nama_ruangan }}</b></td>
                        <td>{{ $dr->kapasitas }} orang</td>
                        <td>{{ $dr->lantai }}</td>
                        <td>{{ $dr->fasilitas }}</td>
                        <td>
                            <a href="{{ route('fasilitas.edit', $dr->id_ruangan) }}">
                                <button type="button" class="btn btn-outline-dark">Update</button>
                            </a>  
                            <form action="{{ route('fasilitas.destroy', $dr->id_ruangan) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-dark" onclick="return confirm('Yakin dihapus nih!?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <label for="">*Hanya Admin</label>
        <a href="{{ route('fasilitas.create') }}">Tambah Ruang</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</div>
