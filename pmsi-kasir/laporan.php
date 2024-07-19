<?php
session_start(); // pastikan session dimulai
if (empty($_SESSION['id_user'])) {
    $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
    header('Location: ./');
    die();
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

            .form-inline {
                gap: 10px;
            }

            .table-bordered {
                margin-top: 20px;
            }

            .well-sm {
                margin-bottom: 20px;
            }

            .form-container {
                display: flex;
                gap: 10px;
                /* Jarak antara kolom */
            }

            .form-group {
                flex: 1;
            }

            .short-date-input {
                width: 100%;
                /* Mengatur lebar input sesuai dengan kolom */
            }

            .btn-success {
                margin-top: 10px;
                /* Jarak antara form dan tombol */
            }
        </style>

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
            <?php
            include 'koneksi.php'; // pastikan file koneksi di-include
            if (isset($_REQUEST['submit'])) {
                $submit = $_REQUEST['submit'];
                $tgl1 = $_REQUEST['tgl1'];
                $tgl2 = $_REQUEST['tgl2'];

                $sql = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE tanggal BETWEEN '$tgl1' AND '$tgl2'");
                if (mysqli_num_rows($sql) > 0) {
                    $no = 0;

                    echo '<h2>Rekap Laporan Penghasilan <small>' . $tgl1 . ' sampai ' . $tgl2 . '</small></h2><hr>
                <div class="col-sm-1">
                    <a href="?hlm=laporan" id="tombol" class="btn btn-info pull-left"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Kembali</a><br/><br/><br/>
                    <button id="tombol" onclick="window.print()" class="btn btn-warning"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</button>
                </div>
                <div class="col-sm-11">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="info">
                                <th width="5%">No</th>
                                <th width="10%">No. Nota</th>
                                <th width="20%">Nama Pelanggan</th>
                                <th width="20%">Jenis</th>
                                <th width="10%">Total Bayar</th>
                                <th width="10%">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>';

                    while ($row = mysqli_fetch_array($sql)) {
                        $no++;
                        echo '<tr>
                            <td>' . $no . '</td>
                            <td>' . $row['no_nota'] . '</td>
                            <td>' . $row['nama'] . '</td>
                            <td>' . $row['jenis'] . '</td>
                            <td>RP. ' . number_format($row['total']) . '</td>
                            <td>' . date("d M Y", strtotime($row['tanggal'])) . '</td>
                          </tr>';
                    }
                    echo '</tbody>
                    </table>
                    <div class="col-sm-6">
                        <table class="table table-bordered">
                            <tr class="info">
                                <th><h4>Jumlah Pelanggan</h4></th>
                                <th><h4>Jumlah Pendapatan</h4></th>
                            </tr>';
                    $sql = mysqli_query($koneksi, "SELECT count(nama), sum(total) FROM transaksi WHERE tanggal BETWEEN '$tgl1' AND '$tgl2'");
                    list($nama, $total) = mysqli_fetch_array($sql);
                    echo '<tr>
                        <td><span class="pull-right"><h4><b>' . $nama . ' Orang</b></h4></span></td>
                        <td><span class="pull-right"><h4><b>RP. ' . number_format($total) . '</b></h4></span></td>
                      </tr>
                      </table>
                    </div>
                </div>
            </div>
        </div>';
                }
            } else {
                echo '<h2>Rekap Laporan Penghasilan Hari Ini (<small>' . date('d-m-Y') . '</small>)</h2><hr>';
            ?>
                <div class="well well-sm noprint">
                    <form class="form-inline" role="form" method="post" action="">
                        <div class="form-container">
                            <div class="form-group">
                                <label class="sr-only" for="tgl1">Mulai</label>
                                <input type="date" class="form-control short-date-input" id="tgl1" name="tgl1" required>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="tgl2">Hingga</label>
                                <input type="date" class="form-control short-date-input" id="tgl2" name="tgl2" required>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success">Tampilkan</button>
                    </form>
                </div>
            <?php
                echo '<div class="col-sm-6"><table class="table table-bordered">';
                echo '<tr class="info"><th><h4>Jumlah Pelanggan</h4></th><th><h4>Jumlah Pendapatan</h4></th></tr>';
                $tanggal = date('Y-m-d');
                $sql = mysqli_query($koneksi, "SELECT count(nama), sum(total) FROM transaksi WHERE tanggal='$tanggal'");
                list($nama, $total) = mysqli_fetch_array($sql);
                echo '<tr><td><span class="pull-right"><h4><b>' . $nama . ' Orang</b></h4></span></td><td><span class="pull-right"><h4><b>RP. ' . number_format($total) . '</b></h4></span></td></tr>';
                echo '</table></div>
            <div class="col-sm-1">
                <button id="tombol" onclick="window.print()" class="btn btn-warning pull-right"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</button>
            </div>
            </div>
            </div>';
            }
            ?>
        </main>
    </body>

    </html>
<?php
}
?>