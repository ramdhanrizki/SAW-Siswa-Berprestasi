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
        left join tbl_kepribadian pribadi on pribadi.id_siswa = tbl_siswa.id_siswa and pribadi.id_ajaran='$idajaran'
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
                        <i class="mdi mdi-table "></i></span> Input Data Kepribadian
                </h4>
                <p class="opacity-75 ">
                    Halaman ini digunakan untuk meginput data nilai kepribadian
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
                                    <!-- <th>Kehadiran</th> -->
                                    <th>Nilai Sikap</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1;while($row = @mysqli_fetch_array(@$siswa)) {?>
                                <input type="hidden" name="idsiswa[]" value="<?=$row['id']?>"/>
                                <tr>
                                    <td width="4%"><?=$no++?></td>
                                    <td><?=$row['nisn']?></td>
                                    <td><?=$row['nama_lengkap']?></td>
                                    <!-- <td width="15%">
                                        <select  name="kehadiran[]" class="form-control" required>
                                        <option value="">Pilih Persentase</option>
                                        <?php $q = mysqli_query($db, "select id_subkriteria,nama_subkriteria, nilai_subkriteria from tbl_subkriteria where id_kriteria='2'");
                                            while($item = @mysqli_fetch_array(@$q)) {
                                                if($item['id_subkriteria']==$row['kehadiran']) {
                                                    echo "<option value='$item[id_subkriteria]' selected>$item[nama_subkriteria]</option>";
                                                }else {
                                                    echo "<option value='$item[id_subkriteria]'>$item[nama_subkriteria]</option>";
                                                }
                                            }
                                        ?>
                                        </select>
                                    </td> -->
                                    <td width="20%">
                                        <select  name="kepribadian[]" class="form-control" required>
                                        <option value="">Pilih Nilai </option>
                                        <?php $q = mysqli_query($db, "select id_subkriteria,nama_subkriteria, nilai_subkriteria from tbl_subkriteria where id_kriteria='3'");
                                            while($item = @mysqli_fetch_array(@$q)) {
                                                if($item['id_subkriteria']==$row['kepribadian']) {
                                                    echo "<option value='$item[id_subkriteria]' selected>$item[nama_subkriteria]</option>";
                                                } else {
                                                    echo "<option value='$item[id_subkriteria]'>$item[nama_subkriteria]</option>";
                                                }
                                            }
                                        ?>
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
        if($ss) {
            echo var_dump($ss);
            for($i=0;$i<count($ss);$i++) {
                $cek = mysqli_query($db, "SELECT * from tbl_kepribadian where id_ajaran='$_GET[ajaran]'
                     and id_siswa='$ss[$i]'");
                if(mysqli_num_rows($cek)>0) {
                    // $query = "UPDATE tbl_kepribadian set kepribadian='$kepribadian[$i]', kehadiran='$kehadiran[$i]'
                    // where id_ajaran='$_GET[ajaran]' and id_siswa='$ss[$i]'";
                    $query = "UPDATE tbl_kepribadian set kepribadian='$kepribadian[$i]'
                    where id_ajaran='$_GET[ajaran]' and id_siswa='$ss[$i]'";
                } else {
                    // $query = "INSERT INTO tbl_kepribadian (id_ajaran,id_siswa,kehadiran,kepribadian) 
                    //             values('$_GET[ajaran]','$ss[$i]','$kehadiran[$i]','$kepribadian[$i]')";
                    $query = "INSERT INTO tbl_kepribadian (id_ajaran,id_siswa,kepribadian) 
                                values('$_GET[ajaran]','$ss[$i]','$kepribadian[$i]')";
                }
                
                mysqli_query($db, $query);
            }   
        }
        $url = BASE_URL."/index.php?p=kepribadian&ajaran=$_GET[ajaran]&kelas=$_GET[kelas]";;
        echo "<script>alert('Data Kepribadian berhasil Diupdate');
            document.location.href='$url';
        </script>";
    }

?>
<script>
    function selectKelas(){
        var tahun = $("#tahun").val();
        var kelas = $("#kelas").val();
        var url = "<?=BASE_URL?>/index.php?p=kepribadian&ajaran="+tahun+'&kelas='+kelas;
        document.location.href=url;
    }
</script>