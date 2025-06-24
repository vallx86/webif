<?php
// Koneksi database - pilih salah satu yang sesuai
$koneksi = mysqli_connect("localhost", "root", "root", "webif"); // Versi 1
//$koneksi = mysqli_connect("localhost:3307", "root", "", "webif"); // Versi 2 (aktifkan salah satu)

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        die("Query error: " . mysqli_error($koneksi));
    }
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambahmahasiswa($data)
{
    global $koneksi;

    // Validasi dan sanitasi input
    $nama = htmlspecialchars(stripslashes(trim($data['nama'])));
    $nim = htmlspecialchars(stripslashes(trim($data['nim'])));
    $jurusan = htmlspecialchars(stripslashes(trim($data['jurusan'])));
    $no_hp = htmlspecialchars(stripslashes(trim($data['no_hp'])));

    // Upload foto
    $foto = upload();
    if (!$foto) {
        return false;
    }

    // Gunakan prepared statement untuk keamanan
    $stmt = mysqli_prepare($koneksi, "INSERT INTO mahasiswa VALUES (NULL, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssss", $nama, $nim, $jurusan, $no_hp, $foto);
    mysqli_stmt_execute($stmt);

    return mysqli_affected_rows($koneksi);
}

function hapusdata($id)
{
    global $koneksi;

    // Validasi ID
    $id = (int) $id;
    if ($id <= 0)
        return false;

    // Ambil nama file foto
    $query = "SELECT foto FROM mahasiswa WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $foto = $row['foto'];
        // Hapus file foto jika bukan default
        if ($foto != 'default.jpg' && file_exists("image/" . $foto)) {
            unlink("image/" . $foto);
        }
    }

    // Hapus data dari database
    $query = "DELETE FROM mahasiswa WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    return mysqli_affected_rows($koneksi);
}

function upload()
{
    // Cek apakah file diupload
    if (!isset($_FILES['foto']) || $_FILES['foto']['error'] === UPLOAD_ERR_NO_FILE) {
        echo "<script>alert('Pilih gambar terlebih dahulu!');</script>";
        return false;
    }

    $namaFile = $_FILES['foto']['name'];
    $tmpName = $_FILES['foto']['tmp_name'];
    $error = $_FILES['foto']['error'];
    $ukuran = $_FILES['foto']['size'];

    // Cek error upload
    if ($error !== UPLOAD_ERR_OK) {
        echo "<script>alert('Error upload gambar!');</script>";
        return false;
    }

    // Cek ekstensi file
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>alert('Hanya file JPG, JPEG, dan PNG yang diizinkan!');</script>";
        return false;
    }

    // Cek ukuran file (max 2MB)
    if ($ukuran > 2 * 1024 * 1024) {
        echo "<script>alert('Ukuran gambar terlalu besar! Maksimal 2MB');</script>";
        return false;
    }

    // Generate nama file unik
    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;

    // Pastikan folder image ada
    if (!file_exists('image')) {
        mkdir('image', 0777, true);
    }

    // Pindahkan file
    if (move_uploaded_file($tmpName, 'image/' . $namaFileBaru)) {
        return $namaFileBaru;
    } else {
        echo "<script>alert('Gagal menyimpan gambar!');</script>";
        return false;
    }
}
if (!function_exists('getNoTelp')) {
    function getNoTelp($id)
    {
        global $koneksi;

        $id = (int) $id;
        if ($id <= 0) {
            return null;
        }

        $stmt = mysqli_prepare($koneksi, "SELECT no_hp FROM mahasiswa WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            return $row['no_hp'];
        }

        return null; // Jika tidak ditemukan
    }
}

?>