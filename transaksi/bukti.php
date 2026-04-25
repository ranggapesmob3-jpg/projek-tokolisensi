<?php
include "../config/koneksi.php";

$id = $_POST['id'] ?? 0;

// function buat nampilin error rapi
function showError($msg, $id) {
    echo "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Upload Gagal</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body class='bg-light'>

    <div class='container mt-5'>
        <div class='card shadow p-4 text-center'>
            <h4 class='text-danger mb-3'>Upload Gagal</h4>
            <p>$msg</p>

            <a href='pembayaran.php?id=$id' class='btn btn-primary'>
                Upload Ulang
            </a>

            <br><br>

            <a href='../index.php' class='btn btn-secondary btn-sm'>
                Kembali ke Beranda
            </a>
        </div>
    </div>

    </body>
    </html>
    ";
    exit;
}

// VALIDASI FILE
if (!isset($_FILES['bukti']) || $_FILES['bukti']['error'] != 0) {
    showError("File tidak valid!", $id);
}

$nama_file = $_FILES['bukti']['name'];
$tmp = $_FILES['bukti']['tmp_name'];
$size = $_FILES['bukti']['size'];

$ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));

// VALIDASI FORMAT
$allowed = ['jpg','jpeg','png'];
if (!in_array($ext, $allowed)) {
    showError("Format harus JPG / PNG!", $id);
}

// VALIDASI SIZE
if ($size > 2 * 1024 * 1024) {
    showError("File terlalu besar (maksimal 2MB)", $id);
}

// RENAME FILE
$new_name = "bukti_" . time() . "." . $ext;

// PATH SIMPAN
$target = __DIR__ . "/../buktitransaksi/" . $new_name;

// UPLOAD FILE
if (!move_uploaded_file($tmp, $target)) {
    showError("Upload gagal, cek folder!", $id);
}

// UPDATE DATABASE
mysqli_query($conn, "UPDATE transaksi 
SET bukti='$new_name', status='menunggu'
WHERE id=$id");

// REDIRECT SUKSES
header("Location: invoice.php?id=$id");
exit;
?>