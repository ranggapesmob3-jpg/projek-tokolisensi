<?php
include "../config/koneksi.php";

if (isset($_POST['submit'])) {

    $nama = trim($_POST['nama']);
    $harga = $_POST['harga'];

    // validasi
    if ($nama == "" || $harga == "") {
        echo "<div class='alert alert-danger'>nama dan harga wajib diisi</div>";
    } else {

        // cek duplikat
        $cek = mysqli_query($conn, "SELECT * FROM produk WHERE nama='$nama'");

        if (mysqli_num_rows($cek) > 0) {
            echo "<div class='alert alert-danger'>produk sudah ada</div>";
        } else {

            mysqli_query($conn, "INSERT INTO produk (nama, harga) VALUES ('$nama','$harga')");

            // redirect setelah sukses
            echo "<script>
                alert('produk berhasil ditambahkan');
                window.location='produk.php';
            </script>";
            exit;
        }
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2>Tambah Produk</h2>

    <form method="POST">
        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Produk">

        <input type="number" name="harga" class="form-control mb-3" placeholder="Harga">

        <button name="submit" class="btn btn-success">tambah</button>

        <!-- tombol balik -->
        <a href="produk.php" class="btn btn-secondary ms-2">kembali</a>
    </form>
</div>