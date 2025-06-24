<?php

require_once 'function.php';

if (isset($_POST["submit"])) {
        $nama = $_POST["nama"];
        $nim = $_POST["nim"];
        $jurusan = $_POST["jurusan"];
        $no_hp = $_POST["no_hp"];
        
        // Proses upload foto
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $foto = $_FILES['foto']['name'];
            move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $foto);
        } else {
            $foto = null; // Atau bisa diisi dengan foto default
        }

        // Query untuk memasukkan data ke database
        $query = "INSERT INTO mahasiswa (nama, nim, jurusan, no_hp, foto) VALUES ('$nama', '$nim', '$jurusan', '$no_hp', '$foto')";
        
        if (mysqli_query($koneksi, $query)) {
            echo "
            <script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'datamahasiswa.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'datamahasiswa.php';
            </script> " . mysqli_error($koneksi);
        }
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1 align="center">Tambah Data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" required><br>

        <label for="nim">NIM:</label>
        <input type="text" name="nim" id="nim" required><br>

        <label for="jurusan">Jurusan:</label>
        <input type="text" name="jurusan" id="jurusan" required><br>

        <label for="no_hp">No. HP:</label>
        <input type="text" name="no_hp" id="no_hp" required><br>

        <label for="foto">Foto:</label>
        <input type="file" name="foto" id="foto" accept=".jpg, .jpeg, .png"><br>

        <button type="submit" name="submit">Tambah Data</button>
    </form>
    
</body>
</html>