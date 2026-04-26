<?php
include "../config/koneksi.php";
$data = mysqli_query($conn, "SELECT * FROM produk");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
<h2>Data Produk</h2>

<a href="tambahproduk.php" class="btn btn-success mb-3">Tambah</a>
<a href="../index.php" class="btn btn-secondary mb-3">Kembali</a>

<table class="table table-bordered">
<tr><th>Nama</th><th>Harga</th><th>Aksi</th></tr>

<?php while($p = mysqli_fetch_assoc($data)) { ?>
<tr>
<td><?= $p['nama'] ?></td>
<td><?= $p['harga'] ?></td>
<td>
<a href="hapusproduk.php?id=<?= $p['id'] ?>" class="btn btn-danger">Hapus</a>
</td>
</tr>
<?php } ?>

</table>
</div>