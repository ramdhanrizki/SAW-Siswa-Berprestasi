<?php 
    $kriteria = mysqli_query($db, "select * from tbl_kriteria WHERE id_kriteria = '$_GET[id]'");
?>  
<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">

                <h4 class=""> <span class="btn btn-white-translucent">
                    <i class="mdi mdi-table "></i></span> Update Kriteria
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
                    <?php while($row=mysqli_fetch_array($kriteria)){?>
                        <input type="hidden" name="id_kriteria" value="<?=$row['id_kriteria']?>">
                        <div class="form-group">
                        <label for="nisn">Kriteria</label>
                        <input type="text" autocomplete="off" placeholder="Nama Kriteria" name="kriteria" class="form-control" required value="<?=$row['nama_kriteria']?>">
                    </div>

                    <div class="form-group">
                        <label for="nisn">Atribut</label>
                        <select class="form-control" name="atribut" required>
                            <option disabled selected required>Pilih...</option>
                            <option value="Cost" <?=$row['atribut_kriteria']=='Cost'?'selected':''?>>Cost</option>
                            <option value="Benefit" <?=$row['atribut_kriteria']=='Benefit'?'selected':''?>>Benefit</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nisn">Bobot</label>
                        <input placeholder="0.xx - 1" type="number" autocomplete="off" min="0" max="1" step="any" name="bobot" class="form-control" required value="<?=$row['bobot_kriteria']?>">
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
        $id_kriteria = $_POST['id_kriteria'];
        $kriteria = $_POST['kriteria'];
        $atribut = $_POST['atribut'];
        $bobot = $_POST['bobot'];

        $sql = "UPDATE tbl_kriteria SET
                nama_kriteria = '$kriteria',
                atribut_kriteria = '$atribut',
                bobot_kriteria ='$bobot'
                 WHERE id_kriteria = '$id_kriteria'";
        if (mysqli_query($db, $sql)) {
            echo "<script>swal({
                title : 'Berhasil',
                text : 'Berhasil mengubah data kriteria',
                icon : 'success'
            }).then(function(){
                document.location.href='".BASE_URL."/index.php?p=kriteria';
            });
            </script>";
            
        } else {
            echo json_encode(
                array('status'=>400,
                'message'=>'Gagal menambahkan data kriteria',
                'result'=>[],
                'error'=>mysqli_error($db))
            );
            // $_SESSION['error'] = "Gagal menambahkan data kelas";
        }   
    }
?>