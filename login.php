
<?php 
    include "config/koneksi.php";
    include "config/const.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <title>Login Aplikasi - Sistem Pendukung Keputusan Siswa Berprestasi SMA YADIKA 3</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png" />
    <link rel="icon" href="assets/img/logo.png" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="assets/vendor/pace/pace.css">
    <script src="assets/vendor/pace/pace.min.js"></script>
    <!--vendors-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/jquery-scrollbar/jquery.scrollbar.css">
    <link rel="stylesheet" href="assets/vendor/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/vendor/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="assets/vendor/timepicker/bootstrap-timepicker.min.css">
    <link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="assets/fonts/jost/jost.css">
    <!--Material Icons-->
    <link rel="stylesheet" type="text/css" href="assets/fonts/materialdesignicons/materialdesignicons.min.css">
    <!--Bootstrap + atmos Admin CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/atmos.min.css">
    <!-- Additional library for page -->

</head>

<body class="jumbo-page">

    <main class="admin-main  ">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-lg-4  bg-white">
                    <div class="row align-items-center m-h-100">
                        <div class="mx-auto col-md-8">
                            <div class="p-b-20 text-center">
                                <p>
                                    <img src="assets/img/logo.png" width="80" alt="">

                                </p>
                                <p class="admin-brand-content">
                                    Sistem Pendukung Keputusan Siswa Berprestasi
                                </p>
                            </div>
                            <h3 class="text-center p-b-20 fw-400">SMA YADIKA 3</h3>
                            <form class="needs-validation" action="" method="post">
                                <div class="form-row">
                                    <div class="form-group floating-label col-md-12">
                                        <label>Username</label>
                                        <input type="username" required class="form-control" placeholder="Username"
                                            name="username">
                                    </div>
                                    <div class="form-group floating-label col-md-12">
                                        <label>Password</label>
                                        <input type="password" required class="form-control" placeholder="Password"
                                            name="password">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block btn-lg" name="login">Login</button>

                            </form>
                            <!-- <p class="text-right p-t-10">
                            <a href="#!" class="text-underline">Forgot Password?</a>
                        </p> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 d-none d-md-block bg-cover" style="background-image: url('assets/img/login.svg');">

                </div>
            </div>
        </div>

        <?php 
            if(isset($_POST['login'])){
                $username   = $_POST['username'];
                $password   = md5($_POST['password']);
                $cek_login  = mysqli_query($db, "SELECT * FROM tbl_pengguna WHERE username = '$username' AND password = '$password'");
                if(mysqli_num_rows($cek_login) > 0){
                    $row = mysqli_fetch_array($cek_login);
                    if($row['role'] == "Guru" || $row['role'] == "Admin"){
                        // echo "hello ".$row['role'];
                        $_SESSION['Role'] = $row['role'];
                        $_SESSION['Username'] = $row['username'];
                        $_SESSION['Nama'] = $row['nama'];
                        // header("location:tes.php");
                        echo "<script>document.location.href='".BASE_URL."'</script>";
                    }
                } else{
                    echo "
                        <script>alert('Username/Password Salah!');</script>
                    ";
                }
            }
        ?>
    </main>

    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/vendor/popper/popper.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/select2/js/select2.full.min.js"></script>
    <script src="assets/vendor/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="assets/vendor/listjs/listjs.min.js"></script>
    <script src="assets/vendor/moment/moment.min.js"></script>
    <script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="assets/js/atmos.min.js"></script>
    <!--page specific scripts for demo-->


</body>

</html>