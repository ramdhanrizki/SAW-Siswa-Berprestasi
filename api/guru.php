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
        $query = "DELETE from tbl_pengguna WHERE id_pengguna='$_GET[id]'";
        mysqli_query($db, $query);
        echo "<script>alert('Berhasil menghapus data guru')</script>";
        echo "<script>document.location.href='".BASE_URL."/index.php?p=guru'</script>";
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
            $nip = $_POST['nip'];
            $nama = $_POST['nama'];
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $sql = "INSERT INTO tbl_pengguna (nip,nama,username,password,role)
                    VALUES('$nip','$nama','$username','$password','Guru')";
            if (mysqli_query($db, $sql)) {
                echo "<script>alert('Berhasil Menambahkan data guru')</script>";
            } else {
                echo json_encode(
                    array('status'=>400,
                    'message'=>'Gagal menambahkan data guru',
                    'result'=>[],
                    'error'=>mysqli_error($conn))
                );
                $_SESSION['error'] = "Gagal menambahkan data guru";
            }   
            // header("location:../index.php?p=siswa");
            echo "<script>document.location.href='".BASE_URL."/index.php?p=guru '</script>";
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
        break;
    }
?>