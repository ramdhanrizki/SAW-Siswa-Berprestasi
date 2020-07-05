<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
    function getListKelas($db, $kelas=null){
        $kelas = mysqli_query($db, "SELECT * from tbl_kelas");
        while($row = mysqli_fetch_array($kelas)) {
            if($kelas==$row['id_kelas']) {
                echo "<option value='$row[id_kelas]' selected>$row[nama_kelas]</option>";
            } else {
                echo "<option value='$row[id_kelas]'>$row[nama_kelas]</option>";
            }
        }
    }

    function showSuccess($title, $message)
    {
        echo "<script>
            swal({
                title: '$title',
                text: '$message',
                icon: 'success',
          });
        </script>";

        // unset($_SESSION['success']);
    }

    function showError($title, $message)
    {
        echo "<script>
            swal({
                title: '$title',
                text: '$message',
                icon: 'error',
          });
        </script>";
        // unset($_SESSION['error']);
    }
?>