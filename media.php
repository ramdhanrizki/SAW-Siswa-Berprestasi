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
            case "kriteria":
                include "pages/v_kriteria.php";
            break;
            case "update_kriteria":
                include "pages/v_update_kriteria.php";
            break;
            case "update_subkriteria":
                include "pages/v_update_sub_kriteria.php";
            break;
            case "nilai":
                include "pages/v_nilai.php";
            break;
            case "isi_nilai":
                include "pages/v_isi_nilai.php";
            break;
            case "kepribadian":
                include "pages/v_kepribadian.php";
            break;
            case "isi_pribadi":
                include "pages/v_isi_pribadi.php";
            break;
            case "ranking":
                include "pages/v_ranking.php";
            break;
            case "guru":
                include "pages/v_guru.php";
            break;
            case "update_guru":
                include "pages/v_update_guru.php";
            break;
            case "rekapsiswa":
                include "pages/v_rekap_siswa.php";
            break;
            default:
                echo "<script>document.location.href='".BASE_URL."/404.php'</script>";
                // header("location:404.php");
                // include "404.php";       
        }
    }
?>