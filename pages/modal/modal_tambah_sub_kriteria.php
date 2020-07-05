<!-- Modal Tambah Siswa -->
<div class="modal fade modal-slide-left" id="modalTambahSubKriteria" tabindex="-1" role="dialog"
    aria-labelledby="slideLeftModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="slideLeftModalLabel">Tambah Sub Kriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=BASE_URL?>/api/kriteria.php?aksi=tambah_sub" id="formTambahKriteria">
                     <div class="form-group">
                        <label for="kriteria">Kriteria</label>
                        <select name="kriteria" class="form-control" required>
                            <option value="">Pilih Kriteria</option>
                            <?=getListKriteria($db)?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nisn">Sub Kriteria</label>
                        <input type="text" name="sub_kriteria" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="nisn">Nilai</label>
                        <input placeholder="1-5" type="number" autocomplete="off" min="1" max="5" step="any" name="nilai" class="form-control" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Batalkan
                </button>
                <button type="submit" name="simpan" class="btn btn-primary">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
