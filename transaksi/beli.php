<?php
require_once "../config/koneksi.php";

if (!isset($_GET['id']) || $_GET['id'] == '') {
    die("ID produk tidak ditemukan!");
}

$id = (int) $_GET['id']; // biar aman dari input aneh

// ambil data produk
$p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id=$id"));

if (!$p) {
    die("produk tidak ditemukan");
} ?>

<!DOCTYPE html>
<html>
<head>
    <title>Beli Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card p-4 shadow">

    <h3 class="text-center mb-3">Beli Produk</h3>

    <!-- info produk -->
    <div class="mb-3">
        <p><b>Produk:</b> <?= $p['nama'] ?></p>
        <p><b>Harga:</b> Rp <?= number_format($p['harga']) ?></p>
    </div>

    <hr>

    <form method="POST" action="prosestransaksi.php">

        <input type="hidden" name="id" value="<?= $id ?>">

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_telp" class="form-control" required>
        </div>

        <!-- metode utama -->
        <div class="mb-3">
            <label>Metode Pembayaran</label>
            <select id="metode" class="form-control" required onchange="showSub()">
                <option value="">-- pilih metode --</option>
                <option value="bank">transfer bank</option>
                <option value="ewallet">e-wallet</option>
            </select>
        </div>

        <!-- sub metode -->
        <div class="mb-3">
            <label>Detail Pembayaran</label>
            <select name="metode" id="submetode" class="form-control" required>
                <option value="">-- pilih metode utama dulu --</option>
            </select>
        </div>

        <button class="btn btn-success w-100">Lanjut Pembayaran</button>

    </form>

    <div class="text-center mt-3">
        <a href="index.php" class="btn btn-secondary btn-sm">kembali</a>
    </div>

</div>

</div>

<!-- JS -->
<script>
function showSub() {
    let metode = document.getElementById("metode").value;
    let sub = document.getElementById("submetode");

    if (metode === "bank") {
        sub.innerHTML = `
            <option value="bca">BCA</option>
            <option value="bni">BNI</option>
            <option value="bri">BRI</option>
        `;
    } 
    else if (metode === "ewallet") {
        sub.innerHTML = `
            <option value="gopay">GOPAY</option>
            <option value="ovo">OVO</option>
            <option value="dana">DANA</option>
        `;
    } 
    else {
        sub.innerHTML = `<option value="">-- pilih dulu --</option>`;
    }
}
</script>

</body>
</html>