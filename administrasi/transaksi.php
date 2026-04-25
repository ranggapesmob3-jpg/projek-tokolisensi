<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$data = mysqli_query($conn, "
SELECT t.*, p.nama AS produk 
FROM transaksi t
JOIN produk p ON t.produk_id = p.id
ORDER BY t.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Data Transaksi</h3>

    <div>
        <a href="produk.php" class="btn btn-secondary">Produk</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>

<div class="card p-3 shadow">

<table class="table table-bordered text-center align-middle">

<thead class="table-dark">
<tr>
    <th>ID</th>
    <th>Produk</th>
    <th>Nama</th>
    <th>Metode</th>
    <th>Total</th>
    <th>Status</th>
    <th>Bukti</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>

<?php while ($d = mysqli_fetch_assoc($data)) { ?>

<tr>
    <td><?= $d['id'] ?></td>
    <td><?= $d['produk'] ?></td>
    <td><?= $d['nama'] ?></td>
    <td><?= strtoupper($d['metode']) ?></td>
    <td>Rp <?= number_format($d['total']) ?></td>

    <td>
        <?php if ($d['status'] == 'pending') { ?>
            <span class="badge bg-secondary">pending</span>
        <?php } elseif ($d['status'] == 'menunggu') { ?>
            <span class="badge bg-warning">menunggu</span>
        <?php } else { ?>
            <span class="badge bg-success">paid</span>
        <?php } ?>
    </td>

    <td>
        <?php if ($d['bukti']) { ?>
            <!-- 🔥 FIX DI SINI -->
            <a href="../buktitransaksi/<?= $d['bukti'] ?>" target="_blank" class="btn btn-info btn-sm">
                lihat
            </a>
        <?php } else { ?>
            -
        <?php } ?>
    </td>

    <td>
        <?php if ($d['status'] == 'menunggu') { ?>
            <a href="acc.php?id=<?= $d['id'] ?>" 
               class="btn btn-success btn-sm"
               onclick="return confirm('ACC transaksi ini?')">
               ACC
            </a>
        <?php } else { ?>
            -
        <?php } ?>
    </td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>
</html>