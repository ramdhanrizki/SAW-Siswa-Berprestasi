<?php 
    $ajaran = mysqli_fetch_assoc(mysqli_query($db, "select * from tbl_ajaran order by id_ajaran desc"));
    $kelas = mysqli_query($db, "SELECT * from tbl_kelas left join tbl_pengguna on tbl_pengguna.id_pengguna=tbl_kelas.wali_kelas")
    // echo var_dump($kk);
?>  
<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">

                <h4 class=""> <span class="btn btn-white-translucent">
                        <i class="mdi mdi-table "></i></span> Managemen Kelas
                </h4>
                <p class="opacity-75 ">
                    Halaman ini digunakan untuk menambah, hapus, dan mengupdate data Kelas
                </p>
            </div>
        </div>
    </div>
</div>
<div class="container  pull-up">
    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row m-b-20">
                        <div class="col-md-6 my-auto">
                            <h4 class="m-0">Data Kelas</h4>
                        </div>
                        <div class="col-md-6 text-right my-auto">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-white shadow-none" data-toggle="modal"
                                    data-target="#modalTambahKelas"><i class="mdi mdi-plus"></i> Tambah kelas
                                </button>
                                <!-- <button type="button" class="btn btn-white shadow-none">
                                    <i class="mdi mdi-import"></i>Import Excel</button>
                                <button type="button" class="btn btn-white shadow-none">
                                    <i class="mdi mdi-download"></i>Download Excel</button> -->
                            </div>

                        </div>
                    </div>
                    <div class="table-responsive p-t-10">
                        <table id="example" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Jenjang</th>
                                    <th>Wali Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; while($row = mysqli_fetch_array($kelas)) {?>
                                <tr>
                                    <td><?=$no++?></td>
                                    <td><?=$row['nama_kelas']?></td>
                                    <td><?=$row['jurusan']?></td>
                                    <td><?=$row['tingkat']?></td>
                                    <td><?=$row['nama']?$row['nama']:'Wali Kelas Belum di set'?></td>
                                    <td>
                                        <a href="<?=BASE_URL?>/api/kelas.php?aksi=delete&id=<?=$row['id_kelas']?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data kelas tersebut?');"><i class="fa fa-trash"></i></a>
                                        <a href="<?=BASE_URL?>/index.php?p=update_kelas&id=<?=$row['id_kelas']?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                                        <a href="<?=BASE_URL?>/index.php?p=anggota_kelas&id=<?=$row['id_kelas']?>" class="btn btn-sm btn-success" title="Klik untuk menambahkan anggota kelas"><i class="fa fa-user"></i></a>
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
<?php include "modal/modal_tambah_kelas.php";?>