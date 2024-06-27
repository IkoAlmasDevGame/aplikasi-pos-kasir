<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Barang</title>
        <link rel="shortcut icon" href="../../../assets/<?php echo $_SESSION['gambar']?>" type="image/x-icon">
        <?php 
            if($_SESSION['role'] == "admin"){
                require_once("../ui/header.php");
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                exit;
            }
        ?>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php") ?>
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="panel-heading fw-lighter"><i class="bi bi-briefcase"></i> Data Barang</h4>
                    <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=beranda" aria-current="page" class="text-decoration-none text-primary"><i
                                    class="fa fa-home"></i></a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=barang" aria-current="page" class="text-decoration-none text-primary">Data
                                Barang</a>
                        </li>
                        <?php require_once("../barang/functionpage.php") ?>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title fs-5 fw-normal fst-normal">Data Master Barang</h4>
                    <div class="form-group">
                        <div class="d-flex justify-content-start align-items-center flex-wrap gap-1">
                            <a href="?page=barang&stok=yes" aria-current="page" class="btn btn-warning">
                                <i class="fa fa-list"></i>
                                <span>Stok Barang</span>
                            </a>
                            <a href="?page=barang" aria-current="page" class="btn btn-info">
                                <i class="fa fa-refresh"></i>
                                <span>Refresh Page</span>
                            </a>
                        </div>
                    </div>
                    <?php require_once("../barang/functions.php") ?>
                </div>
                <div class="table-responsive table-responsive-md">
                    <div class="card-body mt-1">
                        <table class="table table-sm w-100 table-bordered" id="example2">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Jumlah Stok</th>
                                    <th class="text-center">Satuan</th>
                                    <th>Opsional</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                $hb = 0;
                                $hj = 0;
                                $stok = 0;
                                if(!empty($_GET['stok']) == "yes"){
                                    $row = $barang->lihatstok();
                                }else{
                                    $row = $barang->lihat();
                                }
                                while($isi = mysqli_fetch_array($row)){
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $no; ?></td>
                                    <td><?php echo $isi['nama_barang'] ?></td>
                                    <td><?php echo $isi['nama_kategori'] ?></td>
                                    <td>Rp. <?php echo number_format($isi['harga_beli']) ?> ,-</td>
                                    <td>Rp. <?php echo number_format($isi['harga_jual']) ?> ,-</td>
                                    <td>
                                        <?php
                                        if(isset($_GET['stok'])){
                                            if($_GET['stok']  == "yes"){
                                        ?>
                                        <form action="?aksi=restok-barang" method="post">
                                            <input type="hidden" name="id_barang" value="<?=$isi['id_barang']?>">
                                            <div class="form-group">
                                                <div class="form-inline col-sm-5 col-md-4">
                                                    <input type="text" minlength="0" maxlength="11" class="form-control"
                                                        name="jumlah_stok" value="<?=$isi['jumlah_stok']?>"
                                                        id="jumlah_stok" required>
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                                <button type="button" class="btn btn-sm btn-default"
                                                    onclick="document.location.href='?page=barang'">Cancel</button>
                                            </div>
                                        </form>
                                        <?php
                                            }    
                                        }else if($isi['jumlah_stok'] <= '3'){
                                        ?>
                                        <div class="text-center">
                                            <small>tolong stok di isi sisa <?php echo $isi['jumlah_stok'] ?></small>
                                        </div>
                                        <?php
                                        }else{
                                        ?>
                                        <?php echo $isi['jumlah_stok'] ?>
                                        <?php
                                            }
                                        ?>
                                    </td>
                                    <td class="text-center"><?php echo $isi['nama_satuan'] ?></td>
                                    <td>
                                        <a href="?page=barang&aksi=ubahbarang&id_barang=<?=$isi['id_barang']?>"
                                            aria-current="page" class="btn btn-sm btn-warning">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <a href="?aksi=hapus-barang&id_barang=<?=$isi['id_barang']?>"
                                            onclick="return confirm('Apakah kamu ingin menghapus data ini ?')"
                                            aria-current="page" class="btn btn-danger btn-sm">
                                            <i class="bx bx-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                $no++;
                                $hj += $isi['harga_jual'] * $isi['jumlah_stok'];
                                $hb += $isi['harga_beli'] * $isi['jumlah_stok'];
                                $stok += $isi['jumlah_stok'];
                                    }
                                ?>
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                                <a href="?page=barang&aksi=tambahbarang" aria-current="page" class="btn btn-danger">
                                    <i class="fa fa-plus"></i>
                                    <span>Tambah Barang</span>
                                </a>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>