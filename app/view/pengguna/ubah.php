<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Pengguna</title>
        <link rel="shortcut icon" href="../../../assets/<?php echo $_SESSION['gambar']?>" type="image/x-icon">
        <?php 
            if($_SESSION['role'] == "cashier"){
                require_once("../ui/header.php");
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                exit;
            }
        ?>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php") ?>
        <div class="container-fluid col-sm-12 col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h4 class="card-title">Ubah Data Pengguna</h4>
                    <div class="breadcrumb d-flex justify-content-end align-items-center flex-wrap">
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=beranda" aria-current="page" class="text-decoration-none text-primary">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=ubah-pengguna&id_akun=<?=$_GET['id_akun']?>" aria-current="page"
                                class="text-decoration-none text-primary">
                                Ubah Data Pengguna
                            </a>
                        </li>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-responsive-md">
                        <?php 
                            if(isset($_SESSION['id_akun'])){
                                $id = htmlspecialchars($_GET['id_akun']);
                                $row = $configs->query("SELECT * FROM user WHERE id_akun = '$id'");
                                while($isi = $row->fetch_array()){
                        ?>
                        <form action="?aksi=ubah-pengguna" method="post">
                            <input type="hidden" name="id_akun" value="<?=$isi['id_akun']?>">
                            <input type="hidden" name="role" value="<?=$isi['role']?>">
                            <div class="form-group">
                                <div class="form-inline mt-1">
                                    <div class="form-check-label">
                                        <label for="" class="form-label">Nama Pengguna</label>
                                    </div>
                                    <input type="text" name="nama_pengguna" value="<?=$isi['nama_pengguna']?>"
                                        class="form-control" required aria-required="true" aria-label="Nama Pengguna">
                                </div>
                                <div class="form-inline mt-1">
                                    <div class="form-check-label">
                                        <label for="" class="form-label">User Name</label>
                                    </div>
                                    <input type="text" name="username" value="<?=$isi['username']?>"
                                        class="form-control" required aria-required="true" aria-label="user name">
                                </div>
                                <div class="form-inline mt-1">
                                    <div class="form-check-label">
                                        <label for="" class="form-label">E - Mailing</label>
                                    </div>
                                    <input type="email" name="email" value="<?=$isi['email']?>" class="form-control"
                                        required aria-required="true" aria-label="E - Mailing">
                                </div>
                                <div class="form-inline mt-1">
                                    <div class="form-check-label">
                                        <label for="" class="form-label">Password</label>
                                    </div>
                                    <input type="password" name="password" class=" form-control" required
                                        aria-required="true" id="password" aria-label="password">
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-secondary">Update</button>
                                    <a type="button" href="?page=beranda" class="btn btn-default">Cancel</a>
                                    <button type="reset" class="btn btn-danger">Hapus Semua</button>
                                </div>
                            </div>
                        </form>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>