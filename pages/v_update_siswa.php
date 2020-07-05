<?php 
    $ajaran = mysqli_fetch_assoc(mysqli_query($db, "select * from tbl_ajaran order by tahun_ajaran desc"));
    $querySiswa = "SELECT * FROM tbl_siswa left join tbl_anggota_kelas on tbl_anggota_kelas.id_siswa = tbl_siswa.id_siswa
        LEFT JOIN tbl_kelas on tbl_kelas.id_kelas = tbl_anggota_kelas.id_kelas
        WHERE tbl_anggota_kelas.id_ajaran = '".$ajaran['id_ajaran']."'
        AND tbl_siswa.id_siswa = '$_GET[id]'";
    $siswa = mysqli_query($db, $querySiswa);
?>  
<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">

                <h4 class=""> <span class="btn btn-white-translucent">
                        <i class="mdi mdi-table "></i></span> Update Siswa
                </h4>
            </div>
        </div>
    </div>
</div>
<div class="container  pull-up">
    <div class="row">
        <div class="col-6">
            <div class="card mb-3">
                <div class="card-body">
                <form method="post" action="" id="formUpdateSiswa">
                    <input type="hidden" name="ajaran" value="<?=$ajaran['id_ajaran']?>">
                    <?php while($row=mysqli_fetch_array($siswa)){?>
                     <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="text" name="nisn" class="form-control" value="<?=$row['nisn']?>">
                    </div>

                    <div class="form-group">
                        <label for="nisn">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" value="<?=$row['nama_lengkap']?>">
                    </div>

                    <div class="form-group">
                        <label for="nisn">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="L" <?=$row['jenis_kelamin']=='L'?'selected':''?>>Laki-laki</option>
                            <option value="P" <?=$row['jenis_kelamin']=='P'?'selected':''?>>Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nisn">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="<?=$row['tanggal_lahir']?>">
                    </div>

                    <div class="form-group">
                        <label for="nisn">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="<?=$row['tempat_lahir']?>">
                    </div>

                    <div class="form-group">
                        <label for="kelas">Kelas (Thn Ajaran : <?=$ajaran['tahun_ajaran']?>)</label>
                        <select name="kelas" id="" class="form-control">
                           <?=getListKelas($db,$row['kelas'])?>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                    </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    if(isset($_POST['update'])) {
        $nisn = $_POST['nisn'];
            $nama = $_POST['nama_lengkap'];
            $jk = $_POST['jenis_kelamin'];
            $tgl_lahir = $_POST['tanggal_lahir'];
            $tempat_lahir = $_POST['tempat_lahir'];
            $kelas = $_POST['kelas'];
            $ajaran = $_POST['ajaran'];
            $sql = "UPDATE tbl_siswa SET
                    nisn = '$nisn',
                    nama_lengkap = '$nama',
                    jenis_kelamin ='$jk',
                    tempat_lahir = '$tempat_lahir',
                    tanggal_lahir = '$tgl_lahir'
                    WHERE id_siswa = '$_GET[id]'";
            if (mysqli_query($db, $sql)) {

                $sql2 = "UPDATE tbl_anggota_kelas set id_kelas = '$kelas',
                id_siswa='$_GET[id]'
                id_ajaran='$ajaran'
                WHERE id_siswa='$_GET[id]'
                AND id_ajaran='$ajaran'";
                mysqli_query($db, $sql2);
                echo "<script>swal({
                    title : 'Berhasil',
                    text : 'Berhasil mengubah data siswa',
                    icon : 'success'
                }).then(function(){
                    document.location.href='".BASE_URL."/index.php?p=siswa';
                });
                </script>";
                $_SESSION['success'] = "Berhasil menambahkan data siswa";
                
            } else {
                echo json(
                    array('status'=>400,
                    'message'=>'Gagal menambahkan data siswa',
                    'result'=>[],
                    'error'=>mysqli_error($conn))
                );
                $_SESSION['error'] = "Gagal menambahkan data siswa";
            }   
    }
?>