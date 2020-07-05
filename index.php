<?php 
    include "config/const.php";
    include "config/koneksi.php";
    include "config/public_function.php";
    if(!$_SESSION['Username']) {
        header("location:login.php");
    }
    if (isset($_SESSION['success'])) {
        // echo "Berhasil";
        showSuccess('Berhasil', $_SESSION['success']);
        // unset($_SESSION['success']);
    }

    if (isset($_SESSION['error'])) {
        showError('Terjadi Kesalahan', $_SESSION['error']);
        unset( $_SESSION['error']);
    }
?>
<?php include "template/header.php";?>

<body class="sidebar-pinned">
    
    <?php include "template/sidebar.php";?>
    <main class="admin-main">
    <?php include "template/navbar.php";?>
        <section class="admin-content">
            <?php include "media.php";?>
        </section>
    </main>


    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/select2/js/select2.full.min.js"></script>
    <script src="assets/vendor/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="assets/vendor/listjs/listjs.min.js"></script>
    <script src="assets/vendor/moment/moment.min.js"></script>
    <script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="assets/js/atmos.js"></script>

    <script src="assets/vendor/DataTables/datatables.min.js"></script>

    <script>
        (function ($) {
            'use strict';
            $(document).ready(function () {
                $('#example').DataTable({
                    //DataTable Options
                });
                $('#example-height').DataTable({
                    scrollY:        '50vh',
                    scrollCollapse: true,
                    paging:         false
                });
                $('#example-multi').DataTable({
                    //DataTable Options
                });
                $('#example-multi tbody').on( 'click', 'tr', function () {
                    $(this).toggleClass('bg-gray-400');
                } );
            });

        })(window.jQuery);

    </script>
    <!-- <script src="assets/js/datatable-data.js"></script> -->

</body>

</html>