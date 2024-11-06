<?php include('config.php'); ?>
<?php include('header.php'); ?>

<div class="container mt-5">
    <h2>Anggota</h2>

    <?php
    $AnggotaID = '';
    $NamaAnggota = '';
    $Alamat = '';
    $TanggalLahir = '';
    $Kontak = '';

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $result = $mysqli->query("SELECT * FROM anggota WHERE AnggotaID=$id") or die($mysqli->error());
        if ($result->num_rows) {
            $row = $result->fetch_array();
            $AnggotaID = $row['AnggotaID'];
            $NamaAnggota = $row['NamaAnggota'];
            $Alamat = $row['Alamat'];
            $TanggalLahir = $row['TanggalLahir'];
            $Kontak = $row['Kontak'];
        }
    }

    if (isset($_POST['save'])) {
        $AnggotaID = $_POST['AnggotaID'];
        $NamaAnggota = $_POST['NamaAnggota'];
        $Alamat = $_POST['Alamat'];
        $TanggalLahir = $_POST['TanggalLahir'];
        $Kontak = $_POST['Kontak'];

        if ($AnggotaID == '') {
            $mysqli->query("INSERT INTO anggota (NamaAnggota, Alamat, TanggalLahir, Kontak) VALUES('$NamaAnggota', '$Alamat', '$TanggalLahir', '$Kontak')") or die($mysqli->error);
        } else {
            $mysqli->query("UPDATE anggota SET NamaAnggota='$NamaAnggota', Alamat='$Alamat', tanggalLahir='$tanggalLahir', Kontak='$Kontak' WHERE AnggotaID=$AnggotaID") or die($mysqli->error);
        }

        header('location: anggota.php');
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM anggota WHERE AnggotaID=$id") or die($mysqli->error());
        header('location: anggota.php');
    }
    ?>

    <form action="anggota.php" method="POST">
        <input type="hidden" name="AnggotaID" value="<?php echo $AnggotaID; ?>">
        <div class="mb-3">
            <label for="NamaAnggota" class="form-label">Nama Anggota</label>
            <input type="text" class="form-control" name="NamaAnggota" value="<?php echo $NamaAnggota; ?>" required>
        </div>
        <div class="mb-3">
            <label for="Alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" name="Alamat" value="<?php echo $Alamat; ?>" required>
        </div>
        <div class="mb-3">
            <label for="TanggalLahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" name="TanggalLahir" value="<?php echo $TanggalLahir; ?>" required>
        </div>
        <div class="mb-3">
            <label for="Kontak" class="form-label">Kontak</label>
            <input type="text" class="form-control" name="Kontak" value="<?php echo $Kontak; ?>" required>
        </div>
        <button type="submit" name="save" class="btn btn-primary">Simpan</button>
    </form>

    <table class="table table-striped mt-5">
        <thead>
            <tr>
                <th>ID Anggota</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>Kontak</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $mysqli->query("SELECT * FROM anggota");
            while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo $row['AnggotaID']; ?></td>
                <td><?php echo $row['NamaAnggota']; ?></td>
                <td><?php echo $row['Alamat']; ?></td>
                <td><?php echo $row['TanggalLahir']; ?></td>
                <td><?php echo $row['Kontak']; ?></td>
                <td>
                    <a href="anggota.php?edit=<?php echo $row['AnggotaID']; ?>" class="btn btn-warning">Edit</a>
                    <a href="anggota.php?delete=<?php echo $row['AnggotaID']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>
