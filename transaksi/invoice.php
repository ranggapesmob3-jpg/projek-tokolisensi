<?php
include "../config/koneksi.php";

$id = $_GET['id'];

// ambil transaksi + produk + lisensi
$q = mysqli_query($conn, "
SELECT t.*, p.nama AS produk, p.harga, l.kode
FROM transaksi t
JOIN produk p ON t.produk_id = p.id
LEFT JOIN lisensi l ON t.lisensi_id = l.id
WHERE t.id = $id
");
$trx = mysqli_fetch_assoc($q);

if (!$trx) {
    echo "<h3 class='text-center mt-5'>transaksi tidak ditemukan</h3>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

<div class="card p-4 shadow">

    <h3 class="text-success text-center">Invoice</h3>
    <p class="text-center text-muted">ID Transaksi: #<?= $trx['id'] ?></p>

    <hr>

    <p><b>Nama:</b> <?= htmlspecialchars($trx['nama']) ?></p>
    <p><b>Email:</b> <?= htmlspecialchars($trx['email']) ?></p>
    <p><b>No HP:</b> <?= htmlspecialchars($trx['no_telp']) ?></p>

    <hr>

    <p><b>Produk:</b> <?= $trx['produk'] ?></p>
    <p><b>Metode:</b> <?= strtoupper($trx['metode']) ?></p>

    <hr>

    <p>Harga: Rp <?= number_format($trx['harga']) ?></p>
    <p>Pajak (10%): Rp <?= number_format($trx['pajak']) ?></p>
    <h5>Total: Rp <?= number_format($trx['total']) ?></h5>

    <hr>

    <?php if ($trx['status'] != 'paid') { ?>
        <div class="alert alert-warning text-center">
            pembayaran belum diverifikasi admin
        </div>
    <?php } else { ?>
        <h5 class="text-center">Kode Lisensi</h5>
        <div class="alert alert-dark text-center fw-bold fs-5">
            <?= $trx['kode'] ?>
        </div>
        <p class="text-center text-muted">jangan bagikan kode ini ke orang lain</p>
    <?php } ?>

    <div class="text-center mt-3">
        <a href="../index.php" class="btn btn-primary">kembali ke beranda</a>
    </div>

</div>

</div>
</body>
</html>