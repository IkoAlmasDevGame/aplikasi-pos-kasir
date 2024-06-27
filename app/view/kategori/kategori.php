<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Kategori</title>
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
                    <h4 class="panel-heading fw-lighter"><i class="bx bx-cube-alt"></i> Data Kategori</h4>
                    <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=beranda" aria-current="page" class="text-decoration-none text-primary"><i
                                    class="fa fa-home"></i></a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=kategori" aria-current="page" class="text-decoration-none text-primary">Data
                                Kategori</a>
                        </li>
                        <?php require_once("../kategori/functionpage.php") ?>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Master Kategori</h4>
                    <?php require_once("../kategori/functions.php") ?>
                    <div class="form-group">
                        <a href="?page=kategori" aria-current="page" class="btn btn-info">
                            <i class="fa fa-refresh"></i>
                            <span>Refresh Page</span>
                        </a>
                    </div>
                </div>
                <div class="card-body mt-1">
                    <div class="table-responsive table-responsive-md">
                        <table class="table w-100 table-sm table-bordered" id="example2">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nama Kategori</th>
                                    <th>Opsional</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    $row = $kategori->lihat();
                                    while($isi = mysqli_fetch_array($row)){
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $no ?></td>
                                    <td><?php echo $isi['nama_kategori'] ?></td>
                                    <td>
                                        <a href="?page=kategori&aksi=ubahkategori&id_kategori=<?=$isi['id_kategori']?>"
                                            aria-current="page" class="btn btn-sm btn-warning">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <a href="?page=kategori&aksi=hapus-kategori&id_kategori=<?=$isi['id_kategori']?>"
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
                    </div>
                    <table>
                        <tbody>
                            <a href="?page=kategori&aksi=tambahkategori" aria-current="page"
                                class="btn btn-danger btn-sm">
                                <i class="bi bi-plus"></i>
                                <span>Tambah Data Kategori</span>
                            </a>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>