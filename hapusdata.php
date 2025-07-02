<?php

require 'function.php';

    $id = $_GET['id']; //mengambil id

    if (hapusdata($id)>0) {
        echo "
        <script>
            alert('Data berhasil Dihapus!');
            document.location.href = 'datamahasiswa.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data gagal Dihapus!');
            document.location.href = 'datamahasiswa.php';
        </script> " . mysqli_error($koneksi);
    }

?>