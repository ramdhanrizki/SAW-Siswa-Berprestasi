<div class="modal fade" id="modalTambahAjaran" tabindex="-1" role="dialog" aria-labelledby="modalTambahAjaranLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-align-top-left" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahAjaranLabel">Tambah Data Ajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=BASE_URL?>/api/ajaran.php?aksi=tambah">
                <div class="form-group">
                    <label for="">Nama Ajaran</label>
                    <input type="text" name="tahun_ajaran" class="form-control" id="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Batalkan
                </button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
            </div>
        </div>
    </div>
</div>