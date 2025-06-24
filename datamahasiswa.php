<?php
require 'function.php';
$query = "SELECT * FROM mahasiswa";
$rows = query($query);
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA MAHASISWA</title>
</head>
<body>
    <h1>Data Mahasiswa</h1>

    <a href="tambahdata.php">
        <button style="margin: 10px; background-color: blue; color: white;">Tambah Data</button>
    </a>

    <table border="1" cellspacing="0" cellpadding="10">
        <tr> 
            <th>No</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jurusan</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>

        <?php 
        $i = 1;
        foreach ($rows as $mhs) { ?>
        <tr>
            <td><?= $i ?></td>
            <td>
                <img src="img/<?= htmlspecialchars($mhs['foto']) ?>" alt="Foto Mahasiswa" width="80">
            </td>
            <td><?= htmlspecialchars($mhs["nama"]) ?></td>
            <td><?= htmlspecialchars($mhs["nim"]) ?></td>
            <td><?= htmlspecialchars($mhs["jurusan"]) ?></td>
            <td><?= htmlspecialchars($mhs["no_hp"]) ?></td>
            <td>
                <a href="hapusdata.php?id=<?= $mhs['id'] ?>" onclick="return confirm('Yakin ingin menghapus?');">
                    <button style="margin: 5px; background-color: red; color: white;">Hapus</button>
                </a>
            </td>
        </tr>
        <?php $i++; } ?>
    </table>
</body>
</html>
