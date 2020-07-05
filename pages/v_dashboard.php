<?php
    $guru = mysqli_query($db, "SELECT COUNT(*) FROM tbl_pengguna");
    $nguru = mysqli_fetch_row($guru)[0];

    $siswa = mysqli_query($db, "SELECT COUNT(*) FROM tbl_siswa");
    $nsiswa = mysqli_fetch_row($siswa)[0];
    
    $kriteria = mysqli_query($db, "SELECT COUNT(*) FROM tbl_kriteria");
    $nkriteria = mysqli_fetch_row($kriteria)[0];
    
    $sub = mysqli_query($db, "SELECT COUNT(*) FROM tbl_subkriteria");
    $nsub = mysqli_fetch_row($sub)[0];
?>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card bg-dark bg-dots m-b-30">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-12 pt-3 text-center">
                            <h1 class="text-white"><span class="js-greeting">Selamat Datang</span> <?=$_SESSION['Nama']?></h1>
                        </div>
                    </div>
                    <div class="row py-3 ">
                        <div class="col-lg-3 text-center">
                            <div class="d-block pb-2">
                                <div class="avatar avatar-lg">
                                    <div class=" avatar-title  rounded-circle"> <i class="fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class=" m-0 text-white"><?=$nguru?></h1>
                            <p class="text-white opacity-75 text-overline">TOTAL GURU</p>
                        </div>
                        <div class="col-lg-3 text-center">
                            <div class="d-block pb-2">
                                <div class="avatar avatar-lg">
                                    <div class=" avatar-title rounded-circle bg-soft-warning"> <i
                                            class="fa fa-user"></i> </div>
                                </div>
                            </div>
                            <h1 class=" m-0 text-white"><?=$nsiswa?></h1>
                            <p class="text-white opacity-75 text-overline">TOTAL SISWA</p>
                        </div>
                        <div class="col-lg-3 text-center">
                            <div class="d-block pb-2">
                                <div class="avatar avatar-lg">
                                    <div class=" avatar-title bg-soft-success rounded-circle"> <i
                                            class="fa fa-tags"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class=" m-0 text-white"><?=$nkriteria?></h1>
                            <p class="text-white opacity-75 text-overline">TOTAL KRITERIA</p>
                        </div>
                        <div class="col-lg-3 text-center">
                            <div class="d-block pb-2">
                                <div class="avatar avatar-lg">
                                    <div class=" avatar-title rounded-circle bg-soft-danger"> <i
                                            class="fa fa-tag"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class=" m-0 text-white"><?=$nsub?></h1>
                            <p class="text-white opacity-75 text-overline">SUB KRITERIA</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>