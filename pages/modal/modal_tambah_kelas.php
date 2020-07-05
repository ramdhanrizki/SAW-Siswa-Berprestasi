<!-- Modal Tambah Siswa -->
<div class="modal fade modal-slide-left" id="modalTambahKelas" tabindex="-1" role="dialog"
    aria-labelledby="slideLeftModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="slideLeftModalLabel">Tambah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=BASE_URL?>/api/kelas.php?aksi=tambah" id="formTambahKelas">
                     <div class="form-group">
                        <label for="nisn">Nama Kelas</label>
                        <input type="text" name="nama_kelas" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nisn">Jenjang</label>
                        <input type="number" name="tingkat" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nisn">Jurusan</label>
                        <input type="text" name="jurusan" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nisn">Wali Kelas</label>
                        <select name="wali_kelas" id="" class="form-control">
                           <?=getListGuru($db)?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Batalkan
                </button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah Siswa</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // $(function(){
    //     $("#formTambahSiswa").submit(function(e){
    //         e.preventDefault();
    //         var data = {
    //             nisn : $('#nisn').val(),
    //             nama_lengkap : $('#nama_lengkap').val(),
    //             jenis_kelamin : $('#jenis_kelamin').val(),
    //             tanggal_lahir : $("#tanggal_lahir").val(),
    //             tempat_lahir  : $("#tempat_lahir").val(),
    //             kelas : $("#kelas").val(),
    //             ajaran : $("#ajaran").val()
    //         }
    //         $.ajax({
    //             url:'<?=BASE_URL?>/api/siswa.php?aksi=tambah',
    //             data: data
    //         },success(function(resp){
    //             if(resp.status==200) {

    //             }else {

    //             }
    //         }),
    //         error(function(err){

    //         }))
    //     })
    // // })
</script>