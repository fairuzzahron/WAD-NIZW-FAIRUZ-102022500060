<?php
require 'konek.php';

$id = $_GET["id_ruangan"];

if(hapus($id)>0){
    echo '<script>
            alert("Data dihapus admin yh!");
        document.location.href = "fasilitas-atmin.php";
    </script>';
}else {
    echo '<script>
            alert("Data gagal dihapus!");
        document.location.href = "fasilitas-atmin.php";
    </script>';
}

?>