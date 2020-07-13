<?php
    $guru = mysqli_query($db, "SELECT COUNT(*) FROM tbl_pengguna");
    $nguru = mysqli_fetch_row($guru)[0];

    $siswa = mysqli_query($db, "SELECT COUNT(*) FROM tbl_siswa");
    $nsiswa = mysqli_fetch_row($siswa)[0];
    
    $kriteria = mysqli_query($db, "SELECT COUNT(*) FROM tbl_kriteria");
    $nkriteria = mysqli_fetch_row($kriteria)[0];
    
    $sub = mysqli_query($db, "SELECT COUNT(*) FROM tbl_subkriteria");
    $nsub = mysqli_fetch_row($sub)[0];

    $user = mysqli_query($db, "SELECT * FROM tbl_pengguna WHERE username = '$_SESSION[Username]'");
    $nuser = mysqli_fetch_assoc($user);
?>
<?php if ($_SESSION['Role']=='Guru'){?>
<div class="bg-dark m-b-30">
    <div class="container">
        <div class="row p-b-60 p-t-60">

            <div class="col-md-6 text-white p-b-30">
                <div class="media">
                    <div class="avatar avatar-lg mr-3">
                        <span class="avatar-title rounded-circle bg-white-translucent m-r-3"> <i class="fa fa-user"></i> </span>
                    </div>
                    <div class="media-body">
                        <h1><?=$nuser['username']?></h1>
                        <div class="opacity-75">NIP : <?=$nuser['nip']?></div>
                        <p class="opacity-75">
                            Nama : <?=$nuser['nama']?>
                        </p>

                    </div>
                </div>

            </div>
            <div class="col-md-6 text-md-right text-white">
                <div>
                    <div class="text-overline opacity-75 m-b-10">Navigation</div>
                    <a href="index.php?p=rekapsiswa" class="badge-soft-danger badge">Rekap Siswa</a>
                    <a href="index.php?p=ranking" class="badge-soft-info badge">Ranking</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pull-up">
    <div class="row">
        <div class="col-lg-3 col-md-6 m-b-30">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="text-center p-t-20">
                        <div class="avatar-lg avatar">
                            <div class="avatar-title rounded-circle badge-soft-success"><i
                                    class="fa fa-user"></i></div>

                        </div>
                        <div class="text-center">
                            <h1 class="fw-600 p-t-20"><?=$nguru?></h1>
                            <p class="text-muted fw-600">TOTAL GURU</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 m-b-30">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="text-center p-t-20">
                        <div class="avatar-lg avatar">
                            <div class="avatar-title rounded-circle badge-soft-danger"><i
                                    class="fa fa-user"></i></div>

                        </div>
                        <div class="text-center">
                            <h1 class="fw-600 p-t-20"><?=$nsiswa?></h1>
                            <p class="text-muted fw-600">TOTAL SISWA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 m-b-30">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="text-center p-t-20">
                        <div class="avatar-lg avatar">
                            <div class="avatar-title rounded-circle badge-soft-info"><i
                                    class="fa fa-tags"></i></div>

                        </div>
                        <div class="text-center">
                            <h1 class="fw-600 p-t-20"><?=$nkriteria?></h1>
                            <p class="text-muted fw-600">TOTAL KRITERIA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 m-b-30">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="text-center p-t-20">
                        <div class="avatar-lg avatar">
                            <div class="avatar-title rounded-circle badge-soft-dark"><i
                                    class="fa fa-tag"></i></div>

                        </div>
                        <div class="text-center">
                            <h1 class="fw-600 p-t-20"><?=$nsub?></h1>
                            <p class="text-muted fw-600">SUB KRITERIA</p>
                
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</div>

<?php } else {?>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card bg-dark bg-dots m-b-30">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-12 pt-3 text-center">
                            <h1 class="text-white"><span class="js-greeting">Selamat Datang</span>
                                <?=$_SESSION['Nama']?></h1>
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
                                    <div class=" avatar-title rounded-circle bg-soft-danger"> <i class="fa fa-tag"></i>
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
<?php }?>