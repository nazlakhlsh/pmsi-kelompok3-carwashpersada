<?php
include 'koneksi.php';

if (empty($_SESSION['id_user'])) {
    $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
    header('Location: ./');
    die();
} else {
    if (isset($_REQUEST['submit'])) {
        $id_user = $_REQUEST['id_user'];
        $level = $_REQUEST['level'];

        // Pastikan user ID 1 tidak dapat diubah levelnya
        if ($id_user == 1) {
            header("location: ./admin.php?hlm=user");
            die();
        }

        // Lakukan update data user
        $sql = mysqli_query($koneksi, "UPDATE user SET level='$level' WHERE id_user='$id_user'");

        if ($sql) {
            header('Location: ./admin.php?hlm=user');
            die();
        } else {
            echo 'ERROR! Periksa penulisan querynya.';
        }
    } else {
        $id_user = $_REQUEST['id_user'];
        $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user'");
        $row = mysqli_fetch_array($sql);

        if ($row) {
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
                    <h1>Edit Tipe User</h1>
                    <div class="mb-3 row">
                        <a href="data-user.php">
                            << Kembali ke Halaman Data User</a>
                    </div>
                    <form action="" method="post">
                        <div class="mb-3 row">
                            <input type="hidden" name="id_user" value="<?php echo $row['id_user']; ?>">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama User</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="jenis" class="col-sm-2 col-form-label">Jenis User</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="level" name="level">
                                    <option value="1" <?php if ($row['level'] == 1) echo 'selected'; ?>>Admin</option>
                                    <option value="2" <?php if ($row['level'] == 2) echo 'selected'; ?>>User Biasa</option>
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
        } else {
            echo "User tidak ditemukan!";
        }
    }
}
?>