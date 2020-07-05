<?php 
    $ajaran = mysqli_fetch_assoc(mysqli_query($db, "select * from tbl_ajaran order by tahun_ajaran desc"));
    $querySiswa = "SELECT * FROM tbl_siswa left join tbl_anggota_kelas on tbl_anggota_kelas.id_siswa = tbl_siswa.id_siswa
        LEFT JOIN tbl_kelas on tbl_kelas.id_kelas = tbl_anggota_kelas.id_kelas
        AND tbl_anggota_kelas.id_ajaran = '".$ajaran['id_ajaran']."'";
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
                        <i class="mdi mdi-table "></i></span> Input Data Nilai
                </h4>
                <p class="opacity-75 ">
                    Halaman ini digunakan untuk meginput data nilai siswa per pelajaran 
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
                    <div class="table-responsive p-t-10">
                        <table id="example" class="table   " style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelajaran</th>
                                    <th>Kelompok</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1;while($row = @mysqli_fetch_array(@$mapel)) {?>
                                <tr>
                                    <td><?=$no++?></td>
                                    <td><?=$row['nama_pelajaran']?></td>
                                    <td><?=$row['kelompok']?></td>
                                    <td>Belum Lengkap</td>
                                    <td>
                                        <a href="<?=BASE_URL?>/index.php?p=isi_nilai&kelas=<?=$qkelas['id_kelas']?>&ajaran=<?=$idajaran?>&pelajaran=<?=$row['id_matpel']?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Isi Nilai</a>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "modal/modal_tambah_siswa.php";?>
<script>
    function selectKelas(){
        var tahun = $("#tahun").val();
        var kelas = $("#kelas").val();
        var url = "<?=BASE_URL?>/index.php?p=nilai&ajaran="+tahun+'&kelas='+kelas;
        document.location.href=url;
    }
</script>