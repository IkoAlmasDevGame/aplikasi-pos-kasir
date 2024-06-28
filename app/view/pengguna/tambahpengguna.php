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
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h4 class="card-title">Tambah Data Pengguna</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-responsive-md">
                        <form action="?aksi=tambah-pengguna" method="post">
                            <div class="form-group">
                                <div class="form-inline mt-1">
                                    <div class="form-check-label">
                                        <label for="" class="form-label">Nama Pengguna</label>
                                    </div>
                                    <input type="text" name="nama_pengguna" class="form-control" required
                                        aria-required="true" aria-label="Nama Pengguna">
                                </div>
                                <div class="form-inline mt-1">
                                    <div class="form-check-label">
                                        <label for="" class="form-label">User Name</label>
                                    </div>
                                    <input type="text" name="username" class="form-control" required
                                        aria-required="true" aria-label="user name">
                                </div>
                                <div class="form-inline mt-1">
                                    <div class="form-check-label">
                                        <label for="" class="form-label">E - Mailing</label>
                                    </div>
                                    <input type="email" name="email" class="form-control" required aria-required="true"
                                        aria-label="E - Mailing">
                                </div>
                                <div class="form-inline mt-1">
                                    <div class="form-check-label">
                                        <label for="" class="form-label">Password</label>
                                    </div>
                                    <input type="password" name="password" class=" form-control" required
                                        aria-required="true" id="password" aria-label="password">
                                </div>
                                <div class="form-inline mt-1">
                                    <div class="form-check-label">
                                        <label for="" class="form-label">Jabatan</label>
                                    </div>
                                    <input type="radio" name="role" value="admin" class="radio radio-inline" required
                                        id="" aria-required="true"> Admin
                                    <input type="radio" name="role" value="cashier" class="radio radio-inline" required
                                        id="" aria-required="true"> Cashier
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a type="button" href="?page=beranda" class="btn btn-default">Cancel</a>
                                    <button type="reset" class="btn btn-danger">Hapus Semua</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>