<?php
$nmhost = "localhost";
$nmuser = "root";
$nmpassword = "";
$nmdatabase = "tubes_paw";

$koneksi = mysqli_connect($nmhost, $nmuser, $nmpassword, $nmdatabase);

function query($query)
{
    global $koneksi;
    $ambil = mysqli_query($koneksi, $query);
    $baris = [];
    while ($row = mysqli_fetch_assoc($ambil)) {
        $baris[] = $row;
    }
    return $baris;
}

function tambah($data)
{
    global $koneksi;

    $nama_ruangan = htmlentities($data["nama_ruangan"]);
    $kapasitas = htmlentities($data["kapasitas"]);
    $fasilitas = htmlentities($data["fasilitas"]);
    $lantai = htmlentities($data["lantai"]);


    // $gambar = htmlentities($data["gambar"]);
    $gambar = upload();
    // var_dump($gambar);
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO ruangan VALUES 
                ('', '$gambar', '$nama_ruangan', '$kapasitas', '$fasilitas', '$lantai', 'aktif')
                ";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function upload()
{
    $namafile = $_FILES['gambar']['name'];
    $gambarsize = $_FILES['gambar']['size'];
    $tmpname = $_FILES['gambar']['tmp_name'];

    // var_dump($_FILES);

    // echo $gambarerr;
    // echo $gambarerr;
    // echo $gambarerr;


    $ekstensigambarvalid = ['jpg', 'jpeg', 'webp', 'png'];
    $ekstensigambar = explode('.', $namafile);

    $ekstensigambar = strtolower(end($ekstensigambar));

    if (!in_array($ekstensigambar, $ekstensigambarvalid)) {
        echo '
        <script>
        alert("Ekstensi bukan (jpg/jpeg/webp/png) loh yh!");
        </script>';

        return false;
    }

    if ($gambarsize > 10485760) {
        echo '<script>
        alert("File terlalu dibesar-besarkan!");
        </script>';
        return false;
    }

    $gambarnewname = uniqid();
    $gambarnewname .= '.';
    $gambarnewname .= $ekstensigambar;

    move_uploaded_file($tmpname, 'img/' . $gambarnewname);

    return $gambarnewname;
}


function hapus($id){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM ruangan WHERE id_ruangan = $id");

    return mysqli_affected_rows($koneksi);
}


function update($data){
    global $koneksi;

    $id = $data["id_ruangan"];
    $nama_ruangan = htmlentities($data["nama_ruangan"]);
    $kapasitas = htmlentities($data["kapasitas"]);
    $fasilitas = htmlentities($data["fasilitas"]);
    $lantai = htmlentities($data["lantai"]);
    $gambarold = htmlentities($data["gambarold"]);

    if($_FILES['gambar']['error']===4){
        $gambar = $gambarold;
    }else{
        $gambar = upload();

        if (!$gambar) {
            return false;
        }
    }

    $query = "UPDATE ruangan SET 
                nama_ruangan = '$nama_ruangan',
                kapasitas = '$kapasitas',
                fasilitas = '$fasilitas',
                lantai = '$lantai',
                gambar = '$gambar'
                WHERE id_ruangan = $id
                ";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// try {
//     $pdo = new PDO(
//         "mysql:host=$nmhost;dbname=$nmdatabase;charset=utf8mb4",
//         $nmuser,
//         $nmpassword,
//         [
//             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//             PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//             PDO::ATTR_EMULATE_PREPARES => false
//         ]
//     );
// } catch (PDOException $e) {
//     error_log($e->getMessage());
//     exit('Koneksi database gagal. Periksa konfigurasi database.');
// }

?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>