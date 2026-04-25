<?php
include "../config/koneksi.php";

$id = $_POST['id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$no_telp = $_POST['no_telp'];
$metode = $_POST['metode'];

// ambil produk
$p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id=$id"));

// hitung pajak
$pajak = $p['harga'] * 0.1;
$total = $p['harga'] + $pajak;

// simpan transaksi (BELUM ada lisensi)
mysqli_query($conn, "INSERT INTO transaksi 
(nama,email,no_telp,produk_id,metode,status,total,pajak)
VALUES 
('$nama','$email','$no_telp','$id','$metode','pending','$total','$pajak')");

$trx_id = mysqli_insert_id($conn);

// redirect ke pembayaran
header("Location: pembayaran.php?id=$trx_id");
exit;