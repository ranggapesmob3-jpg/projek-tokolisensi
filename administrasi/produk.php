<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM produk");
$total = mysqli_num_rows($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Manajemen Produk</h3>

        <div>
            <!-- 🔥 TAMBAHAN -->
            <a href="transaksi.php" class="btn btn-primary">
                Transaksi
            </a>

            <a href="tambahproduk.php" class="btn btn-success">
                + Tambah Produk
            </a>

            <a href="logout.php" class="btn btn-danger">
                Logout
            </a>
        </div>
    </div>

    <!-- TOTAL -->
    <p>Total Produk: <b><?= $total ?></b></p>

    <!-- TABLE -->
    <div class="card p-3">

        <table class="table table-bordered text-center align-middle">

            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php while ($p = mysqli_fetch_assoc($data)) { ?>

                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= $p['nama'] ?></td>
                    <td>Rp <?= number_format($p['harga']) ?></td>

                    <td>
                        <a href="updateproduk.php?id=<?= $p['id'] ?>" 
                           class="btn btn-warning btn-sm">
                           Update
                        </a>

                        <a href="hapusproduk.php?id=<?= $p['id'] ?>" 
                           onclick="return confirm('Yakin mau hapus produk ini?')" 
                           class="btn btn-danger btn-sm">
                           Hapus
                        </a>
                    </td>
                </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>