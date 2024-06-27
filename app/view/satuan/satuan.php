<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Satuan</title>
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
                    <h4 class="panel-heading fw-lighter"><i class="bx bx-cube"></i> Data Satuan</h4>
                    <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=beranda" aria-current="page" class="text-decoration-none text-primary"><i
                                    class="fa fa-home"></i></a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=satuan" aria-current="page" class="text-decoration-none text-primary">Data
                                Satuan</a>
                        </li>
                        <?php require_once("../satuan/functionpage.php") ?>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Master Satuan</h4>
                    <?php require_once("../satuan/functions.php") ?>
                    <div class="form-group">
                        <a href="?page=satuan" aria-current="page" class="btn btn-info">
                            <i class="fa fa-refresh"></i>
                            <span>Refresh Page</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-responsive-md mt-1">
                        <table class="table table-sm w-100 table-bordered" id="example2">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nama Satuan / Nama Unit</th>
                                    <th>Opsional</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    $row = $satuan->lihat();
                                    while($isi = mysqli_fetch_array($row)){
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $no ?></td>
                                    <td><?php echo $isi['nama_satuan'] ?></td>
                                    <td>
                                        <a href="?page=satuan&aksi=ubahsatuan&id_satuan=<?=$isi['id_satuan']?>"
                                            aria-current="page" class="btn btn-sm btn-warning">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <a href="?page=satuan&aksi=hapus-satuan&id_satuan=<?=$isi['id_satuan']?>"
                                            onclick="return confirm('Apakah anda ingin menghapus data ini ?')"
                                            aria-current="page" class="btn btn-sm btn-danger">
                                            <i class="bx bx-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                $no++;
                                    }
                                ?>
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                                <a href="?page=satuan&aksi=tambahsatuan" aria-current="page"
                                    class="btn btn-danger btn-sm">
                                    <i class="bi bi-plus"></i>
                                    <span>Tambah Data Satuan</span>
                                </a>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>