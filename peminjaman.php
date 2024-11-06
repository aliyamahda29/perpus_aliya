<?php include('config.php'); ?>
<?php include('header.php'); ?>

<div class="container mt-5">
    <h2>Peminjaman Buku</h2>

    <?php
    $PeminjamanID = '';
    $AnggotaID = '';
    $BukuID = '';
    $PetugasID = '';
    $TanggalPinjam = '';
    $TanggalKembali = '';

    // Cek jika ada parameter ID untuk edit
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $result = $mysqli->query("SELECT * FROM peminjaman WHERE PeminjamanID=$id") or die($mysqli->error());
        if ($result->num_rows) {
            $row = $result->fetch_array();
            $id_peminjaman = $row['PeminjamanID'];
            $AnggotaID = $row['AnggotaID'];
            $BukuID = $row['BukuID'];
            $PetugasID = $row['PetugasID'];
            $TanggalPinjam = $row['TanggalPinjam'];
            $TanggalKembali = $row['TanggalKembali'];
        }
    }

    // Proses simpan atau update peminjaman
    if (isset($_POST['save'])) {
        $PeminjamanID = $_POST['PeminjamanID'];
        $AnggotaID = $_POST['AnggotaID'];
        $BukuID = $_POST['BukuID'];
        $PetugasID = $_POST['PetugasID'];
        $TanggalPinjam = $_POST['TanggalPinjam'];
        $TanggalKembali = $_POST['TanggalKembali'];

        if ($PeminjamanID == '') {
            $mysqli->query("INSERT INTO peminjaman (AnggotaID, BukuID, PetugasID, TanggalPinjam, TanggalKembali) VALUES('$AnggotaID', '$BukuID', '$PetugasID', '$TanggalPinjam', '$TanggalKembali')") or die($mysqli->error);
        } else {
            $mysqli->query("UPDATE peminjaman SET AnggotaID='$AnggotaID', BukuID='$BukuID', PetugasID='$PetugasID', TanggalPinjam='$TanggalPinjam', TanggalKembali='$TanggalKembali' WHERE PeminjamanID=$PeminjamanID") or die($mysqli->error);
        }

        header('location: peminjaman.php');
    }

    // Proses hapus peminjaman
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM peminjaman WHERE PeminjamanID=$id") or die($mysqli->error());
        header('location: peminjaman.php');
    }
    ?>

    <form action="peminjaman.php" method="POST">
        <input type="hidden" name="PeminjamanID" value="<?php echo $PeminjamanID; ?>">

        <div class="mb-3">
            <label for="AnggotaID" class="form-label">Anggota</label>
            <select name="AnggotaID" class="form-select" required>
                <option value="">Pilih Anggota</option>
                <?php
                $result = $mysqli->query("SELECT * FROM anggota");
                while ($row = $result->fetch_assoc()) {
                    $selected = $row['AnggotaID'] == $AnggotaID ? 'selected' : '';
                    echo "<option value='{$row['AnggotaID']}' $selected>{$row['NamaAnggota']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="BukuID" class="form-label">Buku</label>
            <select name="BukuID" class="form-select" required>
                <option value="">Pilih Buku</option>
                <?php
                $result = $mysqli->query("SELECT * FROM buku");
                while ($row = $result->fetch_assoc()) {
                    $selected = $row['BukuID'] == $BukuID ? 'selected' : '';
                    echo "<option value='{$row['BukuID']}' $selected>{$row['JudulBuku']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="PetugasID" class="form-label">Petugas</label>
            <select name="PetugasID" class="form-select" required>
                <option value="">Pilih Petugas</option>
                <?php
                $result = $mysqli->query("SELECT * FROM petugas");
                while ($row = $result->fetch_assoc()) {
                    $selected = $row['PetugasID'] == $PetugasID ? 'selected' : '';
                    echo "<option value='{$row['PetugasID']}' $selected>{$row['NamaPetugas']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="TanggalPinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" class="form-control" name="TanggalPinjam" value="<?php echo $TanggalPinjam; ?>" required>
        </div>

        <div class="mb-3">
            <label for="TanggalKembali" class="form-label">Tanggal Kembali</label>
            <input type="date" class="form-control" name="TanggalKembali" value="<?php echo $TanggalKembali; ?>" required>
        </div>

        <button type="submit" name="save" class="btn btn-primary">Simpan</button>
    </form>

    <!-- Tabel daftar peminjaman -->
    <table class="table table-striped mt-5">
        <thead>
            <tr>
                <th>ID Peminjaman</th>
                <th>Anggota</th>
                <th>Buku</th>
                <th>Petugas</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $mysqli->query("SELECT peminjaman.*, anggota.NamaAnggota, buku.JudulBuku 
                                      FROM peminjaman 
                                      JOIN anggota ON peminjaman.AnggotaID = anggota.AnggotaID 
                                      JOIN buku ON peminjaman.BukuID = buku.BukuID");
            while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo $row['PeminjamanID']; ?></td>
                <td><?php echo $row['AnggotaID']; ?></td>
                <td><?php echo $row['BukuID']; ?></td>
                <td><?php echo $row['PetugasID']; ?></td>
                <td><?php echo $row['TanggalPinjam']; ?></td>
                <td><?php echo $row['TanggalKembali']; ?></td>
                <td>
                    <a href="peminjaman.php?edit=<?php echo $row['PeminjamanID']; ?>" class="btn btn-warning">Edit</a>
                    <a href="peminjaman.php?delete=<?php echo $row['PeminjamanID']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?');">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>
