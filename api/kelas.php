<?php 
    include "../config/koneksi.php";
    include "../config/const.php";
    // include "../config/public_function.php";

    function getAll($db)
    {
        $siswa = mysqli_query($db, "SELECT * from tbl_kelas");
        $rows = mysqli_fetch_all($siswa, MYSQLI_ASSOC);
        echo json_encode($rows);    
    }

    function delete($db)
    {
        $query = "DELETE from tbl_kelas WHERE id_kelas='$_GET[id]'";
        $query2 = "DELETE FROM tbl_anggota_kelas WHERE id_kelas='$_GET[id]'";
        mysqli_query($db, $query);
        mysqli_query($db, $query2);
        echo "<script>alert('Berhasil menghapus data kelas')</script>";
        echo "<script>document.location.href='".BASE_URL."/index.php?p=kelas'</script>";
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
            $tingkat = $_POST['tingkat'];
            $jurusan = $_POST['jurusan'];
            $nama_kelas = $_POST['nama_kelas'];
            $wali_kelas = $_POST['wali_kelas'];

            $sql = "INSERT INTO tbl_kelas (tingkat, jurusan, nama_kelas, wali_kelas, status)
                    VALUES('$tingkat','$jurusan','$nama_kelas','$wali_kelas','1')";
            if (mysqli_query($db, $sql)) {
                echo "<script>alert('Berhasil Menambahkan data kelas')</script>";
            } else {
                echo json(
                    array('status'=>400,
                    'message'=>'Gagal menambahkan data kelas',
                    'result'=>[],
                    'error'=>mysqli_error($conn))
                );
                $_SESSION['error'] = "Gagal menambahkan data kelas";
            }   
            // header("location:../index.php?p=siswa");
            echo "<script>document.location.href='".BASE_URL."/index.php?p=kelas'</script>";
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