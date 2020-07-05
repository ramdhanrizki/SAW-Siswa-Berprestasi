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

    function getListKriteria($db, $id=null)
    {
        $kriteria = mysqli_query($db, "SELECT * FROM tbl_kriteria");
        while($row= mysqli_fetch_array($kriteria)){
            if($id==$row['id_kriteria']) {
                echo "<option value='$row[id_kriteria]' selected>$row[nama_kriteria]</option>";
            }else {
                echo "<option value='$row[id_kriteria]'>$row[nama_kriteria]</option>";
            }
        }
    }

    function getListAjaran($db, $id=null) {
        $ajaran = mysqli_query($db, "SELECT * FROM tbl_ajaran order by tahun_ajaran desc");
        while($row= mysqli_fetch_array($ajaran)){
            if($id==$row['id_ajaran']) {
                echo "<option value='$row[id_ajaran]' selected>$row[tahun_ajaran]</option>";
            }else {
                echo "<option value='$row[id_ajaran]'>$row[tahun_ajaran]</option>";
            }
        }
    }

    function getMataPelajaran($db, $id=null)
    {

        $mapel = mysqli_query($db, "SELECT * FROM tbl_matpel order by nama_pelajaran desc");
        while($row= mysqli_fetch_array($mapel)){
            if($id==$row['id_matpel']) {
                echo "<option value='$row[id_matpel]' selected>$row[nama_pelajaran]</option>";
            }else {
                echo "<option value='$row[id_matpel]'>$row[nama_pelajaran]</option>";
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