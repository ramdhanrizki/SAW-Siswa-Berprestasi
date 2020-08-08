<?php 
    $ajaran = mysqli_fetch_assoc(mysqli_query($db, "select * from tbl_ajaran order by tahun_ajaran desc"));
    $kelas = @$_GET['kelas'];
    $idajaran = @$_GET['ajaran'];
    function transformKehadiran($kehadiran) {
        if($kehadiran<70) {
            return 1;
        }else if($kehadiran>69 && $kehadiran<=79) {
            return 2;
        }else if($kehadiran>79 && $kehadiran<=89) {
            return 3;
        }else if($kehadiran>89 && $kehadiran<=100) {
            return 4;
        }
    }
    if($kelas && $idajaran) {
        $qkelas = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM tbl_kelas where id_kelas='$kelas'"));
        $q = "select *,tbl_siswa.id_siswa as id from tbl_anggota_kelas 
        left join tbl_siswa on tbl_siswa.id_siswa = tbl_anggota_kelas.id_siswa
        left join tbl_kehadiran kehadiran on kehadiran.id_siswa = tbl_siswa.id_siswa and kehadiran.id_ajaran='$idajaran'
        where id_kelas='$_GET[kelas]' and tbl_anggota_kelas.id_ajaran='$idajaran'";
        // echo $q;
        $siswa = mysqli_query($db, $q);

        // Init Data Kehadiran dari table kehadiran
        // $list = mysqli_query($db, "SELECT * FROM tbl_kehadiran WHERE id_ajaran = '$idajaran'");
        // if(mysqli_num_rows($list)>0) {
        //     $del = mysqli_query($db, "DELETE FROM tbl_penilaian_alt WHERE id_ajaran='$idajaran' AND id_kriteria='2'");
        //     while($row = mysqli_fetch_array($list)) {
        //         $nilai = transformKehadiran($row['persentase']);
        //         $gets = mysqli_query($db,"SELECT * FROM tbl_subkriteria WHERE id_kriteria='2' and nilai_subkriteria='$nilai'");
        //         // echo mysqli_error($db);
        //         $get = mysqli_fetch_assoc($gets);
        //         $insert = mysqli_query($db,"INSERT INTO tbl_kepribadian(kehadiran, id_siswa, id_ajaran) VALUES('get[id_subkriteria]','$row[id_siswa]', '$idajaran')");
        //     }
        // }
        // echo $q;
    }
    // echo mysqli_error($db);
?>  
<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">

                <h4 class=""> <span class="btn btn-white-translucent">
                        <i class="mdi mdi-table "></i></span> Input Data Kehadiran
                </h4>
                <p class="opacity-75 ">
                    Halaman ini digunakan untuk meginput data nilai kehadiran
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
                    <div class="row m-b-20">
                        <div class="col-md-4 my-auto">
                            <div class="form-group">
                                <label for="">Tahun Ajaran</label>
                                <select name="tahun_ajaran" class="form-control" id="tahun">
                                <option value="">Pilih Tahun Ajaran</option>
                                    <?=getListAjaran($db, $idajaran)?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 my-auto">
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select name="kelas" class="form-control" id="kelas">
                                <option value="" name="kelas">Pilih Kelas Anda</option>
                                <?php 
                                    $q = mysqli_query($db, "SELECT * FROM tbl_kelas WHERE wali_kelas='$_SESSION[id_pengguna]'");
                                    while($row = mysqli_fetch_array($q)) {
                                        if($kelas==$row['id_kelas']) {
                                            echo "<option value='$row[id_kelas]' selected>$row[nama_kelas]</option>";
                                        }else {
                                            echo "<option value='$row[id_kelas]'>$row[nama_kelas]</option>";
                                        }
                                    }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 my-auto">
                            <div class="form-group mt-4">
                               <button type="button" class="btn btn-primary" onclick="selectKelas()">Pilih Kelas</button>
                            </div>
                        </div>
                    </div>
                    <form method="post" action="">
                    <div class="table-responsive p-t-10">
                        <table class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>Nama Siswa</th>
                                    <th>S</th>
                                    <th>I</th>
                                    <th>A</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1;while($row = @mysqli_fetch_array(@$siswa)) {?>
                                <input type="hidden" name="idsiswa[]" value="<?=$row['id']?>"/>
                                <tr>
                                    <td width="4%"><?=$no++?></td>
                                    <td><?=$row['nisn']?></td>
                                    <td><?=$row['nama_lengkap']?></td>
                                    <td width="10%">
                                        <input type="number" class="form-control" name="sakit[]" required value="<?=$row['jml_sakit']?$row['jml_sakit']:0?>" min="0">
                                    </td>
                                    <td width="10%">
                                        <input type="number" class="form-control" name="izin[]" required value="<?=$row['jml_izin']?$row['jml_izin']:0?>" min="0">
                                    </td>
                                    <td width="10%">
                                        <input type="number" class="form-control" name="alpa[]" required value="<?=$row['jml_alpha']?$row['jml_alpha']:0?>" min="0">
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    if(isset($_POST['simpan'])) {
        @$ss = $_POST['idsiswa'];
        @$kehadiran = $_POST['kehadiran'];
        @$kepribadian = $_POST['kepribadian'];
        @$sakit = $_POST['sakit'];
        @$izin = $_POST['izin'];
        @$alpa = $_POST['alpa'];
        if($ss) {
            echo var_dump($ss);
            for($i=0;$i<count($ss);$i++) {
                $cek = mysqli_query($db, "SELECT * from tbl_kehadiran where id_ajaran='$_GET[ajaran]'
                     and id_siswa='$ss[$i]'");
                $jml = $sakit[$i] + $izin[$i] + $alpa[$i];
                $hadir = 105-$jml;
                $persen = floor($hadir/105 *100);

                if(mysqli_num_rows($cek)>0) {
                    // $query = "UPDATE tbl_kepribadian set kepribadian='$kepribadian[$i]', kehadiran='$kehadiran[$i]'
                    // where id_ajaran='$_GET[ajaran]' and id_siswa='$ss[$i]'";
                    $query = "UPDATE tbl_kehadiran set jml_sakit='$sakit[$i]',
                    jml_izin='$izin[$i]',jml_alpha='$alpa[$i]',
                    jml_hadir='$hadir',
                    jml_pertemuan='105',
                    jml_tidak_hadir='$jml',
                    persentase='$persen'
                    where id_ajaran='$_GET[ajaran]' and id_siswa='$ss[$i]'";
                } else {
                    // $query = "INSERT INTO tbl_kepribadian (id_ajaran,id_siswa,kehadiran,kepribadian) 
                    //             values('$_GET[ajaran]','$ss[$i]','$kehadiran[$i]','$kepribadian[$i]')";
                    $query = "INSERT INTO tbl_kehadiran (jml_sakit, jml_izin,jml_alpha, jml_hadir, jml_pertemuan, jml_tidak_hadir, persentase,id_siswa, id_jaran) 
                                values('$sakit[$i]','$izin[$i]','$alpa[$i]','$hadir','105','$jml','$persen','$ss[$i]','$_GET[ajaran]')";
                }
                
                mysqli_query($db, $query);
            }   
        }
        $url = BASE_URL."/index.php?p=kehadiran&ajaran=$_GET[ajaran]&kelas=$_GET[kelas]";;
        echo "<script>alert('Data Kehadiran berhasil diperbaharui');
            document.location.href='$url';
        </script>";
    }

?>
<script>
    function selectKelas(){
        var tahun = $("#tahun").val();
        var kelas = $("#kelas").val();
        var url = "<?=BASE_URL?>/index.php?p=kehadiran&ajaran="+tahun+'&kelas='+kelas;
        document.location.href=url;
    }
</script>