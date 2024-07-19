<?php
session_start(); // Pastikan session dimulai

if (empty($_SESSION['id_user'])) {
    $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu';
    header('Location: ./');
    die();
} else {
    if (isset($_REQUEST['aksi'])) {
        $aksi = $_REQUEST['aksi'];
        switch ($aksi) {
            case 'baru':
                include 'input-biaya.php';
                break;
            case 'edit':
                include 'edit-biaya.php';
                break;
            case 'hapus':
                include 'hapus-biaya.php';
                break;
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
                <h2>Data Master Biaya Jasa</h2>
                <p>
                    <a href="input-biaya.php">
                        <input type="button" class="btn btn-primary" value="Tambah Data" />
                    </a>
                </p>
                <table class="table">
                    <thead>
                        <tr class="info">
                            <th width="10%">No</th>
                            <th width="35%">Jenis Kendaraan</th>
                            <th width="35%">Biaya</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $koneksi    = mysqli_connect("localhost", "root", "", "carwash-persada");
                        $sql        = mysqli_query($koneksi, "SELECT * FROM biaya");
                        if (mysqli_num_rows($sql) > 0) {
                            $no = 0;
                            while ($row = mysqli_fetch_array($sql)) {
                                $no++;
                                echo '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row['jenis'] . '</td>
                            <td>' . $row['biaya'] . '</td>
                            <td>
                                <script type="text/javascript" language="JavaScript">
                                    function konfirmasi() {
                                        tanya = confirm("Apakah Anda yakin ingin menghapus data ini?");
                                        if (tanya == true) return true;
                                        else return false;
                                    }
                                </script>
                                <a href="?hlm=biaya&aksi=edit&id_biaya=' . $row['id_biaya'] . '" class="btn btn-warning btn-s">Edit</a>
                                <a href="?hlm=biaya&aksi=hapus&submit=yes&id_biaya=' . $row['id_biaya'] . '" onclick="return konfirmasi()" class="btn btn-danger btn-s">Hapus</a>
                            </td>
                        </tr>';
                            }
                        } else {
                            echo '<tr><td colspan="8"><center><p class="add">Tidak ada data untuk ditampilkan. </p></center></td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </main>
        </body>

        </html>
<?php
    }
}
?>