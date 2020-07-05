<?php 
    $ajaran = mysqli_query($db, "select * from tbl_ajaran where id_ajaran = '$_GET[id]'");

?>  
<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">

                <h4 class=""> <span class="btn btn-white-translucent">
                        <i class="mdi mdi-table "></i></span> Update Ajaran
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
                    <?php while($row=mysqli_fetch_array($ajaran)){?>
                        <input type="hidden" name="id_ajaran" value="<?=$row['id_ajaran']?>">
                        <div class="form-group">
                        <label for="nisn">Tahun Ajaran</label>
                        <input type="text" name="tahun_ajaran" class="form-control" required value="<?=$row['tahun_ajaran']?>">
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
        $id_ajaran = $_POST['id_ajaran'];
        $tahun_ajaran = $_POST['tahun_ajaran'];
        $sql = "UPDATE tbl_ajaran SET
                tahun_ajaran = '$tahun_ajaran'
                WHERE id_ajaran = '$_GET[id]'";
        if (mysqli_query($db, $sql)) {
            echo "<script>swal({
                title : 'Berhasil',
                text : 'Berhasil mengubah data ajaran',
                icon : 'success'
            }).then(function(){
                document.location.href='".BASE_URL."/index.php?p=ajaran';
            });
            </script>";
            
        } else {
            echo json_encode(
                array('status'=>400,
                'message'=>'Gagal menambahkan data ajaran',
                'result'=>[],
                'error'=>mysqli_error($db))
            );
            // $_SESSION['error'] = "Gagal menambahkan data kelas";
        }   
    }
?>