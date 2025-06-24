<?php
// Koneksi database - pilih salah satu yang sesuai dengan konfigurasi Anda
$koneksi = mysqli_connect("localhost", "root", "root", "webif"); // Versi 1
// $koneksi = mysqli_connect("localhost:3307", "root", "", "webif"); // Versi 2

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambahmahasiswa($data)
{
    global $koneksi;
    $nama = htmlspecialchars($data['nama']);
    $nim = htmlspecialchars($data['nim']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $no_hp = htmlspecialchars($data['no_hp']);

    // Upload foto
    $foto = upload();
    if (!$foto) {
        return false;
    }

    $query = "INSERT INTO mahasiswa VALUES (NULL, '$nama', '$nim', '$jurusan', '$no_hp', '$foto')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function hapusdata($id)
{
    global $koneksi;

    // Ambil nama file foto sebelum menghapus
    $query = "SELECT foto FROM mahasiswa WHERE id=$id";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    $foto = $row['foto'];

    // Hapus file foto jika bukan default
    if ($foto != 'default.jpg') {
        unlink("image/" . $foto);
    }

    $query = "DELETE FROM mahasiswa WHERE id=$id";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function upload()
{
    $namaFile = $_FILES['foto']['name'];
    $tmpName = $_FILES['foto']['tmp_name'];
    $error = $_FILES['foto']['error'];
    $ukuran = $_FILES['foto']['size'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>alert('Pilih gambar terlebih dahulu!');</script>";
        return false;
    }

    // cek ekstensi file
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>alert('Yang diupload bukan gambar!');</script>";
        return false;
    }

    // cek ukuran file (misal max 2MB)
    if ($ukuran > 2 * 1024 * 1024) {
        echo "<script>alert('Ukuran gambar terlalu besar!');</script>";
        return false;
    }

    // generate nama file unik
    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
    move_uploaded_file($tmpName, 'image/' . $namaFileBaru);

    return $namaFileBaru;
}
?>