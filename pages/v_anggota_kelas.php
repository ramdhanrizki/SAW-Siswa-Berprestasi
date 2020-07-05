<?php 
    $idAjaran = @$_GET['idajaran'];
    $ajaran = mysqli_fetch_assoc(mysqli_query($db, "select * from tbl_ajaran order by id_ajaran desc"));
    if($idAjaran) {
        $ajaran = mysqli_fetch_assoc(mysqli_query($db, "select * from tbl_ajaran where id_ajaran='$idAjaran'"));
    }
    $querySiswa = "SELECT * FROM tbl_siswa left join tbl_anggota_kelas on tbl_anggota_kelas.id_siswa = tbl_siswa.id_siswa
        LEFT JOIN tbl_kelas on tbl_kelas.id_kelas = tbl_anggota_kelas.id_kelas
        WHERE tbl_anggota_kelas.id_ajaran = '".$ajaran['id_ajaran']."'
        AND tbl_kelas.id_kelas='$_GET[id]'";
    $siswa = mysqli_query($db, $querySiswa);
    $kelas = mysqli_fetch_assoc(mysqli_query($db, "select * from tbl_kelas left join tbl_pengguna on tbl_pengguna.id_pengguna=tbl_kelas.wali_kelas
                                    WHERE tbl_kelas.id_kelas = '$_GET[id]'"));
    
    // echo var_dump($kk);
?>  
<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">

                <h4 class=""> <span class="btn btn-white-translucent">
                        <i class="mdi mdi-table "></i></span> Anggota Kelas <?=$kelas['nama_kelas']?> Tahun Ajaran <?=$ajaran['tahun_ajaran']?>
                </h4>
                <p class="opacity-75 ">
                    Wali Kelas : <?=$kelas['nama']?>, Terdapat <?=mysqli_num_rows($siswa)?> Siswa pada kelas ini
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
                                    data-target="#modalTambahAnggota"><i class="mdi mdi-plus"></i> Tambah Siswa
                                </button>
                                <button type="button" class="btn btn-white shadow-none">
                                    <i class="mdi mdi-import"></i>Import Excel</button>
                                <button type="button" class="btn btn-white shadow-none">
                                    <i class="mdi mdi-download"></i>Download Excel</button>
                            </div>

                        </div>
                    </div>
                    <div class="table-responsive p-t-10">
                        <table id="example" class="table   " style="width:100%">
                            <thead>
                                <tr>
                                    <th>NISN</th>
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
                                    <td><?=$row['nisn']?></td>
                                    <td><?=$row['nama_lengkap']?></td>
                                    <td><?=$row['jenis_kelamin']?></td>
                                    <td><?=$row['tempat_lahir']?></td>
                                    <td><?=$row['tanggal_lahir']?></td>
                                    <td><?=$row['nama_kelas']?></td>
                                    <td>
                                        <a href="<?=BASE_URL?>/api/siswa.php?aksi=delete_anggota&id_siswa=<?=$row['id_siswa']?>&id_kelas=<?=$kelas['id_kelas']?>&id_ajaran=<?=$row['id_ajaran']?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin akan mengeluarkan data siswa tersebut?');"><i class="fa fa-trash"></i> Keluarkan</a>
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
<?php include "modal/modal_tambah_anggota.php";?>