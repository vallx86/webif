<?php

require 'function.php';

$id = $_GET['id'];

$mhs = query("SELECT * FROM mahasiswa WHERE id=$id")[0];


if (isset($_POST["submit"])) {
    $nama = $_POST["nama"];
    $nim = $_POST["nim"];
    $jurusan = $_POST["jurusan"];
    $no_hp = $_POST["no_hp"];

    // Proses upload foto

    // Query untuk memasukkan data ke database


    if (ubahdata($_POST, $id) > 0) {
        echo "
            <script>
                alert(Berhasil ditambahkan!';
                document.location.href ='../datamahasiswa.php';
            </script>";
    } else {
        echo "
            <script>
                alert(Gagal ditambahkan!';
                document.location.href = '../datamahasiswa.php';
            </script>";
        mysqli_error($koneksi);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1 align="center">Ubah Data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" placeholder="Nama Lengkap*" required value="<?= $mhs["nama"] ?>"><br>

        <label for="nim">NIM:</label>
        <input type="text" name="nim" id="nim" required value="<?= $mhs["nim"] ?>"><br>

        <label for="jurusan">Jurusan:</label>
        <input type="text" name="jurusan" id="jurusan" required value="<?= $mhs["jurusan"] ?>"><br>

        <label for="nohp">No. HP:</label>
        <input type="text" name="no_hp" id="no_hp" required value="<?= $mhs["no_hp"] ?>"><br>

        <label for="foto">Foto:</label>
        <input type="file" name="foto" id="foto" accept=".jpg, .jpeg, .png"><br>

        <button type="submit" name="submit">Ubah Data</button>
    </form>

</body>

</html>