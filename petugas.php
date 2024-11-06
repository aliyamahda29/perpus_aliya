<?php include('config.php'); ?>
<?php include('header.php'); ?>

<div class="container mt-5">
    <h2>Petugas</h2>

    <?php
    $PetugasID = '';
    $NamaPetugas = '';
    $Kontak = '';
    $Jabatan = '';

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $result = $mysqli->query("SELECT * FROM petugas WHERE PetugasID=$id") or die($mysqli->error());
        if ($result->num_rows) {
            $row = $result->fetch_array();
            $PetugasID = $row['PetugasID'];
            $NamaPetugas = $row['NamaPetugas'];
            $Kontak = $row['Kontak'];
            $Jabatan = $row['Jabatan'];
        }
    }

    if (isset($_POST['save'])) {
        $PetugasID = $_POST['PetugasID'];
        $NamaPetugas = $_POST['NamaPetugas'];
        $Kontak = $_POST['Kontak'];
        $Jabatan = $_POST['Jabatan'];

        if ($PetugasID == '') {
            $mysqli->query("INSERT INTO petugas (NamaPetugas, Kontak, Jabatan) VALUES('$NamaPetugas', '$Kontak', '$Jabatan')") or die($mysqli->error);
        } else {
            $mysqli->query("UPDATE petugas SET NamaPetugas='$NamaPetugas', Kontak='$Kontak', Jabatan='$Jabatan' WHERE PetugasID=$PetugasID") or die($mysqli->error);
        }

        header('location: petugas.php');
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM petugas WHERE PetugasID=$id") or die($mysqli->error());
        header('location: petugas.php');
    }
    ?>

    <form action="petugas.php" method="POST">
        <input type="hidden" name="PetugasID" value="<?php echo $PetugasID; ?>">
        <div class="mb-3">
            <label for="NamaPetugas" class="form-label">Nama Petugas</label>
            <input type="text" class="form-control" name="NamaPetugas" value="<?php echo $NamaPetugas; ?>" required>
        </div>
        <div class="mb-3">
            <label for="Kontak" class="form-label">Kontak</label>
            <input type="text" class="form-control" name="Kontak" value="<?php echo $Kontak; ?>" required>
        </div>
        <div class="mb-3">
            <label for="Jabatan" class="form-label">Jabatan</label>
            <input type="text" class="form-control" name="Jabatan" value="<?php echo $Jabatan; ?>" required>
        </div>
        <button type="submit" name="save" class="btn btn-primary">Simpan</button>
    </form>

    <table class="table table-striped mt-5">
        <thead>
            <tr>
                <th>ID Petugas</th>
                <th>Nama</th>
                <th>Kontak</th>
                <th>Jabatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $mysqli->query("SELECT * FROM petugas");
            while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo $row['PetugasID']; ?></td>
                <td><?php echo $row['NamaPetugas']; ?></td>
                <td><?php echo $row['Kontak']; ?></td>
                <td><?php echo $row['Jabatan']; ?></td>
                <td>
                    <a href="petugas.php?edit=<?php echo $row['PetugasID']; ?>" class="btn btn-warning">Edit</a>
                    <a href="petugas.php?delete=<?php echo $row['PetugasID']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>
