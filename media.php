<?php 
    $page = @$_GET['p'];

    if(!$page) {
        include "pages/v_dashboard.php";
    }else {
        switch($page){
            case "dashboard":
                include "pages/v_dashboard.php";
            break;
            case "siswa":
                include "pages/v_siswa.php";
            break;
            case "update_siswa":
                include "pages/v_update_siswa.php";
            break;
            case "kelas":
                include "pages/v_kelas.php";
            break;
            case "update_kelas":
                include "pages/v_update_kelas.php";
            break;
            case "anggota_kelas":
                include "pages/v_anggota_kelas.php";
            break;
            case "ajaran":
                include "pages/v_ajaran.php";
            break;
            case "update_ajaran":
                include "pages/v_update_ajaran.php";
            break;
            default:
                echo "<script>document.location.href='".BASE_URL."/404.php'</script>";
                // header("location:404.php");
                // include "404.php";       
        }
    }
?>