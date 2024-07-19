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

<body onload="window.print()">
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

    <main>
        <div class="container">
            <?php
            include 'koneksi.php';

            $id_transaksi = $_REQUEST['id_transaksi'];

            $sql = mysqli_query($koneksi, "SELECT no_nota, nama, jenis, bayar, kembali, total, tanggal, id_user FROM transaksi WHERE id_transaksi='$id_transaksi'");

            list($no_nota, $nama, $jenis, $bayar, $kembali, $total, $tanggal, $id_user) = mysqli_fetch_array($sql);

            echo '
                <br>
                <center><h3>Persada Carwash</h3></center>
                <hr/>
                <h4>Nota Nomor : <b>' . $no_nota . '</b></h4>
                <table class="table table-bordered">
                <thead>
                    <tr class="info">
                    <th width="15%">Nama Pelanggan</th>
                    <th width="12%">Jenis</th>
                    <th width="10%">Bayar</th>
                    <th width="10%">Kembali</th>
                    <th width="10%">Total Bayar</th>
                    <th width="10%">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>' . $nama . '</td>
                    <td>' . $jenis . '</td>
                    <td>RP ' . number_format($bayar) . '</td>
                    <td>RP ' . number_format($kembali) . '</td>
                    <td>RP ' . number_format($total) . '</td>
                    <td>' . date("d M Y", strtotime($tanggal)) . '</td>
                    </tr>
                </tbody>
                </table>

                <div style="margin: 0 0 50px 75%;">
                    <p style="margin-bottom: 60px;">Petugas Kasir</p>
                    <p>';

            $sql = mysqli_query($koneksi, "SELECT nama FROM user WHERE id_user='$id_user'");
            list($nama) = mysqli_fetch_array($sql);

            echo "<b><u>$nama</u></b>";

            echo '</p>
                </div>

                <center>-------------------- Terima Kasih ------------------- </center>';
            ?>
        </div>
    </main>
</body>

</html>