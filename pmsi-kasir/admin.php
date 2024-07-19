<?php
session_start();
if (empty($_SESSION['id_user'])) {
    //session_destroy();
    $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
    header('Location: ./');
    die();
} else {
    include "koneksi.php";
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

            .jumbotron {
                padding: 4rem 2rem;
                margin: 3rem auto;
                background-color: #f8f9fa;
                border-radius: 0.3rem;
                width: 80%;
            }

            main {
                display: flex;
                justify-content: center;
            }

            h2 {
                color: #1F305A;
            }

            .jumbotron p {
                font-size: 1.25rem;
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

        <main>
            <div class="jumbotron">
                <h2>Selamat Datang di Aplikasi Kasir Carwash Persada</h2>

                <p>Halo <strong><?php echo $_SESSION['nama']; ?></strong>, Anda login sebagai
                    <strong>
                        <?php
                        if ($_SESSION['level'] == 1) {
                            echo 'Admin';
                        } else {
                            echo 'Petugas Kasir';
                        }
                        ?>
                    </strong>
                </p>
            </div>
        </main>
    </body>

    </html>
<?php
}
?>