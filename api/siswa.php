<?php 
    include "../config/koneksi.php";
    include "../config/const.php";
    // include "../config/public_function.php";

    function getAll($db)
    {
        $siswa = mysqli_query($db, "SELECT * from tbl_siswa");
        $rows = mysqli_fetch_all($siswa, MYSQLI_ASSOC);
        echo json_encode($rows);    
    }

    function delete($db)
    {
        $query = "DELETE from tbl_siswa WHERE id_siswa='$_GET[id]'";
        $query2 = "DELETE FROM tbl_anggota_kelas WHERE id_siswa='$_GET[id]'";
        mysqli_query($db, $query);
        mysqli_query($db, $query2);
        echo "<script>alert('Berhasil menghapus data siswa')</script>";
        echo "<script>document.location.href='".BASE_URL."/index.php?p=siswa'</script>";
        // header("location:../index.php?p=siswa");
        // echo "<script>swal({
        //     title : 'Berhasil',
        //     text : 'Berhasil menghapus data siswa',
        //     icon : 'success'
        // }).then(function(){
        //     document.location.href='".BASE_URL."/index.php?p=siswa';
        // });
        // </script>";
        // showSuccess("Berhasil", "Data siswa berhasil dihapus");    
    }

    function saveData($db)
    {
        if(isset($_POST['tambah'])) {
            $nisn = $_POST['nisn'];
            $nama = $_POST['nama_lengkap'];
            $jk = $_POST['jenis_kelamin'];
            $tgl_lahir = $_POST['tanggal_lahir'];
            $tempat_lahir = $_POST['tempat_lahir'];
            $kelas = $_POST['kelas'];
            $ajaran = $_POST['ajaran'];
            $sql = "INSERT INTO tbl_siswa (nisn, nama_lengkap, jenis_kelamin, tempat_lahir, tanggal_lahir)
                    VALUES('$nisn','$nama','$jk','$tempat_lahir','$tgl_lahir')";
            if (mysqli_query($db, $sql)) {
                $id = mysqli_insert_id($db);
                $sql2 = "INSERT INTO tbl_anggota_kelas(id_kelas,id_siswa,id_ajaran) VALUES
                    ('$kelas','$id','$ajaran')";
                mysqli_query($db, $sql2);
                // echo json_encode(
                //     array('status'=>200,
                //     'message'=>'Berhasil Menambahkan Data Siswa',
                //     'result'=>$getAll($db))
                // );
                // $_SESSION['success'] = "Berhasil menambahkan data siswa";
                // echo "<script>swal({
                //     title : 'Berhasil',
                //     text : 'Berhasil menambah data siswa',
                //     icon : 'success'
                // }).then(function(){
                //     document.location.href='".BASE_URL."/index.php?p=siswa';
                // });
                // </script>";
                echo "<script>alert('Berhasil Menambahkan data siswa')</script>";
            } else {
                echo json(
                    array('status'=>400,
                    'message'=>'Gagal menambahkan data siswa',
                    'result'=>[],
                    'error'=>mysqli_error($conn))
                );
                $_SESSION['error'] = "Gagal menambahkan data siswa";
            }   
            // header("location:../index.php?p=siswa");
            echo "<script>document.location.href='".BASE_URL."/index.php?p=siswa'</script>";
        }    
    }

    @$act = $_GET['aksi'];
    if(!$act) {
        getAll($db);
    }
    switch($act) {
        case "get":
            getAll($db);
        break;
        case "tambah":
            saveData($db);
        break;
        case "delete":
            delete($db);
        break;
    }
?>