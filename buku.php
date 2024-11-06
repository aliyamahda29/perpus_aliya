<?php include('config.php'); ?>
<?php include('header.php'); ?>

<div class="container mt-5">
    <h2>Buku</h2>

    <?php
    $BukuID = '';
    $JudulBuku = '';
    $Pengarang = '';
    $Penerbit = '';
    $TahunTerbit = '';
    $Kategori = '';
    $JumlahStock = '';

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $result = $mysqli->query("SELECT * FROM buku WHERE BukuID=$id") or die($mysqli->error());
        if ($result->num_rows) {
            $row = $result->fetch_array();
            $BukuID = $row['BukuID'];
            $JudulBuku = $row['JudulBuku'];
            $Pengarang = $row['Pengarang'];
            $Penerbit = $row['Penerbit'];
            $TahunTerbit = $row['TahunTerbit'];
            $Kategori = $row['Kategori'];
            $JumlahStock = $row['JumlahStock'];
        }
    }

    if (isset($_POST['save'])) {
        $BukuID = $_POST['BukuID'];
        $JudulBuku = $_POST['JudulBuku'];
        $Pengarang = $_POST['Pengarang'];
        $Penerbit = $_POST['Penerbit'];
        $TahunTerbit = $_POST['TahunTerbit'];
        $Kategori = $_POST['Kategori'];
        $JumlahStock = $_POST['JumlahStock'];

        if ($AnggotaID == '') {
            $mysqli->query("INSERT INTO buku (JudulBuku, Pengarang, Penerbit, TahunTerbit, Kategori, JumlahStock) VALUES('$JudulBuku', '$Pengarang', '$Penerbit', '$TahunTerbit', '$Kategori', '$JumlahStock')") or die($mysqli->error);
        } else {
            $mysqli->query("UPDATE buku SET JudulBuku='$JudulBuku', Pengarang='$Pengarang', Penerbit='$Penerbit', TahunTerbit='$TahunTerbit', Kategori='$Kategori', JumlahStock='$JumlahStock' WHERE BukuID=$BukuID") or die($mysqli->error);
        }

        header('location: buku.php');
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM buku WHERE BukuID=$id") or die($mysqli->error());
        header('location: buku.php');
    }
    ?>

    <form action="Buku.php" method="POST">
        <input type="hidden" name="BukuID" value="<?php echo $AnggotaID; ?>">
        <div class="mb-3">
            <label for="JudulBuku" class="form-label">Judul Buku</label>
            <input type="text" class="form-control" name="JudulBuku" value="<?php echo $JudulBuku; ?>" required>
        </div>
        <div class="mb-3">
            <label for="Pengarang" class="form-label">Pengarang</label>
            <input type="text" class="form-control" name="Pengarang" value="<?php echo $Pengarang; ?>" required>
        </div>
        <div class="mb-3">
            <label for="Penerbit" class="form-label">Penerbit</label>
            <input type="text" class="form-control" name="Penerbit" value="<?php echo $Penerbit; ?>" required>
        </div>
        <div class="mb-3">
            <label for="TahunTerbit" class="form-label">Tahun Terbit</label>
            <input type="date" class="form-control" name="TahunTerbit" value="<?php echo $TahunTerbit; ?>" required>
        </div>
        <div class="mb-3">
            <label for="Kategori" class="form-label">Kategori</label>
            <input type="text" class="form-control" name="Kategori" value="<?php echo $Kategori; ?>" required>
        </div>
        <div class="mb-3">
            <label for="JumlahStock" class="form-label">Jumlah Stock</label>
            <input type="text" class="form-control" name="JumlahStock" value="<?php echo $JumlahStock; ?>" required>
        </div>
        <button type="submit" name="save" class="btn btn-primary">Simpan</button>
    </form>

    <table class="table table-striped mt-5">
        <thead>
            <tr>
                <th>ID Buku</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Kategori</th>
                <th>Jumlah Stock </th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $mysqli->query("SELECT * FROM buku");
            while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo $row['BukuID']; ?></td>
                <td><?php echo $row['JudulBuku']; ?></td>
                <td><?php echo $row['Pengarang']; ?></td>
                <td><?php echo $row['Penerbit']; ?></td>
                <td><?php echo $row['TahunTerbit']; ?></td>
                <td><?php echo $row['Kategori']; ?></td>
                <td><?php echo $row['JumlahStock']; ?></td>
                <td>
                    <a href="buku.php?edit=<?php echo $row['BukuID']; ?>" class="btn btn-warning">Edit</a>
                    <a href="buku.php?delete=<?php echo $row['BukuID']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>
