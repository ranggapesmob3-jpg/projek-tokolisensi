<?php
session_start();
$error = "";

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if ($user == "admin" && $pass == "123") {
        $_SESSION['login'] = true;
        header("Location: produk.php");
        exit;
    } else {
        $error = "Login gagal! Username atau password salah";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script>
    function validasiLogin() {
        let user = document.getElementById("user").value;
        let pass = document.getElementById("pass").value;

        if(user === "" || pass === "") {
            alert("Username dan password wajib diisi!");
            return false;
        }
        return true;
    }
    </script>
</head>

<body class="bg-light">

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow" style="width: 350px;">
        <h4 class="text-center mb-3">Login Admin</h4>

        <?php if ($error != "") { ?>
            <div class="alert alert-danger text-center">
                <?= $error ?>
            </div>
        <?php } ?>

        <form method="POST" onsubmit="return validasiLogin()">
            <input type="text" id="user" name="username" class="form-control mb-2" placeholder="Username">
            <input type="password" id="pass" name="password" class="form-control mb-3" placeholder="Password">
            <button name="login" class="btn btn-primary w-100">Login</button>
        </form>

    </div>
</div>

</body>
</html>