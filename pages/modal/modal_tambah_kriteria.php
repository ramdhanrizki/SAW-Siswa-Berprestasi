<!-- Modal Tambah Siswa -->
<div class="modal fade modal-slide-left" id="modalTambahKriteria" tabindex="-1" role="dialog"
    aria-labelledby="slideLeftModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="slideLeftModalLabel">Tambah Kriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=BASE_URL?>/api/kriteria.php?aksi=tambah" id="formTambahKelas">
                     <div class="form-group">
                        <label for="nisn">Kriteria</label>
                        <input type="text" autocomplete="off" placeholder="Nama Kriteria" name="kriteria" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nisn">Atribut</label>
                        <select class="form-control" name="atribut" required>
                            <option disabled selected required>Pilih...</option>
                            <option value="Cost">Cost</option>
                            <option value="Benefit">Benefit</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nisn">Bobot</label>
                        <input placeholder="0.xx - 1" type="number" autocomplete="off" min="0" max="1" step="any" name="bobot" class="form-control" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Batalkan
                </button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
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