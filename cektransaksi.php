<?php
include "config/koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cek Status Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card p-4 shadow">

    <h3 class="text-center mb-3">Cek Status Transaksi</h3>

    <!-- FORM -->
    <form method="POST">
        <input type="text" name="email" class="form-control mb-3" placeholder="Masukkan Email" required>
        <button class="btn btn-primary w-100">Cari Transaksi</button>
    </form>

    <hr>

    <?php
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        $q = mysqli_query($conn, "
        SELECT t.*, p.nama AS produk 
        FROM transaksi t
        JOIN produk p ON t.produk_id = p.id
        WHERE t.email='$email'
        ORDER BY t.id DESC
        ");

        if (mysqli_num_rows($q) == 0) {
            echo "<div class='alert alert-danger text-center'>Transaksi tidak ditemukan</div>";
        } else {

            echo "<table class='table table-bordered text-center align-middle'>";
            echo "<thead class='table-dark'>
                    <tr>
                        <th>ID</th>
                        <th>Produk</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                  </thead><tbody>";

            while ($d = mysqli_fetch_assoc($q)) {

                // badge status
                if ($d['status'] == 'pending') {
                    $status = "<span class='badge bg-secondary'>Pending</span>";
                } elseif ($d['status'] == 'menunggu') {
                    $status = "<span class='badge bg-warning'>Menunggu Verifikasi</span>";
                } else {
                    $status = "<span class='badge bg-success'>Berhasil</span>";
                }

                echo "<tr>";
                echo "<td>#".$d['id']."</td>";
                echo "<td>".$d['produk']."</td>";
                echo "<td>".$status."</td>";
                echo "<td>
                        <a href='transaksi/invoice.php?id=".$d['id']."' class='btn btn-success btn-sm'>
                            Lihat
                        </a>
                      </td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
        }
    }
    ?>

    <!-- tombol balik -->
    <div class="text-center mt-3">
        <a href="index.php" class="btn btn-secondary">← Kembali</a>
    </div>

</div>

</div>

</body>
</html>