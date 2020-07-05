<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
    function getListKelas($db, $id=null){
        $kelas = mysqli_query($db, "SELECT * from tbl_kelas");
        while($row = mysqli_fetch_array($kelas)) {
            if($id==$row['id_kelas']) {
                echo "<option value='$row[id_kelas]' selected>$row[nama_kelas]</option>";
            } else {
                echo "<option value='$row[id_kelas]'>$row[nama_kelas]</option>";
            }
        }
    }

    function getListGuru($db, $id=null){
        $kelas = mysqli_query($db, "SELECT * from tbl_pengguna where role='Guru'
            and id_pengguna not in (select wali_kelas from tbl_kelas)");
        while($row = mysqli_fetch_array($kelas)) {
            if($id==$row['id_pengguna']) {
                echo "<option value='$row[id_pengguna]' selected>$row[nama]</option>";
            } else {
                echo "<option value='$row[id_pengguna]'>$row[nama]</option>";
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