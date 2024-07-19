<?php
include 'koneksi.php';

if (empty($_SESSION['id_user'])) {
    $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
    header('Location: ./');
    die();
} else {
    if (isset($_REQUEST['submit'])) {

        $id_biaya = $_REQUEST['id_biaya'];
        $jenis = $_REQUEST['jenis'];
        $biaya = $_REQUEST['biaya'];

        $sql = mysqli_query($koneksi, "UPDATE biaya SET jenis='$jenis', biaya='$biaya' WHERE id_biaya='$id_biaya'");

        if ($sql == true) {
            header('Location: ./admin.php?hlm=biaya');
            die();
        } else {
            echo 'ERROR! Periksa penulisan querynya.';
        }
    } else {

        $id_biaya = $_REQUEST['id_biaya'];

        $sql = mysqli_query($koneksi, "SELECT * FROM biaya WHERE id_biaya='$id_biaya'");
        while ($row = mysqli_fetch_array($sql)) {
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
                    <h2>Edit Data Master Biaya Jasa</h2>
                    <div class="mb-3 row">
                        <a href="data-biaya.php">
                            << Kembali ke Halaman Data Master Biaya Jasa</a>
                    </div>
                    <form action="" method="post">
                        <div class="mb-3 row">
                            <label for="jenis" class="col-sm-2 col-form-label">Jenis Kendaraan</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="id_biaya" value="<?php echo $row['id_biaya']; ?>">
                                <input type="text" class="form-control" id="jenis" name="jenis" value="<?php echo $row['jenis']; ?>" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="biaya" class="col-sm-2 col-form-label">Biaya Jasa</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="biaya" name="biaya" value="<?php echo $row['biaya']; ?>" required>
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
}
?>