<?php 
    $kelas = mysqli_query($db, "select * from tbl_kelas left join tbl_pengguna on tbl_pengguna.id_pengguna = tbl_kelas.id_kelas
                        WHERE tbl_kelas.id_kelas = '$_GET[id]'");

?>  
<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">

                <h4 class=""> <span class="btn btn-white-translucent">
                        <i class="mdi mdi-table "></i></span> Update Kelas
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
                    <?php while($row=mysqli_fetch_array($kelas)){?>
                        <div class="form-group">
                        <label for="nisn">Nama Kelas</label>
                        <input type="text" name="nama_kelas" class="form-control" required value="<?=$row['nama_kelas']?>">
                    </div>

                    <div class="form-group">
                        <label for="nisn">Jenjang</label>
                        <input type="number" name="tingkat" class="form-control" required value="<?=$row['tingkat']?>">
                    </div>

                    <div class="form-group">
                        <label for="nisn">Jurusan</label>
                        <input type="text" name="jurusan" class="form-control" required value="<?=$row['jurusan']?>">
                    </div>

                    <div class="form-group">
                        <label for="nisn">Wali Kelas</label>
                        <select name="wali_kelas" id="" class="form-control">
                           <?=getListGuru($db, $row['wali_kelas'])?>
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
        $tingkat = $_POST['tingkat'];
        $jurusan = $_POST['jurusan'];
        $nama_kelas = $_POST['nama_kelas'];
        $wali_kelas = $_POST['wali_kelas'];

        $sql = "UPDATE tbl_kelas SET
                tingkat = '$tingkat',
                jurusan = '$jurusan',
                nama_kelas ='$nama_kelas',
                wali_kelas = '$wali_kelas'
                WHERE id_kelas = '$_GET[id]'";
        if (mysqli_query($db, $sql)) {
            echo "<script>swal({
                title : 'Berhasil',
                text : 'Berhasil mengubah data kelas',
                icon : 'success'
            }).then(function(){
                document.location.href='".BASE_URL."/index.php?p=kelas';
            });
            </script>";
            
        } else {
            echo json_encode(
                array('status'=>400,
                'message'=>'Gagal menambahkan data kelas',
                'result'=>[],
                'error'=>mysqli_error($db))
            );
            // $_SESSION['error'] = "Gagal menambahkan data kelas";
        }   
    }
?>