<?php 
   $kriteria = mysqli_query($db, "SELECT * from tbl_kriteria");
   $sub = mysqli_query($db, "SELECT * FROM tbl_subkriteria left join tbl_kriteria
   on tbl_kriteria.id_kriteria = tbl_subkriteria.id_kriteria");
?>
<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">

                <h4 class=""> <span class="btn btn-white-translucent">
                        <i class="mdi mdi-table "></i></span> Managemen Kriteria dan Sub Kriteria
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
                    <ul class="nav nav-tabs tab-line" id="myTab2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="kriteria-tab2" data-toggle="tab" href="#line-kriteria" role="tab"
                                aria-controls="kriteria" aria-selected="true">Data Kriteria</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="subkriteria-tab2" data-toggle="tab" href="#line-subkriteria" role="tab"
                                aria-controls="subkriteria" aria-selected="false">Data Sub Kriteria</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade active show" id="line-kriteria" role="tabpanel"
                            aria-labelledby="kriteria-tab">

                            <div class="row m-b-20">
                                <div class="col-md-12 text-right my-auto">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <!-- <button type="button" class="btn btn-white shadow-none" data-toggle="modal"
                                            data-target="#modalTambahKriteria"><i class="mdi mdi-plus"></i> Tambah
                                            Kriteria
                                        </button> -->
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive p-t-10">
                                <table id="example" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kriteria</th>
                                            <th>Atribut</th>
                                            <th>Bobot</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; while($row = mysqli_fetch_array($kriteria)) {?>
                                        <tr>
                                            <td width="3%">C<?=$row['id_kriteria']?></td>
                                            <td width="50%"><?=$row['nama_kriteria']?></td>
                                            <td width="15%"><?=$row['atribut_kriteria']?></td>
                                            <td width="15%"><?=$row['bobot_kriteria']?></td>
                                            <td>
                                                <!-- <a href="<?=BASE_URL?>/api/kriteria.php?aksi=delete&id=<?=$row['id_kriteria']?>"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah anda yakin akan menghapus data kriteria tersebut?');"><i
                                                        class="fa fa-trash"></i></a> -->
                                                <a href="<?=BASE_URL?>/index.php?p=update_kriteria&id=<?=$row['id_kriteria']?>"
                                                    class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="line-subkriteria" role="tabpanel" aria-labelledby="subkriteria-tab">
                        <div class="row m-b-20">
                                <div class="col-md-12 text-right my-auto">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <!-- <button type="button" class="btn btn-white shadow-none" data-toggle="modal"
                                            data-target="#modalTambahSubKriteria"><i class="mdi mdi-plus"></i> Tambah Sub Kriteria
                                        </button> -->
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive p-t-10">
                                <table id="example" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kriteria</th>
                                            <th>Sub Kriteria</th>
                                            <th>Nilai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; while($row = mysqli_fetch_array($sub)) {?>
                                        <tr>
                                            <td width="3%"><?=$no++?></td>
                                            <td width="50%"><?=$row['nama_kriteria']?></td>
                                            <td width="15%"><?=$row['nama_subkriteria']?></td>
                                            <td width="15%"><?=$row['nilai_subkriteria']?></td>
                                            <td>
                                                <!-- <a href="<?=BASE_URL?>/api/kriteria.php?aksi=delete_sub&id=<?=$row['id_subkriteria']?>"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah anda yakin akan menghapus data kriteria tersebut?');"><i
                                                        class="fa fa-trash"></i></a> -->
                                                <a href="<?=BASE_URL?>/index.php?p=update_subkriteria&id=<?=$row['id_subkriteria']?>"
                                                    class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
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
    </div>
</div>
<?php include "modal/modal_tambah_kriteria.php";?>
<?php include "modal/modal_tambah_sub_kriteria.php";?>