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
        // if(isset($_POST['tambah'])) {
            $tahun_ajaran = $_POST['tahun_ajaran'];
            $sql = "INSERT INTO tbl_ajaran (tahun_ajaran)VALUES('$tahun_ajaran')";
            if (mysqli_query($db, $sql)) {
                echo "<script>alert('Berhasil Menambahkan data ajaran')</script>";
            } else {
                echo json_encode(
                    array('status'=>400,
                    'message'=>'Gagal menambahkan data ajaran',
                    'result'=>[],
                    'error'=>mysqli_error($db))
                );
            }   
            // header("location:../index.php?p=siswa");
            echo "<script>document.location.href='".BASE_URL."/index.php?p=ajaran'</script>";
        // } 
    }

    function addAnggota($db)
    {
        $query = mysqli_query($db, "INSERT INTO tbl_anggota_kelas (id_kelas, id_siswa, id_ajaran) 
        VALUES('$_POST[id_kelas]','$_POST[id_siswa]','$_POST[id_ajaran]')");
        $url = BASE_URL."/index.php?p=anggota_kelas&id=".$_POST['id_kelas']."&idajaran=".$_POST['id_ajaran'];
        echo "<script>document.location.href='$url'</script>";   
    }

    function removeAnggota($db) {
        $idKelas = $_GET['id_kelas'];
        $idAjaran = $_GET['id_ajaran'];
        $idSiswa = $_GET['id_siswa'];
        $query = mysqli_query($db, "DELETE FROM tbl_anggota_kelas where id_kelas = '$idKelas'
        AND id_ajaran = '$idAjaran'
        AND id_siswa='$idSiswa'");
        $url = BASE_URL."/index.php?p=anggota_kelas&id=".$_GET['id_kelas']."&idajaran=".$_GET['id_ajaran'];
        echo "<script>document.location.href='$url'</script>"; 
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
        case "tambah_anggota":
            addAnggota($db);
        break;
        case "delete_anggota":
            removeAnggota($db);
        break;
    }
?>