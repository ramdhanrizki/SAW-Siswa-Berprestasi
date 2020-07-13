<?php 
    function transformNilai($nilai) {
        if($nilai<=37) {
            return 1;
        }else if($nilai>37 && $nilai <=61) {
            return 2;
        }else if($nilai>=62 && $nilai<=85) {
            return 3;
        }else if($nilai>=86 && $nilai<=100) {
            return 4;
        }
    }
    $ajaran = mysqli_fetch_assoc(mysqli_query($db, "select * from tbl_ajaran order by tahun_ajaran desc"));
    $idajaran = @$_GET['ajaran'];
    $jurusan = @$_GET['jurusan'];
    if($idajaran && $jurusan) {
        $q = "select * from tbl_anggota_kelas 
        left join tbl_siswa on tbl_siswa.id_siswa = tbl_anggota_kelas.id_siswa
        left join tbl_kepribadian pribadi on pribadi.id_siswa = tbl_siswa.id_siswa and pribadi.id_ajaran='$idajaran'
        left join tbl_kelas on tbl_kelas.id_kelas = tbl_anggota_kelas.id_kelas
        where tbl_anggota_kelas.id_ajaran='$idajaran' and tbl_kelas.jurusan='$jurusan'";

        $siswa = mysqli_query($db, $q);

        $nilai =[];
        while($row = mysqli_fetch_array($siswa)) {
            $res = [];
            // echo var_dump($row);
            $res['id_siswa'] = $row['id_siswa'];
            $res['nisn'] = $row['nisn'];
            $res['nama'] = $row['nama_lengkap'];
            $res['jenis_kelamin'] = $row['jenis_kelamin'];  
            $q2 = "SELECT avg(nilai_akhir) rata from tbl_nilai where id_siswa ='$row[id_siswa]' and id_ajaran='$idajaran'";
            $rata= mysqli_fetch_assoc(mysqli_query($db,$q2));
            $res['mean'] = $rata['rata']; 
            $res['c1'] = transformNilai($res['mean']);
            // Get Nilai Kepribadian dan kehadiran
            $q3 = mysqli_query($db, "SELECT * FROM tbl_kepribadian where id_siswa='$row[id_siswa]' and id_ajaran='$idajaran'");
            if(mysqli_num_rows($q3)>0) {
                $data = mysqli_fetch_assoc($q3);
                $res['pribadi'] = $data['kepribadian'];
                $res['kehadiran'] = $data['kehadiran'];
            } else {
                // Apabila belum input nilai pribadi dan kehadiran set ke paling bawah
                $res['pribadi'] = 9;
                $res['kehadiran'] = 14;
            }
            // Delete old data
            mysqli_query($db, "DELETE FROM tbl_penilaian_alt where id_alternatif='$row[id_siswa]' and id_ajaran='$idajaran'");
            // Save data nilai
            $kriteria = mysqli_fetch_assoc(mysqli_query($db, "select * from tbl_subkriteria where id_kriteria='1' and nilai_subkriteria='$res[c1]'"));
            $saveNilai = mysqli_query($db, "INSERT INTO tbl_penilaian_alt (id_alternatif,id_kriteria,id_subkriteria,nilai_subkriteria,id_ajaran) 
                values('$row[id_siswa]','$kriteria[id_kriteria]', '$kriteria[id_subkriteria]', '$kriteria[nilai_subkriteria]','$idajaran')");
            
            // Save data kehadiran
            $kriteria = mysqli_fetch_assoc(mysqli_query($db, "select * from tbl_subkriteria where id_kriteria='2' and id_subkriteria='$res[kehadiran]'"));
            $res['n_kehadiran'] = $kriteria['nama_subkriteria'];
            $saveNilai = mysqli_query($db, "INSERT INTO tbl_penilaian_alt (id_alternatif,id_kriteria,id_subkriteria,nilai_subkriteria,id_ajaran) 
                values('$row[id_siswa]','$kriteria[id_kriteria]', '$kriteria[id_subkriteria]', '$kriteria[nilai_subkriteria]','$idajaran')");
            $res['c2'] = $kriteria['nilai_subkriteria'];
            // Save data Pribadi
            $kriteria = mysqli_fetch_assoc(mysqli_query($db, "select * from tbl_subkriteria where id_kriteria='3' and id_subkriteria='$res[pribadi]'"));
            $res['n_pribadi'] = $kriteria['nama_subkriteria'];
            $res['c3'] = $kriteria['nilai_subkriteria'];
            $saveNilai = mysqli_query($db, "INSERT INTO tbl_penilaian_alt (id_alternatif,id_kriteria,id_subkriteria,nilai_subkriteria,id_ajaran) 
                values('$row[id_siswa]','$kriteria[id_kriteria]', '$kriteria[id_subkriteria]', '$kriteria[nilai_subkriteria]','$idajaran')");
            $res['r1'] = 0;
            $res['r2'] =0;
            $res['r3'] = 0;
            $res['b1'] = 0;
            $res['b2'] = 0;
            $res['b3'] = 0;
            array_push($nilai, $res);
        }
        // echo var_dump($nilai[0]);
        // Proses Hitung
        foreach($nilai as &$row2) {
            $kriteria = mysqli_query($db, "select * from tbl_kriteria");
            while($row=mysqli_fetch_array($kriteria)) {
                if($row['atribut_kriteria']=='Benefit') {
                    $max = mysqli_fetch_assoc(mysqli_query($db, "select max(nilai_subkriteria) max from tbl_penilaian_alt where id_ajaran='$idajaran'"));
                    $id = 'r'.$row['id_kriteria'];
                    $id2 = 'c'.$row['id_kriteria'];
                    // echo var_dump($row);
                    // echo (float)$row2[$id2] / $max['max'];
                    $row2[$id] = $row2[$id2] / $max['max'];
                }else {
                    $min = mysqli_fetch_assoc(mysqli_query($db, "select min(nilai_subkriteria) min from tbl_penilaian_alt where id_ajaran='$idajaran'"));
                    $row2[$id] = $min['min'] / $row2[$id2];
                }
                // echo $row2[$id2]."<br>";
                $row2['b'.$row['id_kriteria']] = $row2[$id] * $row['bobot_kriteria'];   
            }
            $row2['result'] = $row2['b1'] + $row2['b2'] + $row2['b3'];
            mysqli_query($db, "DELETE FROM tbl_hasil where id_siswa='$row2[id_siswa]' and id_ajaran='$idajaran'");
            mysqli_query($db, "INSERT INTO tbl_hasil(id_siswa, id_ajaran,nilai, rata_rata, kepribadian, kehadiran, jurusan)VALUES('$row2[id_siswa]','$idajaran','$row2[result]','$row2[mean]', '$row2[n_pribadi]', '$row2[n_kehadiran]', '$jurusan')");
        }
        // echo var_dump($nilai[1]);
    }
?>  
<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">
                <h4 class=""> <span class="btn btn-white-translucent">
                        <i class="mdi mdi-table "></i></span> Perankingan Siswa
                </h4>
                <p class="opacity-75 ">
                    Halaman ini digunakan untuk perhitungan ranking dengan metode SAW
                </p>
            </div>
        </div>
    </div>
</div>
<div class="container pull-up">
    <div class="row p-b-15">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row m-b-20">
                        <div class="col-md-4 my-auto">
                            <div class="form-group">
                                <label for="">Tahun Ajaran</label>
                                <select name="tahun_ajaran" class="form-control" id="tahun">
                                <option value="">Pilih Tahun Ajaran</option>
                                    <?=getListAjaran($db, $idajaran)?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 my-auto">
                            <div class="form-group">
                                <label for="">Jurusan</label>
                                <select name="jurusan" class="form-control" id="jurusan">
                                <option value="">Pilih Jurusan</option>
                                    <option value="IPA" <?=$_GET['jurusan']=='IPA'?'selected':''?>>IPA</option>
                                    <option value="IPS" <?=$_GET['jurusan']=='IPS'?'selected':''?>>IPS</option>    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 my-auto">
                            <div class="form-group mt-4">
                               <button type="button" class="btn btn-primary" onclick="selectKelas()">Apply</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-t-10" id="printablearea">
                        <div class="p-t-10" id="detail_perhitungan_saw" style="display:none">
                            <div class="box">
                                <div class="box-header">
                                    Tabel Kriteria (C<sub>i</sub>) Dan Pembobotan Kriteria (W)
                                </div>
                                <div class="box-body">
                                    <div style="overflow-x: auto;margin-right: 5px;">            
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Kriteria</th>
                                                    <th>Atribut</th>
                                                    <th>Bobot</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i=1;
                                                $sql=mysqli_query($db, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
                                                while ($r=mysqli_fetch_array($sql)){
                                                ?>
                                                <tr>
                                                    <td><sub>C<?php echo $i++ ?></sub><?php echo $r['nama_kriteria']; ?></td>
                                                    <td align=center><?php echo $r['atribut_kriteria']; ?></td>
                                                    <td align=center><?php echo $r['bobot_kriteria']; ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="box">
                                <div class="box-header">
                                    Rating Kecocokan Siswa Untuk Setiap Kriteria
                                </div>
                                <div class="box-body">
                                    <div style="overflow-x: auto;margin-right: 5px;">            
                                            <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Siswa</th>
                                                    <?php
                                                    $c=1;
                                                    $sql=mysqli_query($db, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria ASC");
                                                    while ($r=mysqli_fetch_array($sql)){
                                                    echo "
                                                    <th style='text-transform:capitalize'>C".$c++."</th>
                                                    ";
                                                    }
                                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($nilai as $index=>$row) {
                                                echo "<tr>
                                                    <td>A<sub>".($index+1)."</sub> $row[nisn]<br>$row[nama]</td>
                                                    <td>$row[mean]</td>
                                                    <td>$row[n_kehadiran]</td>
                                                    <td>$row[n_pribadi]</td>
                                                </tr>";
                                            }?>
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="box">
                                <div class="box-header">
                                    Matrik Keputusan (X)
                                </div>
                                <div class="box-body">
                                    <div style="overflow-x: auto;margin-right: 5px;">            
                                            <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Siswa</th>
                                                    <?php
                                                    $c=1;
                                                    $sql=mysqli_query($db, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria ASC");
                                                    while ($r=mysqli_fetch_array($sql)){
                                                    echo "
                                                    <th style='text-transform:capitalize'>C".$c++."</th>
                                                    ";
                                                    }
                                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($nilai as $index=>$row) {
                                                echo "<tr>
                                                    <td>A<sub>".($index+1)."</sub> $row[nisn]<br>$row[nama]</td>
                                                    <td>$row[c1]</td>
                                                    <td>$row[c2]</td>
                                                    <td>$row[c3]</td>
                                                </tr>";
                                            }?>
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="box">
                                <div class="box-header">
                                    Matrik Ternormalisasi (R)
                                </div>
                                <div class="box-body">
                                    <div style="overflow-x: auto;margin-right: 5px;">            
                                            <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Siswa</th>
                                                    <?php
                                                    $c=1;
                                                    $sql=mysqli_query($db, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria ASC");
                                                    while ($r=mysqli_fetch_array($sql)){
                                                    echo "
                                                    <th style='text-transform:capitalize'>C".$c++."</th>
                                                    ";
                                                    }
                                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($nilai as $index=>$row) {
                                                echo "<tr>
                                                    <td>A<sub>".($index+1)."</sub> $row[nisn]<br>$row[nama]</td>
                                                    <td>$row[r1]</td>
                                                    <td>$row[r2]</td>
                                                    <td>$row[r3]</td>
                                                </tr>";
                                            }?>
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="box">
                                <div class="box-header">
                                    Nilai Preferensi (P)
                                </div>
                                <div class="box-body">
                                    <div style="overflow-x: auto;margin-right: 5px;">            
                                            <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Siswa</th>
                                                    <th>Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($nilai as $index=>$row) {
                                                echo "<tr>
                                                    <td>A<sub>".($index+1)."</sub> $row[nisn]<br>$row[nama]</td>
                                                    <td>$row[result]</td>
                                                </tr>";
                                            }?>
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <table class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Ranking</th>
                                    <th>NISN</th>
                                    <th>Nama Siswa</th>
                                    <th>Jenis Kelamin</th>
                                    <th>N. Rata-rata</th>
                                    <th>Kehadiran</th>
                                    <th>Kepribadian</th>
                                    <th>Hasil SAW</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                        $res = mysqli_query($db,"select * from tbl_hasil
                                            left join tbl_siswa on tbl_siswa.id_siswa = tbl_hasil.id_siswa where id_ajaran='$idajaran'
                                            and jurusan = '$jurusan'
                                            order by nilai desc");
                                        // echo mysqli_error($db);
                                        $idx=1;
                                        while($row=mysqli_fetch_array($res)){
                                            echo "<tr>
                                                <td>".($idx++)."</td>
                                                <td>$row[nisn]</td>
                                                <td>$row[nama_lengkap]</td>
                                                <td>$row[jenis_kelamin]</td>
                                                <td>$row[rata_rata]</td>
                                                <td>$row[kehadiran]</td>
                                                <td>$row[kepribadian]</td>
                                                <td>$row[nilai]</td>
                                            </tr>";
                                        }
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </form>

                    <?php if(mysqli_num_rows($res)>0) {
                                   echo "<button type='button' class='btn btn-success' onclick='detailPerhitungan()'>Detail Perhitungan</button>&nbsp;";
                                   echo "<button type='button' class='btn btn-primary' onclick='printDiv()'>Cetak</button>";
                               }?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    if(isset($_POST['simpan'])) {
        @$siswa = $_POST['idsiswa'];
        @$kehadiran = $_POST['kehadiran'];
        @$kepribadian = $_POST['kepribadian'];
        if($siswa) {
            for($i=0;$i<count($siswa);$i++) {
                $cek = mysqli_query($db, "SELECT * from tbl_kepribadian where id_ajaran='$_GET[ajaran]'
                     and id_siswa='$siswa[$i]'");
                if(mysqli_num_rows($cek)>0) {
                    $query = "UPDATE tbl_kepribadian set kepribadian='$kepribadian[$i]', kehadiran='$kehadiran[$i]'
                    where id_ajaran='$_GET[ajaran]' and id_siswa='$siswa[$i]'";
                } else {
                    $query = "INSERT INTO tbl_kepribadian (id_ajaran,id_siswa,kehadiran,kepribadian) 
                                values('$_GET[ajaran]','$siswa[$i]','$kehadiran[$i]','$kepribadian[$i]')";
                }
                
                mysqli_query($db, $query);
            }   
        }
        $url = BASE_URL."/index.php?p=kepribadian&ajaran=$_GET[ajaran]&kelas=$_GET[kelas]";;
        echo "<script>alert('Data Kepribadian berhasil Diupdate');
            document.location.href='$url';
        </script>";
    }

?>
<script>
    function detailPerhitungan() {
      $('#detail_perhitungan_saw').toggle();
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
  }
    function selectKelas(){
        var tahun = $("#tahun").val();
        var jurusan = $("#jurusan").val();
        var url = "<?=BASE_URL?>/index.php?p=ranking&ajaran="+tahun+'&jurusan='+jurusan;
        document.location.href=url;
    }

    function printDiv() {
        var printContents = document.getElementById('printablearea').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = "<html><head><title>Sistem Pendukung Keputusan Siswa Berprestasi SMA YADIKA 3</title><style>.box.box-solid.box-primary{border: 0px solid #3c8dbc;}table th, table td {font-size:12px;}</style></head><body>" + printContents + "</b" + "ody>";
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>