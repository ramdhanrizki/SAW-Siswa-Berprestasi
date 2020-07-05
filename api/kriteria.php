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
        $query = "DELETE from tbl_kriteria WHERE id_kriteria='$_GET[id]'";
        mysqli_query($db, $query);
        echo "<script>alert('Berhasil menghapus data kriteria')</script>";
        echo "<script>document.location.href='".BASE_URL."/index.php?p=kriteria'</script>";
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
            $kriteria = $_POST['kriteria'];
            $atribut = $_POST['atribut'];
            $bobot = $_POST['bobot'];

            $sql = "INSERT INTO tbl_kriteria (nama_kriteria, atribut_kriteria, bobot_kriteria)
                    VALUES('$kriteria','$atribut','$bobot')";
            if (mysqli_query($db, $sql)) {
                echo "<script>alert('Berhasil Menambahkan data kriteria')</script>";
            } else {
                echo json_encode(
                    array('status'=>400,
                    'message'=>'Gagal menambahkan data kriteria',
                    'result'=>[],
                    'error'=>mysqli_error($conn))
                );
                $_SESSION['error'] = "Gagal menambahkan data kriteria";
            }   
            // header("location:../index.php?p=siswa");
            echo "<script>document.location.href='".BASE_URL."/index.php?p=kriteria'</script>";
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