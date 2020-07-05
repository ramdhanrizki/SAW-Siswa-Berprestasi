<?php 
    $kriteria = mysqli_query($db, "select * from tbl_subkriteria WHERE id_subkriteria = '$_GET[id]'");
?>  
<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">

                <h4 class=""> <span class="btn btn-white-translucent">
                    <i class="mdi mdi-table "></i></span> Update Sub Kriteria
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
                        <input type="hidden" name="id_subkriteria" value="<?=$row['id_subkriteria']?>">
                        <div class="form-group">
                        <label for="kriteria">Kriteria</label>
                        <select name="kriteria" class="form-control" required>
                            <?=getListKriteria($db, $row['id_kriteria'])?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sub_kriteria">Sub Kriterai</label>
                        <input type="text" name="sub_kriteria" placeholder="Sub Kriteria" class="form-control" required value="<?=$row['nama_subkriteria']?>">
                    </div>

                    <div class="form-group">
                        <label for="nilai">Bobot</label>
                        <input placeholder="1-5" type="number" autocomplete="off" min="1" max="5" step="any" name="nilai" class="form-control" required value="<?=$row['nilai_subkriteria']?>">
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
        $sub_kriteria = $_POST['sub_kriteria'];
        $kriteria = $_POST['kriteria'];
        $nilai = $_POST['nilai'];
        $id_subkriteria = $_POST['id_subkriteria'];

        $sql = "UPDATE tbl_subkriteria SET
                id_kriteria = '$kriteria',
                nama_subkriteria = '$sub_kriteria',
                nilai_subkriteria ='$nilai'
                 WHERE id_subkriteria = '$id_subkriteria'";
        if (mysqli_query($db, $sql)) {
            echo "<script>
            alert('Berhasil mengubah data sub kriteria');
            document.location.href='".BASE_URL."/index.php?p=kriteria';
            </script>";
            
        } else {
            // echo "error";
            echo json_encode(
                array('status'=>400,
                'message'=>'Gagal mengubah data sub kriteria',
                'result'=>[],
                'error'=>mysqli_error($db))
            );
            // $_SESSION['error'] = "Gagal menambahkan data kelas";
        }   
    }
?>