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
                include 'input-transaksi.php';
                break;
            case 'edit':
                include 'edit-transaksi.php';
                break;
            case 'hapus':
                include 'hapus-transaksi.php';
                break;
            case 'cetak':
                include 'cetak-transaksi.php';
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

                main {
                    padding: 2rem 0;
                }

                .badge {
                    font-size: 1rem;
                    padding: 0.5rem 1rem;
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
                <h1>Daftar Transaksi</h1>
                <p>
                    <a href="input-transaksi.php">
                        <input type="button" class="btn btn-primary" value="Tambah Transaksi Baru" />
                    </a>
                </p>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">No Nota</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Total Bayar</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'koneksi.php'; // Pastikan untuk menginclude file koneksi ke database
                        $sql = mysqli_query($koneksi, "SELECT * FROM transaksi");
                        if (mysqli_num_rows($sql) > 0) {
                            $no = 1;
                            while ($row = mysqli_fetch_array($sql)) {
                        ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['no_nota']; ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td><?php echo $row['jenis']; ?></td>
                                    <td>Rp <?php echo number_format($row['total']); ?></td>
                                    <td><?php echo date("d M Y", strtotime($row['tanggal'])); ?></td>
                                    <td>
                                        <a href="?hlm=transaksi&aksi=edit&id_transaksi=<?php echo $row['id_transaksi']; ?>" class="btn btn-warning btn-s">
                                            <span class="badge bg-warning text-dark">Edit</span>
                                        </a>
                                        <a href="?hlm=transaksi&aksi=hapus&submit=yes&id_transaksi=<?php echo $row['id_transaksi']; ?>" onclick="return konfirmasi()" class="btn btn-danger btn-s">
                                            <span class="badge bg-danger">Delete</span>
                                        </a>
                                        <a href="?hlm=transaksi&aksi=cetak&id_transaksi=<?php echo $row['id_transaksi']; ?>" class="btn btn-success btn-s" target="_blank">
                                            <span class="badge bg-success">Cetak Nota</span>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo '<tr><td colspan="8"><center><p class="add">Tidak ada data untuk ditampilkan. <u><a href="?hlm=transaksi&aksi=baru"></a></u></p></center></td></tr>';
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