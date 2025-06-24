<!DOCTYPE html>
<html lang="en">
     <link rel="stylesheet" href="register.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2> Registrasi</h2>
    <form action="/submit" method="POST" enctype="multipart/form-data">
    <label for="nama">Nama Lengkap:</label>
    <input type="text" id="nama" name="nama" required><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <label for="umur">Umur:</label>
    <input type="number" id="umur" name="umur"><br><br>
    <label for="Tanggal Lahir">Tanggal Lahir:</label>
    <input type="number" id="Tanggal Lahir" name="Tanggal Lahir"><br><br>
    <label for="Warna Favorit">Warna Favorit:</label>
    <input type="Warna Favorit"Warna Favorit id="Warna Favorit" name=" Warna Favorit"><br><br>
    <label for="foto">Upload Foto Profil:</label>
    <input type="file" id="foto" name="foto"><br><br>
    <label>Jenis Kelamin:</label><br>
    <input type="radio" id="laki" name="jenis_kelamin" value="Laki-laki">
    <label for="laki">Laki-laki</label><br>
    <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan">
    <label for="perempuan">Perempuan</label><br><br>
    <label>Hobi:</label><br>
    <input type="checkbox" id="membaca" name="hobi" value="Membaca">
    <label for="membaca">Membaca</label><br>
    <input type="checkbox" id="Memasak" name="hobi" value="Memasak">
    <label for="Memasak">Memasak</label><br>
    <input type="checkbox" id="jogging" name="hobi" value="jogging">
    <label for="jogging">Jogging</label><br><br>
    <label>Negara:</label><br>
    <select id="negara" name="negara">
        <option value="Jepang">Jepang</option>
        <option value="Australia">Australia</option>
        <option value="Indonesia">Indonesia</option>
      </select><br><br>
      <label for="bio">Biografi Singkat:</label><br>
      <textarea id="bio" name="bio" rows="4" cols="50"></textarea><br><br>
  
      <input type="submit" value="Daftar">

</body>
</html>