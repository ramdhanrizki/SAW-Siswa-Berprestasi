<?php 
    $guru = mysqli_query($db, "SELECT * from tbl_pengguna where id_pengguna='$_GET[id]'");

?>  
<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">

                <h4 class=""> <span class="btn btn-white-translucent">
                    <i class="mdi mdi-table "></i></span> Update Guru
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
                <form method="post" action="" id="formUpdateGuru">
                    <?php while($row=mysqli_fetch_array($guru)){?>
                    
                    <div class="form-group">
                        <label for="nama">NIP</label>
                        <input type="text" name="nip" class="form-control" required value="<?=$row['nip']?>">
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required value="<?=$row['nama']?>">
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" required value="<?=$row['username']?>">
                    </div>

                    <div class="form-group">
                        <label for="password">Password *(Kosongkan apabila tidak ingin mengubah)</label>
                        <input type="password" name="password" class="form-control">
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
        $nip = $_POST['nip'];
        $username = $_POST['username'];
        $nama = $_POST['nama'];
        $password = $_POST['password'];
        if(!$password) {
            $sql = "UPDATE tbl_pengguna SET
                nip = '$nip',
                username = '$username',
                nama ='$nama'
                WHERE id_pengguna = '$_GET[id]'";
        }else {
            $password = md5($password);
            $sql = "UPDATE tbl_pengguna SET
                nip = '$nip',
                username = '$username',
                nama ='$nama',
                password = '$password'
                WHERE id_pengguna = '$_GET[id]'";
        }
        if (mysqli_query($db, $sql)) {
            echo "<script>swal({
                title : 'Berhasil',
                text : 'Berhasil mengubah data guru',
                icon : 'success'
            }).then(function(){
                document.location.href='".BASE_URL."/index.php?p=guru';
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