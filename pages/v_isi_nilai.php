<?php 
    $ajaran = mysqli_fetch_assoc(mysqli_query($db, "select * from tbl_ajaran order by tahun_ajaran desc"));
    $querySiswa = "SELECT * FROM tbl_siswa left join tbl_anggota_kelas on tbl_anggota_kelas.id_siswa = tbl_siswa.id_siswa
        LEFT JOIN tbl_kelas on tbl_kelas.id_kelas = tbl_anggota_kelas.id_kelas
        AND tbl_anggota_kelas.id_ajaran = '".$ajaran['id_ajaran']."'";
    $pelajaran  = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM tbl_matpel where id_matpel='$_GET[pelajaran]'"));
    $siswa = mysqli_query($db, $querySiswa);
    $kelas = @$_GET['kelas'];
    $idajaran = @$_GET['ajaran'];
    if($kelas && $ajaran) {
        $qkelas = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM tbl_kelas where id_kelas='$kelas'"));
        $mapel = mysqli_query($db, "SELECT * FROM tbl_matpel WHERE kelompok='wajib' or kelompok='$qkelas[jurusan]'");
    }
    echo mysqli_error($db);
?>  
<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">

                <h4 class=""> <span class="btn btn-white-translucent">
                        <i class="mdi mdi-table "></i></span> Input Nilai Mata Pelajaran <?=$pelajaran['nama_pelajaran']?>
                </h4>
                <p class="opacity-75 ">
                   Silakan isi form berikut untuk mengisi nilai pelajaran kelas <?=$qkelas['nama_kelas']?>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="container  pull-up">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <form method="post" action="">
                    <div class="table-responsive p-t-10">
                        <table id="example" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>Nama Siswa</th>
                                    <th>N. Harian 1</th>
                                    <th>N. Harian 2</th>
                                    <th>N. Harian 3</th>
                                    <th>N. UTS</th>
                                    <th>N. UAS</th>
                                </tr>
                            </thead>
                            <tbody>
                            <form method="post" action="">
                                <?php 
                                    $q = mysqli_query($db, "SELECT * FROM tbl_siswa siswa
                                    LEFT JOIN tbl_anggota_kelas anggota on anggota.id_siswa = siswa.id_siswa AND id_ajaran='$idajaran'
                                    WHERE anggota.id_kelas='$kelas'");
                                    $no=1;
                                    while($row=mysqli_fetch_array($q)) {
                                        echo "<tr>
                                            <td>$no</td>
                                            <td>
                                                <input type='hidden' name='siswa[]' value='$row[id_siswa]'>
                                                $row[nisn]
                                            </td>
                                            <td>$row[nama_lengkap]</td>";
                                        $nilai = mysqli_fetch_assoc(mysqli_query($db, "SELECT * from tbl_nilai
                                            WHERE id_ajaran='$idajaran'
                                            AND id_siswa='$row[id_siswa]'"));
                                            echo "<td><input type='number' min=0 max=100 value='$nilai[n_harian1]' name='n_harian1[]' class='form-control' required></td>";
                                            echo "<td><input type='number' min=0 max=100 value='$nilai[n_harian2]' name='n_harian2[]' class='form-control' required></td>";
                                            echo "<td><input type='number' min=0 max=100 value='$nilai[n_harian3]' name='n_harian3[]' class='form-control' required></td>";
                                            echo "<td><input type='number' min=0 max=100 value='$nilai[uts]' name='n_uts[]' class='form-control' required></td>";
                                            echo "<td><input type='number' min=0 max=100 value='$nilai[uas]' name='n_uas[]' class='form-control' required></td>";
                                            
                                        echo "</tr>";
                                        $no++;
                                    }
                                    ?>

                            </tbody>
                        </table>
                        <hr>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    if(isset($_POST['simpan'])) {
        $siswa = $_POST['siswa'];
        $harian1 = $_POST['n_harian1'];
        $harian2 = $_POST['n_harian2'];
        $harian3 = $_POST['n_harian3'];
        $uts = $_POST['n_uts'];
        $uas = $_POST['n_uas'];
        for($i=0;$i<count($siswa);$i++) {
            $akhir = ($harian1[$i] + $harian2[$i] + $harian3[$i] + $uts[$i] + $uas[$i]) / 5;
            $query = "INSERT INTO tbl_nilai (id_ajaran,id_matpel,id_siswa,n_harian1,n_harian2,n_harian3,uts,uas,nilai_akhir)
                values('$_GET[ajaran]','$_GET[pelajaran]','$siswa[$i]','$harian1[$i]','$harian2[$i]','$harian3[$i]',
                '$uts[$i]','$uas[$i]',$akhir)";
            mysqli_query($db, $query);
        }
        $url = BASE_URL."/index.php?p=nilai&ajaran=$_GET[ajaran]&kelas=$_GET[kelas]";;
        echo "<script>alert('Data Nilai Berhasil Diupdate');
            document.location.href='$url';
        </script>";

        // echo var_dump($_POST['siswa']); 
    }
?>
<script>
    function selectKelas(){
        var tahun = $("#tahun").val();
        var kelas = $("#kelas").val();
        var url = "<?=BASE_URL?>/index.php?p=nilai&ajaran="+tahun+'&kelas='+kelas;
        document.location.href=url;
    }
</script>