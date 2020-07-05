<?php 
    $ajaran = mysqli_query($db, "SELECT * from tbl_ajaran order by tahun_ajaran desc");

?>  
<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">

                <h4 class=""> <span class="btn btn-white-translucent">
                        <i class="mdi mdi-table "></i></span> Managemen Tahun Ajaran
                </h4>
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
                            <h4 class="m-0">Data Ajaran</h4>
                        </div>
                        <div class="col-md-6 text-right my-auto">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-white shadow-none" data-toggle="modal"
                                    data-target="#modalTambahAjaran"><i class="mdi mdi-plus"></i> Tambah Data
                                </button>
                            </div>

                        </div>
                    </div>
                    <div class="table-responsive p-t-10">
                        <table id="example" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; while($row = mysqli_fetch_array($ajaran)) {?>
                                <tr>
                                    <td width="2%"><?=$no++?></td>
                                    <td width="80%"><?=$row['tahun_ajaran']?></td>
                                    <td>
                                        <a href="<?=BASE_URL?>/api/ajaran.php?aksi=delete&id=<?=$row['id_ajaran']?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data kelas tersebut?');"><i class="fa fa-trash"></i></a>
                                        <a href="<?=BASE_URL?>/index.php?p=update_ajaran&id=<?=$row['id_ajaran']?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
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
<?php include "modal/modal_tambah_ajaran.php";?>