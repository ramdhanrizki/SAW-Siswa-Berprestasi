<!-- Modal Tambah Siswa -->
<div class="modal fade modal-slide-left" id="modalTambahGuru" tabindex="-1" role="dialog"
aria-labelledby="slideLeftModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="slideLeftModalLabel">Tambah Guru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" action="<?=BASE_URL?>/api/guru.php?aksi=tambah" id="formTambahGuru">
                    <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" name="nip" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Batalkan
            </button>
            <button type="submit" name="tambah" class="btn btn-primary">Tambah Guru</button>
            </form>
        </div>
    </div>
</div>
</div>
