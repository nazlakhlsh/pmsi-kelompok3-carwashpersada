<?php
session_start();
include('koneksi.php');

if (empty($_SESSION['id_user'])) {
    $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
    header('Location: ./');
    die();
} else {
    if (isset($_POST['submit'])) {
        $username   = $_POST['username'];
        $password   = $_POST['password'];
        $nama       = $_POST['nama'];
        $alamat     = $_POST['alamat'];
        $hp         = $_POST['hp'];
        $level      = $_POST['level'];

        $sql    = mysqli_query($koneksi, "INSERT INTO user(username, password, nama, alamat, hp, level) VALUES('$username', '$password', '$nama', '$alamat', '$hp', '$level')");

        if ($sql == true) {
            echo "<script>
            alert('Data berhasil disimpan');
            window.location.href = './admin.php?hlm=user';
            </script>";
            die();
        } else {
            echo 'ERROR! Periksa penulisan querynya.';
        }
    } else {
?>


        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>CARWASH PERSADA - CASHIER</title>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <style>
                .panel-title {
                    font-size: 24px;
                    font-weight: bold;
                }

                .navbar-brand {
                    display: flex;
                    align-items: center;
                }

                .navbar-nav {
                    margin-left: 20px;
                    display: flex;
                    align-items: center;
                }

                .nav-item {
                    margin-left: 15px;
                }

                .nav-link {
                    color: white !important;
                }
            </style>
        </head>

        <body>
            <header>
                <nav class="navbar navbar-expand-lg" style="background-color: #1F305A;">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">
                            <img src="images/LOGO WHITE 2 (2).png" alt="Logo">
                        </a>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 flex-row">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="admin.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="transaksi.php">Transaction</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="laporan.php">Report</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Data Master
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="data-biaya.php">Data Biaya</a></li>
                                    <li><a class="dropdown-item" href="data-user.php">Data User</a></li>
                                </ul>
                            </li>
                        </ul>
                        <a class="nav-link" href="logout.php">Log Out >></a>
                    </div>
                </nav>
            </header>

            <main class="container">
                <br>
                <h1>Tambah User Baru</h1>
                <div class="mb-3 row">
                    <a href="data-user.php">
                        << Kembali ke Halaman Data User</a>
                </div>
                <form action="" method="post">
                    <div class="mb-3 row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama User</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="alamat" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="hp" class="col-sm-2 col-form-label">Nomor HP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="hp" name="hp" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jenis" class="col-sm-2 col-form-label">Jenis User</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="level" name="level">
                                <option value="">--- Pilih Jenis User ---</option>
                                <option value="1">Admin</option>
                                <option value="2">User Biasa</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <input type="submit" name="submit" value="Simpan Data" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </main>
        </body>

        </html>
<?php
    }
}
?>