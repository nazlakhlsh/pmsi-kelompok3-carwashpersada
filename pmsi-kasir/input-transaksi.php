<?php
session_start();
include('koneksi.php');

if (empty($_SESSION['id_user'])) {
    $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
    header('Location: ./');
    die();
} else {
    if (isset($_POST['submit'])) {
        $no_nota    = $_POST['no_nota'];
        $jenis      = $_POST['jenis'];
        $nama       = $_POST['nama'];
        $bayar      = $_POST['bayar'];
        $kembali    = $_POST['kembali'];
        $total      = $_POST['total'];
        $id_user    = $_SESSION['id_user'];

        $sql = mysqli_query($koneksi, "INSERT INTO transaksi(no_nota, jenis, nama, bayar, kembali, total, tanggal, id_user) VALUES('$no_nota', '$jenis', '$nama', '$bayar', '$kembali', '$total', NOW(), '$id_user')");

        if ($sql) {
            echo "<script>
            alert('Data berhasil disimpan');
            window.location.href = './admin.php?hlm=transaksi';
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
                <h1>Tambah Transaksi Baru</h1>
                <div class="mb-3 row">
                    <a href="transaksi.php">
                        << Kembali ke Halaman Transaksi</a>
                </div>
                <form action="" method="post">
                    <div class="mb-3 row">
                        <label for="no_nota" class="col-sm-2 col-form-label">No. Nota</label>
                        <div class="col-sm-10">
                            <?php
                            $sql = mysqli_query($koneksi, "SELECT no_nota FROM transaksi ORDER BY no_nota DESC LIMIT 1");
                            $no_nota = "C001";
                            if (mysqli_num_rows($sql) > 0) {
                                $row = mysqli_fetch_array($sql);
                                $last_no_nota = $row['no_nota'];
                                $no_nota = 'C' . str_pad(substr($last_no_nota, 1) + 1, 3, '0', STR_PAD_LEFT);
                            }
                            ?>
                            <input type="text" class="form-control" id="no_nota" name="no_nota" value="<?php echo $no_nota; ?>" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jenis" class="col-sm-2 col-form-label">Jenis Kendaraan</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="jenis" name="jenis">
                                <option value="" disabled selected>--- Pilih Jenis Kendaraan ---</option>
                                <?php
                                $q = mysqli_query($koneksi, "SELECT * FROM biaya");
                                while ($data = mysqli_fetch_array($q)) {
                                    echo '<option value="' . $data['biaya'] . '">' . $data['jenis'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="biaya" class="col-sm-2 col-form-label">Biaya</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="biaya" name="biaya" value="" required readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="bayar" class="col-sm-2 col-form-label">Bayar</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="bayar" name="bayar">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="kembali" class="col-sm-2 col-form-label">Kembalian</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="kembali" name="kembali" required readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="total" class="col-sm-2 col-form-label">Total Bayar</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="total" name="total" required readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama">
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

            <script>
            document.getElementById('jenis').addEventListener('change', function() {
            var selectedBiaya = parseFloat(this.value) || 0;
            var bayar = parseFloat(document.getElementById('bayar').value) || 0;
            var biayaInput = document.getElementById('biaya');
            var kembaliInput = document.getElementById('kembali');
            var totalInput = document.getElementById('total');
            
            biayaInput.value = selectedBiaya;
            totalInput.value = selectedBiaya;

            var kembalian = bayar - selectedBiaya;
            kembaliInput.value = kembalian;

            if (kembalian < 0) {
                var tambahanBayar = -kembalian;
            }
            });

            document.getElementById('bayar').addEventListener('input', function() {
            var biaya = parseFloat(document.getElementById('biaya').value) || 0;
            var bayar = parseFloat(this.value) || 0;
            var kembalian = bayar - biaya;
            document.getElementById('kembali').value = kembalian;

                if (kembalian < 0) {
                var tambahanBayar = -kembalian;
                    }
            });
            </script>

        </body>

        </html>
<?php
    }
}
?>