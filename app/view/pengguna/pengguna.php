<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Pengguna</title>
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
                    <h4 class="panel-heading fw-lighter"><i class="fa fa-user"></i> Data Pengguna</h4>
                    <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=beranda" aria-current="page" class="text-decoration-none text-primary"><i
                                    class="fa fa-home"></i></a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=pengguna" aria-current="page" class="text-decoration-none text-primary">Data
                                Pengguna</a>
                        </li>
                        <?php require_once("../pengguna/functionpage.php") ?>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h4 class="card-title">Data Master Pengguna</h4>
                    <?php require_once("../pengguna/functions.php") ?>
                    <div class="form-group">
                        <a href="?page=pengguna" aria-current="page" class="btn btn-info">
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
                                    <th>user name</th>
                                    <th>e - mailing</th>
                                    <th>password</th>
                                    <th>nama pengguna</th>
                                    <th>jabatan</th>
                                    <th>opsional</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    $row = $configs->query("SELECT * FROM user order by id_akun asc");
                                    while($isi = $row->fetch_array()){
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $no ?></td>
                                    <td><?php echo $isi['username'] ?></td>
                                    <td><?php echo $isi['email'] ?></td>
                                    <td>ter - enkripsi</td>
                                    <td><?php echo $isi['nama_pengguna'] ?></td>
                                    <td><?php echo $isi['role'] ?></td>
                                    <td>
                                        <?php 
                                            if($isi['role'] == "admin"){
                                        ?>
                                        <a href="?page=pengguna&aksi=ubahpengguna&id_akun=<?=$isi['id_akun']?>"
                                            aria-current="page" class="btn btn-sm btn-warning">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <?php
                                            }else if($isi['role'] == "cashier"){
                                        ?>
                                        <a href="?page=pengguna&aksi=hapus-pengguna&id_akun=<?=$isi['id_akun']?>"
                                            onclick="return confirm('Apakah data ini ingin anda hapus ?')"
                                            aria-current="page" class="btn btn-sm btn-danger">
                                            <i class="bx bx-trash"></i>
                                        </a>
                                        <?php
                                            }
                                        ?>
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
                                <a href="?page=pengguna&aksi=tambahpengguna" aria-current="page"
                                    class="btn btn-sm btn-danger">
                                    <i class="bi bi-plus"></i>
                                    <span>Tambah Data Pengguna</span>
                                </a>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>