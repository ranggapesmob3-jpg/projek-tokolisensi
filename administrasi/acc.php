<?php
session_start();
include "../config/koneksi.php";

// 🔒 PROTEKSI ADMIN
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

// mulai transaksi
mysqli_begin_transaction($conn);

try {

    // ambil transaksi
    $trx = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM transaksi WHERE id=$id"));

    if (!$trx) {
        throw new Exception("transaksi tidak ditemukan");
    }

    // 🔒 OPTIONAL (biar makin aman)
    if ($trx['status'] != 'menunggu') {
        throw new Exception("transaksi belum siap di-ACC");
    }

    // ambil lisensi
    $l = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT * FROM lisensi 
    WHERE produk_id=".$trx['produk_id']." 
    AND status='tersedia'
    LIMIT 1 FOR UPDATE
    "));

    if (!$l) {
        throw new Exception("stok lisensi habis");
    }

    // update lisensi
    mysqli_query($conn, "
    UPDATE lisensi 
    SET status='terjual' 
    WHERE id=".$l['id']."
    ");

    // update transaksi
    mysqli_query($conn, "
    UPDATE transaksi 
    SET status='paid', lisensi_id=".$l['id']." 
    WHERE id=$id
    ");

    mysqli_commit($conn);

    header("Location: transaksi.php?msg=berhasil");
    exit;

} catch (Exception $e) {

    mysqli_rollback($conn);

    echo "<h3 style='text-align:center;margin-top:50px'>".$e->getMessage()."</h3>";
}
?>