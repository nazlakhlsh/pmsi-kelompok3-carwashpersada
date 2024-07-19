<?php
//memulai session 
session_start();

//jika ada session, maka akan diarahkan ke halaman dashboard admin
if (isset($_SESSION['id_user'])) {

    //mengarahkan ke halaman dashboard admin
    header("Location: ./admin.php");
    die();
}

//mengincludekan koneksi database
include "koneksi.php"
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
            /* Ubah ukuran font sesuai kebutuhan */
            font-weight: bold;
            /* Tambahkan jika ingin huruf tebal */
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-light" style="background-color: #1F305A;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="images/LOGO WHITE 2 (2).png" alt="Logo" style="margin-left: 15px;">
                </a>
            </div>
        </nav>
    </header>

    <main class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading text-center">
                    <div class="panel-title">Log In</div>
                </div>
                <div class="panel-body" style="padding-top:30px;">

                    <?php
                    //apabila tombol login di klik akan menjalankan skript dibawah ini
                    if (isset($_REQUEST['login'])) {

                        //mendeklarasikan data yang akan dimasukkan ke dalam database
                        $username = $_REQUEST['username'];
                        $password = $_REQUEST['password'];

                        //skript query ke insert data ke dalam database
                        $sql    = mysqli_query($koneksi, "SELECT id_user, username, nama, level FROM user WHERE username='$username' AND password=MD5('$password')");

                        //jika skript query benar maka akan membuat session
                        if ($sql) {
                            list($id_user, $username, $nama, $level) = mysqli_fetch_array($sql);

                            //membuat session
                            $_SESSION['id_user'] = $id_user;
                            $_SESSION['username'] = $username;
                            $_SESSION['nama'] = $nama;
                            $_SESSION['level'] = $level;

                            header("Location: ./admin.php");
                            die();
                        } else {

                            $_SESSION['err'] = '<strong>ERROR!</strong> Username dan Password tidak ditemukan.';
                            header('Location: ./');
                            die();
                        }
                    } else {
                    ?>
                        <form id="loginform" class="form-horizontal" action="" method="post" role="form">
                            <?php
                            if (isset($_SESSION['err'])) {
                                $err    = $_SESSION['err'];
                                echo '<div class="alert alert-warning alert-message">' . $err . '</div>';
                                unset($_SESSION['err']);
                            }
                            ?>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="login-username" type="text" class="form-control" name="username" placeholder="Username">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="login-password" type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 controls">
                                    <input type="submit" name="login" class="btn btn-success w-100" value="Log In">
                                </div>
                            </div>
                        </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>