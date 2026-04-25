<?php
include "../config/koneksi.php";

if (isset($_POST['submit'])) {
    $produk = $_POST['produk_id'];
    $kode = $_POST['kode'];

    mysqli_query($conn, "INSERT INTO lisensi (produk_id, kode) VALUES ('$produk','$kode')");
}

$produk = mysqli_query($conn, "SELECT * FROM produk");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
<h2>Tambah Lisensi</h2>

<form method="POST">
<select name="produk_id" class="form-control mb-2">
<?php while($p = mysqli_fetch_assoc($produk)) { ?>
<option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
<?php } ?>
</select>

<input type="text" name="kode" class="form-control mb-2" placeholder="Kode">
<button name="submit" class="btn btn-primary">Tambah</button>
</form>
</div>