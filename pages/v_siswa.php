<?php 
    @$kelas = $_GET['kelas'];
    $qkelas = "";
    if($kelas && $kelas!='') {
        $qkelas = " WHERE tbl_anggota_kelas.id_kelas='$kelas' AND tbl_anggota_kelas.id_kelas is not null ";
    }
    $ajaran = mysqli_fetch_assoc(mysqli_query($db, "select * from tbl_ajaran order by tahun_ajaran desc"));
    $querySiswa = "SELECT *,tbl_siswa.id_siswa as id FROM tbl_siswa left join tbl_anggota_kelas on tbl_anggota_kelas.id_siswa = tbl_siswa.id_siswa
        LEFT JOIN tbl_kelas on tbl_kelas.id_kelas = tbl_anggota_kelas.id_kelas
        AND tbl_anggota_kelas.id_ajaran = '".$ajaran['id_ajaran']."' 
        $qkelas
        ORDER BY tbl_siswa.nama_lengkap asc";
    $siswa = mysqli_query($db, $querySiswa);
?>  
<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">

                <h4 class=""> <span class="btn btn-white-translucent">
                        <i class="mdi mdi-table "></i></span> Managemen Siswa
                </h4>
                <p class="opacity-75 ">
                    Halaman ini digunakan untuk menambah, hapus, dan mengupdate data Siswa
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
                        <div class="col-md-6 my-auto">
                            <h4 class="m-0">Data Siswa</h4>
                        </div>
                        <div class="col-md-6 text-right my-auto">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-white shadow-none" data-toggle="modal"
                                    data-target="#modalTambahSiswa"><i class="mdi mdi-plus"></i> Tambah Siswa
                                </button>
                                <!-- <button type="button" class="btn btn-white shadow-none">
                                    <i class="mdi mdi-import"></i>Import Excel</button>
                                <button type="button" class="btn btn-white shadow-none">
                                    <i class="mdi mdi-download"></i>Download Excel</button> -->
                            </div>

                        </div>
                    </div>
                    <div class="row m-b-20">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="kelas">Filter Kelas</label>
                                <select name="kelas" id="kelas" class="form-control">
                                    <option value="">Semua Kelas</option>
                                    <?php
                                        $query = "SELECT * FROM tbl_kelas order by nama_kelas asc";
                                        $kelas = mysqli_query($db, $query);
                                        while($row = mysqli_fetch_array($kelas)) {
                                            echo "<option value='$row[id_kelas]'>$row[nama_kelas]</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 m-t-30">
                            <button class="btn btn-primary" onclick="doFilter()">Filter Data</button>
                        </div>
                    </div>
                    <div class="table-responsive p-t-10">
                        <table id="example" class="table   " style="width:100%">
                            <thead>
                                <tr>
                                    <th>NIS</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = mysqli_fetch_array($siswa)) {?>
                                <tr>
                                    <td><?=$row['nis']?></td>
                                    <td><?=$row['nama_lengkap']?></td>
                                    <td><?=$row['jenis_kelamin']?></td>
                                    <td><?=$row['tempat_lahir']?></td>
                                    <td><?=$row['tanggal_lahir']?></td>
                                    <td><?=$row['nama_kelas']?$row['nama_kelas']:'Belum Terdaftar'?></td>
                                    <td>
                                        <a href="<?=BASE_URL?>/api/siswa.php?aksi=delete&id=<?=$row['id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data siswa tersebut?');"><i class="fa fa-trash"></i></a>
                                        <a href="<?=BASE_URL?>/index.php?p=update_siswa&id=<?=$row['id']?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
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
<script>
    function doFilter(){
        let kelas = document.getElementById('kelas').value
        if(kelas=='' || kelas==null || kelas==undefined) {
            document.location.href="<?=BASE_URL?>/index.php?p=siswa";
        }else {
            document.location.href="<?=BASE_URL?>/index.php?p=siswa&kelas="+kelas;
        }
    }
</script>
<?php include "modal/modal_tambah_siswa.php";?>