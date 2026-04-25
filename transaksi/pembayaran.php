<?php
include "../config/koneksi.php";

$id = $_GET['id'];

// ambil transaksi + produk
$q = mysqli_query($conn, "
SELECT t.*, p.nama AS produk, p.harga 
FROM transaksi t
JOIN produk p ON t.produk_id = p.id
WHERE t.id = $id
");

$data = mysqli_fetch_assoc($q);

// validasi
if (!$data) {
    die("transaksi tidak ditemukan");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card p-4 shadow">

    <h3 class="text-center mb-3">Pembayaran</h3>

    <!-- info produk -->
    <div class="mb-3">
        <p><b>Produk:</b> <?= $data['produk'] ?></p>
        <p><b>Metode:</b> <?= strtoupper($data['metode']) ?></p>
    </div>

    <hr>

    <!-- rincian harga -->
    <p>Harga: Rp <?= number_format($data['harga']) ?></p>
    <p>Pajak (10%): Rp <?= number_format($data['pajak']) ?></p>
    <h5>Total: Rp <?= number_format($data['total']) ?></h5>

    <hr>

    <!-- metode pembayaran -->
    <div class="text-center mb-3">

        <?php if ($data['metode'] == 'bca') { ?>
            <p>Transfer ke BCA</p>
            <h4 class="fw-bold">1234567890</h4>

        <?php } elseif ($data['metode'] == 'bni') { ?>
            <p>Transfer ke BNI</p>
            <h4 class="fw-bold">9876543210</h4>

        <?php } elseif ($data['metode'] == 'bri') { ?>
            <p>Transfer ke BRI</p>
            <h4 class="fw-bold">1122334455</h4>

        <?php } else { ?>
            <p>Scan QRIS (<?= strtoupper($data['metode']) ?>)</p>
            <img src="qris.png" width="200">
        <?php } ?>

    </div>

    <hr>

    <!-- upload bukti -->
    <form action="bukti.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <label class="mb-2">Upload Bukti Pembayaran</label>
        <input type="file" name="bukti" class="form-control mb-3" required>

        <button class="btn btn-success w-100">Upload Bukti</button>
    </form>

    <p class="text-muted text-center mt-3" style="font-size:13px;">
        setelah upload, tunggu admin verifikasi
    </p>

    <div class="text-center mt-3">
        <a href="index.php" class="btn btn-secondary btn-sm">kembali</a>
    </div>

</div>

</div>

</body>
</html>