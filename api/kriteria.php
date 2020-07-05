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
        $query2 = "DELETE FROM tbl_subkriteria WHERE id_kriteria='$_GET[id]'";
        mysqli_query($db, $query);
        mysqli_query($db, $query2);
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

    function deleteSub($db)
    {
        $query = "DELETE from tbl_subkriteria WHERE id_subkriteria='$_GET[id]'";
        mysqli_query($db, $query);
        echo "<script>alert('Berhasil menghapus data sub kriteria')</script>";
        echo "<script>document.location.href='".BASE_URL."/index.php?p=kriteria'</script>";
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

    function addSubKriteria($db)
    {
        if(isset($_POST['simpan'])) {
            $kriteria = $_POST['kriteria'];
            $sub_kriteria = $_POST['sub_kriteria'];
            $nilai = $_POST['nilai'];
            $query = mysqli_query($db,"INSERT INTO tbl_subkriteria(id_kriteria,nama_subkriteria,nilai_subkriteria)
                            VALUES ('$kriteria','$sub_kriteria','$nilai')");
            if($query) {
                echo "<script>alert('Sub Kriteria Berhasil Ditambahkan');
                    document.location.href='".BASE_URL."/index.php?p=kriteria#line-subkriteria';
                </script>";
            }else {
                echo "Terjadi Kesalahan : ".mysqli_error($db);  
            }
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
        case "tambah_sub":
            addSubKriteria($db);
        break;
        case "delete_sub":
            deleteSub($db);
        break;
    }
?>