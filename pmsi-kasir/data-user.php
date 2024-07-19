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
                include 'input-user.php';
                break;
            case 'edit':
                include 'edit-user.php';
                break;
            case 'hapus':
                include 'hapus-user.php';
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
                <h2>Daftar User</h2>
                <p>
                    <a href="input-user.php">
                        <input type="button" class="btn btn-primary" value="Tambah Data" />
                    </a>
                </p>
                <table class="table">
                    <thead>
                        <tr class="info">
                            <th width="5%">No</th>
                            <th width="22%">Username</th>
                            <th width="33%">Nama</th>
                            <th width="20%">Level</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $koneksi    = mysqli_connect("localhost", "root", "", "carwash-persada");
                        $sql    = mysqli_query($koneksi, "SELECT * FROM user");
                        if (mysqli_num_rows($sql) > 0) {
                            $no = 0;

                            while ($row = mysqli_fetch_array($sql)) {
                                $no++;
                                echo '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row['username'] . '</td>
                            <td>' . $row['nama'] . '</td>
                            <td>';

                                if ($row['level'] ==  1) {
                                    echo 'Admin';
                                } else {
                                    echo 'User Biasa';
                                }

                                echo '</td>
                            <td>
                            <script type="text/javascript" language="JavaScript">
                                function konfirmasi() {
						  	        tanya = confirm("Anda yakin akan menghapus user ini?");
						  	        if (tanya == true) return true;
						  	        else return false;
						        }
					        </script>

					        <a href="?hlm=user&aksi=edit&id_user=' . $row['id_user'] . '" class="btn btn-warning btn-s">Edit</a>
					        <a href="?hlm=user&aksi=hapus&submit=yes&id_user=' . $row['id_user'] . '" onclick="return konfirmasi()" class="btn btn-danger btn-s">Hapus</a>
                            
                            </td>';
                            }
                        } else {
                            echo '<td colspan="8"><center><p class="add">Tidak ada data untuk ditampilkan. <u><a href="?hlm=user&aksi=baru">Tambah user baru</a></u> </p></center></td></tr>';
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