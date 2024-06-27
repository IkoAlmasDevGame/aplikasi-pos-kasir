<?php 
require_once("../ui/header.php");
require_once("../ui/sidebar.php");
?>

<div class="container-fluid">
    <?php 
        if(isset($_GET['info'])){
            if($_GET['info'] == "success"){
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Informasi!</strong>
        <p>Selamat datang di <?php echo $hasil['nama_toko'] ?></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            onclick="document.location.href = '?page=beranda'" aria-label="Close"></button>
    </div>
    <?php
        }
    }
    ?>
    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-header" style="height: 75px; max-height: 150px;">
                    <h4 class="card-title fs-6 fw-normal">Nama Barang</h4>
                </div>
                <div class="card-body">
                    <div class="text-center fs-2">
                        <?php $row = mysqli_fetch_array(mysqli_query($configs,"SELECT count(id_barang) as barang FROM barang order by id_barang desc"));
                         echo $row['barang'] ?>
                    </div>
                    <div class="card-footer" style="height: 45px; max-height: 150px;">
                        <?php 
                            if($_SESSION['role'] == "admin"){
                        ?>
                        <a href="?page=barang" aria-current="page" class="text-primary text-decoration-none">Table
                            Barang
                            <i class="bi bi-arrow-right"></i>
                        </a>
                        <?php
                            }else{
                        ?>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-header" style="height: 75px; max-height: 150px;">
                    <h4 class="card-title fs-6 fw-normal">Stok Barang</h4>
                </div>
                <div class="card-body">
                    <div class="text-center fs-2">
                        <?php $row = mysqli_fetch_array(mysqli_query($configs,"SELECT sum(jumlah_stok) as stok FROM barang order by id_barang desc"));
                         echo $row['stok'] ?>
                    </div>
                    <div class="card-footer" style="height: 45px; max-height: 150px;">
                        <?php 
                            if($_SESSION['role'] == "admin"){
                        ?>
                        <a href="?page=barang&stok=yes" aria-current="page"
                            class="text-primary text-decoration-none">Table Barang
                            <i class="bi bi-arrow-right"></i>
                        </a>
                        <?php
                            }else{
                        ?>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-header" style="height: 75px; max-height: 150px;">
                    <h4 class="card-title fs-6 fw-normal">Telah Terjual </h4>
                </div>
                <div class="card-body">
                    <div class="text-center fs-2">
                        <?php echo 0 ?>
                    </div>
                    <div class="card-footer" style="height: 45px; max-height: 150px;">
                        <?php 
                            if($_SESSION['role'] == "admin"){
                        ?>
                        <a href="" aria-current="page" class="text-primary text-decoration-none">Table Laporan
                            <i class="bi bi-arrow-right"></i>
                        </a>
                        <?php
                            }else{
                        ?>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-header" style="height: 75px; max-height: 150px;">
                    <h4 class="card-title fs-6 fw-normal">Kategori Barang</h4>
                </div>
                <div class="card-body">
                    <div class="text-center fs-2">
                        <?php $row = mysqli_fetch_array(mysqli_query($configs,"SELECT count(id_kategori) as kategori FROM kategori order by id_kategori desc"));
                         echo $row['kategori'] ?>
                    </div>
                    <div class="card-footer" style="height: 45px; max-height: 150px;">
                        <?php 
                            if($_SESSION['role'] == "admin"){
                        ?>
                        <a href="?page=kategori" aria-current="page" class="text-primary text-decoration-none">Table
                            Kategori
                            <i class="bi bi-arrow-right"></i>
                        </a>
                        <?php
                            }else{
                        ?>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h4 class="fs-5 fw-normal fst-normal">Pemasukan Uang : Rp.
        <?php echo number_format(0) ?> ,-</h4>
    <h4 class="fs-5 fw-normal fst-normal">Pengeluaran Modal : Rp.
        <?php $row = mysqli_fetch_array(mysqli_query($configs,"SELECT sum(harga_beli) as modal FROM barang order by id_barang desc")); 
        echo number_format($row['modal']) ?> ,-</h4>
</div>

<?php 
require_once("../ui/footer.php");
?>