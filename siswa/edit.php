<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header row">
                <div class="card-title h3 col-8">Edit Siswa</div>
                <div class="col-4">
                    <a href="?m=siswa&s=view" class="btn btn-lg btn-primary float-end">Kembali</a>
                </div>
            </div>
            <?php
            include_once('config.php');
            $id  = $_GET['id'];
            $sql = "SELECT * FROM siswa WHERE id='$id'";
            $result = mysqli_query($con, $sql);
            $r = mysqli_fetch_assoc($result);
            ?>

            <div class="card-body">
                <form action="?m=siswa&s=update" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="text" name="nis" value="<?= $r['nis']; ?>" class="form-control" placeholder="Nomor Induk Siswa" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="nama" value="<?= $r['nama']; ?>" class="form-control" placeholder="Nama siswa" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="">Jenis Kelamin: &nbsp;</label>
                        <input type="radio" name="jk" value="L" <?= $r['jk'] ==  'L' ? 'checked' : ''; ?>> Laki-Laki &nbsp;
                        <input type="radio" name="jk" value="P" <?= $r['jk'] == 'P' ? 'checked' : ''; ?>>Perempuan &nbsp;
                    </div>
                    <div class="mb-3">
                        <input type="text" name="tempat_lahir" value="<?= $r['tempat_lahir']; ?>" class="form-control" placeholder="Tempat Lahir (Isi dengan Nama Kabupaten/Kota tempat dilahirkan)" required>
                    </div>
                    <div class="mb-3">
                        <input type="date" name="tanggal_lahir" value="<?= $r['tanggal_lahir']; ?>" class="form-control" placeholder="Tanggal Lahir" required>
                    </div>
                    <div class="mb-3">
                        <select name="kelas_id" class="form-control" required>
                            <option value="">Pilih Kelas</option>
                            <?php
                            $sql_kelas = "SELECT * FROM kelas";
                            $result_kelas = mysqli_query($con, $sql_kelas);
                            while ($kelas = mysqli_fetch_assoc($result_kelas)) {
                                echo "<option value='" . $kelas['id'] . "' " . ($r['kelas_id'] == $kelas['id'] ? 'selected' : '') . ">" . $kelas['kelas'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <img src="siswa/foto/<?= $r['foto'] ?>" alt="Gambar Tidak Ada" height="400px" title="Foto Sebelumnya">
                    </div>
                    <div class="mb-3">
                        <label for="">Masukan Foto (Jika Ingin Diganti)</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="id" value="<?= $r['id']; ?>">
                        <input type="hidden" name="old_foto" value="<?= $r['foto']; ?>">
                        <input type="reset" class="btn btn-secondary">&nbsp;
                        <input type="submit" value="Update" name="update" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
