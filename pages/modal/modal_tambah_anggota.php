<div class="modal fade" id="modalTambahAnggota" tabindex="-1" role="dialog" aria-labelledby="modalTambahAnggotaLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-align-top-left" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahAnggotaLabel">Tambah Anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Silakan pilih daftar siswa berikut untuk ditambahkan pada kelas</p>
                <form method="post" action="<?=BASE_URL?>/api/siswa.php?aksi=tambah_anggota">
                    <input type="hidden" name="id_kelas" value="<?=$kelas['id_kelas']?>">
                    <input type="hidden" name="id_ajaran" value="<?=$ajaran['id_ajaran']?>">
                    <div class="form-group">
                        <label for="">Nama Siswa</label>
                        <select name="id_siswa" class="form-control" required>
                            <option value="">Pilih Siswa</option>
                            <?php $q = mysqli_query($db, "select * from tbl_siswa 
                                    WHERE id_siswa not in (SELECT id_siswa from tbl_anggota_kelas WHERE id_kelas='$kelas[id_kelas]'
                            AND id_ajaran='$ajaran[id_ajaran]')");
                            while($row=mysqli_fetch_array($q)){
                                echo "<option value='$row[id_siswa]'>$row[nama_lengkap]</option>";
                            }
                            ?>
                            

                        </select>
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