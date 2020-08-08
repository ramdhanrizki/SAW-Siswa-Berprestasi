<?php 
    include "../config/koneksi.php";
    include "../config/const.php";
    // include "../config/public_function.php";

    function getAll($db)
    {
        $siswa = mysqli_query($db, "SELECT * from tbl_matpel");
        $rows = mysqli_fetch_all($siswa, MYSQLI_ASSOC);
        echo json_encode($rows);    
    }

    function delete($db)
    {
        $query = "DELETE from tbl_matpel WHERE id_matpel='$_GET[id]'";
        mysqli_query($db, $query);
        echo "<script>alert('Berhasil menghapus data pelajaran')</script>";
        echo "<script>document.location.href='".BASE_URL."/index.php?p=pelajaran'</script>";
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
            $pelajaran  = $_POST['pelajaran'];
            $kelompok  = $_POST['kelompok'];
            $guru  = $_POST['guru'];

            $sql = "INSERT INTO tbl_matpel (nama_pelajaran, kelompok, id_guru)
                    VALUES('$pelajaran','$kelompok','$guru')";
            if (mysqli_query($db, $sql)) {
                echo "<script>alert('Berhasil Menambahkan data pelajaran')</script>";
            } else {
                echo json(
                    array('status'=>400,
                    'message'=>'Gagal menambahkan data pelajaran',
                    'result'=>[],
                    'error'=>mysqli_error($conn))
                );
                $_SESSION['error'] = "Gagal menambahkan data pelajaran";
            }   
            // header("location:../index.php?p=siswa");
            echo "<script>document.location.href='".BASE_URL."/index.php?p=pelajaran'</script>";
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