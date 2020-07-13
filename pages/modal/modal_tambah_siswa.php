<!-- Modal Tambah Siswa -->
<div class="modal fade modal-slide-left" id="modalTambahSiswa" tabindex="-1" role="dialog"
aria-labelledby="slideLeftModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="slideLeftModalLabel">Tambah Siswa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" action="<?=BASE_URL?>/api/siswa.php?aksi=tambah" id="formTambahSiswa">
                <input type="hidden" name="ajaran" value="<?=$ajaran['id_ajaran']?>">
                    <div class="form-group">
                    <label for="nisn">NISN</label>
                    <input type="text" name="nisn" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="nisn">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="nisn">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nisn">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="nisn">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="kelas">Kelas (Thn Ajaran : <?=$ajaran['tahun_ajaran']?>)</label>
                    <select name="kelas" id="" class="form-control" required>
                        <?=getListKelas($db)?>
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