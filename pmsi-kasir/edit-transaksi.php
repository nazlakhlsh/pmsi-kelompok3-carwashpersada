<?php
include 'koneksi.php';

if (empty($_SESSION['id_user'])) {
    $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
    header('Location: ./');
    die();
} else {
    if (isset($_REQUEST['submit'])) {
        $id_transaksi   = $_REQUEST['id_transaksi'];
        $jenis          = $_REQUEST['jenis'];
        $nama           = $_REQUEST['nama'];
        $bayar          = $_REQUEST['bayar'];
        $kembali        = $_REQUEST['kembali'];
        $total          = $_REQUEST['total'];
        $id_user        = $_SESSION['id_user'];

        $sql = mysqli_query($koneksi, "UPDATE transaksi SET jenis='$jenis', nama='$nama', bayar='$bayar', kembali='$kembali', total='$total', tanggal=NOW(), id_user='$id_user' WHERE id_transaksi='$id_transaksi'");

        if ($sql == true) {
            header('Location: ./admin.php?hlm=transaksi');
            die();
        } else {
            echo 'ERROR! Periksa penulisan querynya.';
        }
    } else {

        $id_transaksi = $_REQUEST['id_transaksi'];

        $sql    = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'");
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
                    <h1>Edit Data Transaksi</h1>
                    <div class="mb-3 row">
                        <a href="transaksi.php">
                            << Kembali ke Halaman Transaksi</a>
                    </div>
                    <form action="" method="post">
                        <div class="mb-3 row">
                            <label for="no_nota" class="col-sm-2 col-form-label">No. Nota</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="no_nota" name="no_nota" value="<?php echo $row['no_nota']; ?>" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="jenis" class="col-sm-2 col-form-label">Jenis Kendaraan</label>
                            <input type="hidden" name="id_transaksi" value="<?php echo $row['id_transaksi']; ?>">
                            <div class="col-sm-10">
                                <select name="jenis" class="form-control" required>
                                    <option value="<?php echo $row['jenis']; ?>"><?php echo $row['jenis']; ?></option>

                                    <?php

                                    $q = mysqli_query($koneksi, "SELECT jenis FROM biaya");
                                    while (list($jenis) = mysqli_fetch_array($q)) {
                                        echo '<option value="' . $jenis . '">' . $jenis . '</option>';
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="bayar" class="col-sm-2 col-form-label">Bayar</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="bayar" name="bayar" value="<?php echo $row['bayar']; ?>" required>

                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="kembali" class="col-sm-2 col-form-label">Kembalian</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="kembali" name="kembali" value="<?php echo $row['kembali']; ?>" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="total" class="col-sm-2 col-form-label">Total Bayar</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="total" name="total" value="<?php echo $row['total']; ?>" required>

                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
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