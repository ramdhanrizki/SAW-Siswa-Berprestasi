<?php 
    $ajaran = mysqli_fetch_assoc(mysqli_query($db, "select * from tbl_ajaran order by tahun_ajaran desc"));
    $querySiswa = "SELECT * FROM tbl_pengguna WHERE role='Guru'";
    $siswa = mysqli_query($db, $querySiswa);
?>  
<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">

                <h4 class=""> <span class="btn btn-white-translucent">
                        <i class="mdi mdi-table "></i></span> Managemen Guru
                </h4>
                <p class="opacity-75 ">
                    Halaman ini digunakan untuk menambah, hapus, dan mengupdate data Guru
                </p>
            </div>
        </div>
    </div>
</div>
<div class="container  pull-up">
    <div class="row p-b-15">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row m-b-20">
                        <div class="col-md-6 my-auto">
                            <h4 class="m-0">Data Guru</h4>
                        </div>
                        <div class="col-md-6 text-right my-auto">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-white shadow-none" data-toggle="modal"
                                    data-target="#modalTambahGuru"><i class="mdi mdi-plus"></i> Tambah Guru
                                </button>
                                <!-- <button type="button" class="btn btn-white shadow-none">
                                    <i class="mdi mdi-import"></i>Import Excel</button>
                                <button type="button" class="btn btn-white shadow-none">
                                    <i class="mdi mdi-download"></i>Download Excel</button> -->
                            </div>

                        </div>
                    </div>
                    <div class="table-responsive p-t-10">
                        <table id="example" class="table   " style="width:100%">
                            <thead>
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = mysqli_fetch_array($siswa)) {?>
                                <tr>
                                    <td><?=$row['nip']?></td>
                                    <td><?=$row['nama']?></td>
                                    <td><?=$row['username']?></td>
                                    <td><?=$row['role']?></td>
                                    <td>
                                        <a href="<?=BASE_URL?>/api/guru.php?aksi=delete&id=<?=$row['id_pengguna']?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data guru tersebut?');"><i class="fa fa-trash"></i></a>
                                        <a href="<?=BASE_URL?>/index.php?p=update_guru&id=<?=$row['id_pengguna']?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
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
<?php include "modal/modal_tambah_guru.php";?>