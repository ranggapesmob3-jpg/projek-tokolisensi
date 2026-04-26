<?php
include "config/koneksi.php";
$data = mysqli_query($conn, "SELECT * FROM produk");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Toko Lisensi Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-dark">
  <div class="container d-flex justify-content-between">
    <span class="navbar-brand">Lisenstore</span>

    <!-- 🔥 SATU-SATUNYA TOMBOL CEK -->
    <a href="cektransaksi.php" class="btn btn-info btn-sm">
        status pembayaran saya
    </a>
  </div>
</nav>

<div class="container mt-5">

    <!-- HEADER -->
    <h2 class="text-center mb-4">Toko Lisensi Digital</h2>

    <div class="row">

        <?php while($p = mysqli_fetch_assoc($data)) { ?>

        <?php
        $stok = mysqli_query($conn, "
        SELECT COUNT(*) as total 
        FROM lisensi 
        WHERE produk_id=".$p['id']." AND status='tersedia'");
        $s = mysqli_fetch_assoc($stok);
        ?>

        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">

                <div class="card-body text-center">
                    <h5 class="card-title"><?= $p['nama'] ?></h5>

                    <p class="text-success fw-bold">
                        Rp <?= number_format($p['harga']) ?>
                    </p>

                    <p>
                        Stok: <b><?= $s['total'] ?></b>
                    </p>

                    <?php if ($s['total'] > 0) { ?>
                    <a href="transaksi/beli.php?id=<?= $p['id'] ?>" 
                    class="btn btn-primary">
                    Beli Sekarang
                    </a>
                    <?php } else { ?>
                        <button class="btn btn-secondary" disabled>
                            Stok Habis
                        </button>
                    <?php } ?>

                </div>

            </div>
        </div>

        <?php } ?>

    </div>

</div>

<!-- FOOTER -->
<div class="text-center mt-4 mb-5">

    <!-- ❌ SUDAH DIHAPUS tombol cek status -->
    
    <a href="administrasi/login.php" class="btn btn-dark">
        Masuk Admin
    </a>

</div>

</body>
</html>