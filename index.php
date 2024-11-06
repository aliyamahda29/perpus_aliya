<?php include('config.php'); ?>
<?php include('header.php'); ?>

<div class="container mt-5">
    <h1 class="text-center">Perpustakaan Aliya</h1>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-center bg-info text-white">
                <div class="card-body">
                    <?php
                    $result = $mysqli->query("SELECT COUNT(*) AS total_anggota FROM anggota");
                    $row = $result->fetch_assoc();
                    echo "<h2>{$row['total_anggota']}</h2>";
                    ?>
                    <p>Total Anggota</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-success text-white">
                <div class="card-body">
                    <?php
                    $result = $mysqli->query("SELECT COUNT(*) AS total_petugas FROM petugas");
                    $row = $result->fetch_assoc();
                    echo "<h2>{$row['total_petugas']}</h2>";
                    ?>
                    <p>Total Petugas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-warning text-white">
                <div class="card-body">
                    <?php
                    $result = $mysqli->query("SELECT COUNT(*) AS total_buku FROM buku");
                    $row = $result->fetch_assoc();
                    echo "<h2>{$row['total_buku']}</h2>";
                    ?>
                    <p>Total Buku</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-success text-white">
                <div class="card-body">
                    <?php
                    $result = $mysqli->query("SELECT COUNT(*) AS total_peminjaman FROM peminjaman");
                    $row = $result->fetch_assoc();
                    echo "<h2>{$row['total_peminjaman']}</h2>";
                    ?>
                    <p>Total Peminjaman</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
