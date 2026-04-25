<?php
include "../config/koneksi.php";

$id = $_GET['id'];

// ambil data produk
$p = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id");
$d = mysqli_fetch_assoc($p);

$success = "";
$error = "";

// update produk
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];

    if ($nama == "" || $harga == "") {
        $error = "nama dan harga tidak boleh kosong!";
    } else {
        mysqli_query($conn, "UPDATE produk SET nama='$nama', harga='$harga' WHERE id=$id");
        $success = "produk berhasil diupdate!";
    }
}

// tambah stok otomatis
if (isset($_POST['tambah_stok'])) {
    $jumlah = $_POST['jumlah'];

    if ($jumlah <= 0) {
        $error = "jumlah harus lebih dari 0!";
    } else {

        // tentuin prefix sesuai produk
        if (strpos(strtoupper($d['nama']), 'WINDOWS') !== false) {
            $prefix = "WIN11-W";
        } elseif (strpos(strtoupper($d['nama']), 'VPN') !== false) {
            $prefix = "VPN-";
        } elseif (strpos(strtoupper($d['nama']), 'STEAM') !== false) {
            $prefix = "STEAM-";
        } elseif (strpos(strtoupper($d['nama']), 'OFFICE') !== false) {
            $prefix = "OFF-";
        } else {
            $prefix = "KEY-";
        }

        // hitung jumlah lisensi yg udah ada
        $q = mysqli_query($conn, "SELECT COUNT(*) as total FROM lisensi WHERE produk_id='$id'");
        $data_count = mysqli_fetch_assoc($q);
        $start = $data_count['total'] + 1;

        // generate lisensi
        for ($i = 0; $i < $jumlah; $i++) {
            $kode = $prefix . ($start + $i);

            mysqli_query($conn, "INSERT INTO lisensi (produk_id, kode, status) 
            VALUES ('$id','$kode','tersedia')");
        }

        $success = "stok berhasil ditambahkan sebanyak $jumlah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-light">

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 400px; background-color: #1e1e2f; border-radius: 15px;">

        <h4 class="text-center mb-3">Update Produk</h4>

        <?php if ($error != "") { ?>
            <div class="alert alert-danger text-center">
                <?= $error ?>
            </div>
        <?php } ?>

        <?php if ($success != "") { ?>
            <div class="alert alert-success text-center">
                <?= $success ?>
            </div>
        <?php } ?>

        <!-- form update -->
        <form method="POST" class="mb-3">
            <div class="mb-2">
                <input type="text" name="nama" value="<?= $d['nama'] ?>" class="form-control">
            </div>

            <div class="mb-3">
                <input type="number" name="harga" value="<?= $d['harga'] ?>" class="form-control">
            </div>

            <button name="update" class="btn btn-warning w-100">
                update produk
            </button>
        </form>

        <hr class="border-light">

        <!-- form tambah stok -->
        <h5 class="text-center mb-2">tambah stok</h5>

        <form method="POST">
            <div class="mb-3">
                <input type="number" name="jumlah" class="form-control" placeholder="jumlah stok">
            </div>

            <button name="tambah_stok" class="btn btn-success w-100">
                tambah
            </button>
        </form>

        <div class="text-center mt-3">
            <a href="produk.php" class="btn btn-outline-light btn-sm">
                kembali
            </a>
        </div>

    </div>

</div>

</body>
</html>