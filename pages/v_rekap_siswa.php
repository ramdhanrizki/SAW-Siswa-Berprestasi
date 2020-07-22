<?php 
    $ajaran = mysqli_fetch_assoc(mysqli_query($db, "select * from tbl_ajaran order by tahun_ajaran desc"));
    $kelas = @$_GET['kelas'];
    $idajaran = @$_GET['ajaran'];
    if($kelas && $idajaran) {
        $qkelas = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM tbl_kelas where id_kelas='$kelas'"));
        $q = "select *,tbl_siswa.id_siswa as alternatif from tbl_anggota_kelas 
        left join tbl_siswa on tbl_siswa.id_siswa = tbl_anggota_kelas.id_siswa
        left join tbl_kepribadian pribadi on pribadi.id_siswa = tbl_siswa.id_siswa and pribadi.id_ajaran='$idajaran'
        left join (select id_siswa,avg(nilai_akhir) as rata from tbl_nilai where tbl_nilai.id_ajaran='$idajaran' group by id_siswa) nilai on nilai.id_siswa = tbl_siswa.id_siswa
        where id_kelas='$_GET[kelas]' and tbl_anggota_kelas.id_ajaran='$idajaran'";
        $siswa = mysqli_query($db, $q);
        // echo $q;
    }
    // echo mysqli_error($db);
?>  
<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">

                <h4 class=""> <span class="btn btn-white-translucent">
                        <i class="mdi mdi-table "></i></span> Rekap Data Siswa
                </h4>
                <p class="opacity-75 ">
                    Halaman Rekap Data Siswa
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
                        <table class="table" style="width:100%" id="example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>Nama Siswa</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nilai Rapor</th>
                                    <th>Kehadiran</th>
                                    <th>Nilai Sikap</th>
                                    <th>Sampel</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1;while($row = @mysqli_fetch_array(@$siswa)) {?>
                                <input type="hidden" name="idsiswa[]" value="<?=$row['alternatif']?>"/>
                                <tr>
                                    <td width="4%"><?=$no++?></td>
                                    <td><?=$row['nisn']?></td>
                                    <td><?=$row['nama_lengkap']?></td>
                                    <td><?=$row['jenis_kelamin']=='L'?'Laki-laki':'Perempuan'?></td>
                                    <td><?=$row['rata']?$row['rata']:'Belum Input'?></td>
                                    <?php 
                                        $kepribadian = mysqli_fetch_assoc(mysqli_query($db,"select * from tbl_subkriteria where id_subkriteria='$row[kepribadian]'"));
                                        $q = "select * from tbl_kehadiran where id_siswa='$row[alternatif]' and id_ajaran='$idajaran'";
                                        $kehadiran = mysqli_fetch_assoc(mysqli_query($db,$q));

                                    ?>
                                    <td><?=$kehadiran['persentase']?$kehadiran['persentase']:'Belum Input'?> %</td>
                                    <td><?=$kepribadian['nama_subkriteria']?$kepribadian['nama_subkriteria']:'Belum Input'?></td>
                                    <td><?=$row['status']==1?'Sampel':'Bukan Sampel'?></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function selectKelas(){
        var tahun = $("#tahun").val();
        var kelas = $("#kelas").val();
        var url = "<?=BASE_URL?>/index.php?p=rekapsiswa&ajaran="+tahun+'&kelas='+kelas;
        document.location.href=url;
    }
</script>